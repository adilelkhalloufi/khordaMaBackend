<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Handle the attachments separately
        $this->attachments = $data['attachments'] ?? [];
        unset($data['attachments']);  // Remove the attachments from the data array

        return $data;
    }

    public function afterSave(): void
    {
        // Save the attachments after the product has been saved
        if (!empty($this->attachments)) {
            $product = $this->record; // Get the product record

            foreach ($this->attachments as $file) {
                // Store the file
                $path = $file->store('products');

                // Create the attachment record and associate it with the product
                $product->attachments()->create([
                    'path' => $path,
                    'model_type' => Product::class,  // The model type (Product)
                    'model_id' => $product->id,     // The product's ID
                ]);
            }
        }
    }
}
