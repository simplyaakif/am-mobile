<?php

    namespace App\Filament\Resources\RecoveryResource\Pages;

    use App\Filament\Resources\RecoveryResource;
    use Filament\Pages\Actions\CreateAction;
    use Filament\Resources\Pages\ListRecords;

    class ListRecoveries extends ListRecords {

        protected static string $resource = RecoveryResource::class;

        protected function getActions(): array
        {
            return [
                CreateAction::make(),
            ];
        }
    }
