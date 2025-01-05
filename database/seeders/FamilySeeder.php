<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/Imported/Family.csv');
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            DB::table(Family::TABLE_NAME)->insert([
                Family::COL_NAME => $record[Family::COL_NAME],

            ]);
        }

        $this->command->info('Family seeded successfully.');
    }
}
