<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        AcademicYear::factory()->create([
            'name' => $previousYear.'/'.$currentYear,
            'end_date' => $currentYear.'-09-01',
            'start_date' => $previousYear.'-09-01',
            'status' => true
        ]);
    }
}
