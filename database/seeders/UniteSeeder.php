<?php

namespace Database\Seeders;

use App\Models\Unite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/Imported/Unites.csv');
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            DB::table(Unite::TABLE_NAME)->insert([
                Unite::COL_NAME => $record[Unite::COL_NAME],

            ]);
        }

        $this->command->info('Unite seeded successfully.');
    }
}
