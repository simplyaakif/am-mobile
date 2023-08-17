<?php

    namespace App\Filament\Resources\PurchaseResource\Pages;

    use App\Filament\Resources\PurchaseResource;
    use Filament\Pages\Actions\CreateAction;
    use Filament\Resources\Pages\ListRecords;

    class ListPurchases extends ListRecords {

        protected static string $resource = PurchaseResource::class;

        protected function getActions(): array
        {
            return [
                CreateAction::make(),
            ];
        }
    }
