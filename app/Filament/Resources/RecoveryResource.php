<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\RecoveryResource\Pages;
    use App\Models\Recovery;
    use Filament\Forms\Components\Checkbox;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables\Columns\IconColumn;
    use Filament\Tables\Table;
    use Filament\Tables\Columns\TextColumn;

    class RecoveryResource extends Resource {

        protected static ?string $model = Recovery::class;

        protected static ?string $navigationIcon = 'iconsax-lin-money';
        protected static ?string $slug = 'recoveries';

        protected static ?string $recordTitleAttribute = 'id';

        public static function form(Form $form): Form
        {
            return $form->schema([
                                     TextInput::make('customer_id')->required()->integer(),

                                     TextInput::make('purchase_id')->required()->integer(),

                                     TextInput::make('amount')->required(),

                                     DatePicker::make('due_date'),

                                     Checkbox::make('is_paid'),

                                     DatePicker::make('paid_on'),

                                     TextInput::make('account_id')->integer(),

                                     Placeholder::make('created_at')->label('Created Date')->content(fn(?Recovery $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                                     Placeholder::make('updated_at')->label('Last Modified Date')->content(fn(?Recovery $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                                 ]);
        }

        public static function table(Table $table): Table
        {
            return $table->columns([
                                       TextColumn::make('customer.name'),

                                       TextColumn::make('purchase.title'),
                                       TextColumn::make('purchase.model'),

                                       TextColumn::make('amount'),

                                       TextColumn::make('due_date')->date(),

                                       IconColumn::make('is_paid')
                                       ->boolean(),

                                       TextColumn::make('paid_on')->date(),

                                       TextColumn::make('account_id'),
                                   ]);
        }

        public static function getPages(): array
        {
            return [
                'index'  => Pages\ListRecoveries::route('/'),
                'create' => Pages\CreateRecovery::route('/create'),
                'edit'   => Pages\EditRecovery::route('/{record}/edit'),
            ];
        }

        public static function getGloballySearchableAttributes(): array
        {
            return [];
        }
    }
