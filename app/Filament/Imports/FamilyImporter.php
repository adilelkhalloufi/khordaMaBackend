<?php

namespace App\Filament\Imports;

use App\Models\Family;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class FamilyImporter extends Importer
{
    protected static ?string $model = Family::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make(Family::COL_NAME)
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Family
    {
        return Family::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            Family::COL_NAME => $this->data[Family::COL_NAME],
        ]);

        return new Family();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your family import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
