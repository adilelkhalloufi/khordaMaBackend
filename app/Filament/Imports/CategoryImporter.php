<?php

namespace App\Filament\Imports;

use App\Models\Categorie;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Log;

class CategoryImporter extends Importer
{
    protected static ?string $model = Categorie::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make(Categorie::COL_NAME)->requiredMapping()->rules([
                'required',
                'string',
            ]),
            ImportColumn::make(Categorie::COL_DESCRIPTION)->requiredMapping()->rules([
                'required',
                'string',
            ]),
            ImportColumn::make(Categorie::COL_FAMILY_ID)->requiredMapping()->rules([
                'required',
                'integer',
            ]),
        ];
    }

    public function resolveRecord(): ?Categorie
    {
        try {

            return Categorie::create([
                Categorie::COL_NAME => $this->data[Categorie::COL_NAME],
                Categorie::COL_DESCRIPTION => $this->data[Categorie::COL_DESCRIPTION],
                Categorie::COL_FAMILY_ID => $this->data[Categorie::COL_FAMILY_ID],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to import Family: '.$this->data[Categorie::COL_NAME].' Error: '.$e->getMessage());

            return null;
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your category import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
