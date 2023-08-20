<?php

    namespace App\Filament\Resources\AccountResource\Pages;

    use App\Filament\Resources\AccountResource;
    use Filament\Pages\Actions\DeleteAction;
    use Filament\Resources\Pages\EditRecord;

    class EditAccount extends EditRecord {

        protected static string $resource = AccountResource::class;

        protected function getActions(): array
        {
            return [
                DeleteAction::make(),
            ];
        }
    }
