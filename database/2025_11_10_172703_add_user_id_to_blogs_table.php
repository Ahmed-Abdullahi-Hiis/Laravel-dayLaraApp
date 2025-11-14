<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Blog;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // 1. Add nullable user_id column first
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // 2. Assign existing blogs to admin (assuming admin id = 1)
        Blog::whereNull('user_id')->update(['user_id' => 1]);

        Schema::table('blogs', function (Blueprint $table) {
            // 3. Add foreign key constraint
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
