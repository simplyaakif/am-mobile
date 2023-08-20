<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\AccountResource\Pages;
    use App\Models\Account;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables\Table;
    use Filament\Tables\Columns\TextColumn;

    class AccountResource extends Resource {

        protected static ?string $model = Account::class;

        protected static ?string $slug = 'accounts';

        protected static ?string $navigationIcon = 'iconsax-lin-bank';
        protected static ?int $navigationSort = 5;
        protected static ?string $recordTitleAttribute = 'title';

        public static function form(Form $form): Form
        {
            return $form->schema([
                                     TextInput::make('title')->required(),

                                     TextInput::make('account_number'),

                                     Placeholder::make('created_at')->label('Created Date')->content(fn(?Account $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                                     Placeholder::make('updated_at')->label('Last Modified Date')->content(fn(?Account $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                                 ]);
        }

        public static function table(Table $table): Table
        {
            return $table->columns([
                                       TextColumn::make('title')->searchable()->sortable(),

                                       TextColumn::make('account_number'),
                                   ]);
        }

        public static function getPages(): array
        {
            return [
                'index'  => Pages\ListAccounts::route('/'),
                'create' => Pages\CreateAccount::route('/create'),
                'edit'   => Pages\EditAccount::route('/{record}/edit'),
            ];
        }

        public static function getGloballySearchableAttributes(): array
        {
            return ['title'];
        }
    }
