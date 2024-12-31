<?php

namespace App\Filament\Imports;

use App\Models\Unite;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Log;

class UniteImporter extends Importer
{
    protected static ?string $model = Unite::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make(Unite::COL_NAME)
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Unite
    {
        try {

            return Unite::create([
                Unite::COL_NAME => $this->data[Unite::COL_NAME],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to import Family: ' . $this->data[Unite::COL_NAME] . ' Error: ' . $e->getMessage());
            return null;
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your unite import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
