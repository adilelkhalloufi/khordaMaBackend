<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Store attachments temporarily
        $this->attachments = $data['attachments'] ?? [];
        unset($data['attachments']); // Remove attachments from form data to avoid saving in a non-existent column

        return $data;
    }

    protected function afterSave(): void
    {
        $this->handleAttachments();
    }

    protected function handleAttachments(): void
    {
        // Remove old attachments
        $this->record->attachments()->delete();

        // Save new attachments
        if (! empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                // Determine whether the attachment is a path or a file upload
                $path = is_string($attachment) ? $attachment : $attachment->store('attachments');

                $this->record->attachments()->create([
                    'path' => $path, // Save the path to the attachment
                    'model_type' => get_class($this->record),
                    'model_id' => $this->record->id,
                ]);
            }
        }
    }
}
