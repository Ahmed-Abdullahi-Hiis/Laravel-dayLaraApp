<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'image')) {
                $table->string('image')->nullable();
            }

            if (!Schema::hasColumn('blogs', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'image')) {
                $table->dropColumn('image');
            }

            if (Schema::hasColumn('blogs', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
