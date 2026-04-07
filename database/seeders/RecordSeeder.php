<?php

namespace Database\Seeders;

use App\Models\Record;
use App\Models\Upload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create an upload
        $upload = Upload::first() ?? Upload::create([
            'user_id' => 1,
            'file_name' => 'Sample Data.xlsx',
            'upload_date' => now(),
        ]);

        $actions = ['Bodemcheck', 'Watermonster', 'Luchtmeting', 'Drainage check'];
        $employees = ['J. de Vries', 'S. Bakker', 'M. Janssen', 'P. Smit'];

        for ($i = 0; $i < 15; $i++) {
            Record::create([
                'upload_id' => $upload->id,
                'action' => $actions[rand(0, 3)],
                'description' => 'Sample environmental check #' . ($i + 1),
                'employee_name' => $employees[rand(0, 3)],
                'duration' => rand(60, 240),
                'cost' => rand(100, 500),
                'date' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
