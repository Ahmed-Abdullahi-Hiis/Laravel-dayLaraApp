<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class TestReportsSeeder extends Seeder
{
    public function run(): void
    {
        Report::create([
            'type' => 'Test Report',
            'details' => 'This is a verified test report for the admin dashboard.',
            'status' => 'Verified',
        ]);

        Report::create([
            'type' => 'Test Report',
            'details' => 'This is a pending test report for demonstration purposes.',
            'status' => 'Pending',
        ]);

        Report::create([
            'type' => 'Test Report',
            'details' => 'This test report requires immediate action.',
            'status' => 'Action Needed',
        ]);
    }
}
