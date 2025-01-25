<?php

namespace Database\Seeders;

use App\Models\Specialitie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/Imported/Type.csv');
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {

            DB::table(Specialitie::TABLE_NAME)->insert([
                Specialitie::COL_NAME => $record[Specialitie::COL_NAME],
                Specialitie::COL_TYPE => $record[Specialitie::COL_TYPE],

            ]);
        }
        // show message in console it done for laravel
        $this->command->info('Specialitie seeded successfully.');
    }
}
