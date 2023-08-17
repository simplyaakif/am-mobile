<?php

    namespace App\Filament\Resources\PurchaseResource\Pages;

    use App\Filament\Resources\PurchaseResource;
    use Filament\Pages\Actions\DeleteAction;
    use Filament\Resources\Pages\EditRecord;

    class EditPurchase extends EditRecord {

        protected static string $resource = PurchaseResource::class;

        protected function getActions(): array
        {
            return [
                DeleteAction::make(),
            ];
        }
    }
