<?php

    namespace App\Filament\Resources\RecoveryResource\Pages;

    use App\Filament\Resources\RecoveryResource;
    use Filament\Pages\Actions\DeleteAction;
    use Filament\Resources\Pages\EditRecord;

    class EditRecovery extends EditRecord {

        protected static string $resource = RecoveryResource::class;

        protected function getActions(): array
        {
            return [
                DeleteAction::make(),
            ];
        }
    }
