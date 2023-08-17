<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PurchaseResource\Pages;
    use App\Models\Purchase;
    use Filament\Forms\Components\Checkbox;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables\Table;
    use Filament\Tables\Columns\TextColumn;

    class PurchaseResource extends Resource {

        protected static ?string $navigationIcon = 'iconsax-lin-mobile';

        protected static ?string $navigationLabel = 'Customer Purchases';


        protected static ?string $model = Purchase::class;

        protected static ?string $slug = 'purchases';

        protected static ?string $recordTitleAttribute = 'title';

        public static function form(Form $form): Form
        {
            return $form->schema([
                                     TextInput::make('customer_id')->required()->integer(),

                                     TextInput::make('title')->required(),

                                     TextInput::make('model'),

                                     TextInput::make('imei'),

                                     Checkbox::make('is_pta'),

                                     TextInput::make('user_id')->required()->integer(),

                                     TextInput::make('total_amount')->required(),

                                     Placeholder::make('created_at')->label('Created Date')->content(fn(?Purchase $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                                     Placeholder::make('updated_at')->label('Last Modified Date')->content(fn(?Purchase $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                                 ]);
        }

        public static function table(Table $table): Table
        {
            return $table->columns([
                                       TextColumn::make('customer_id'),

                                       TextColumn::make('title')->searchable()->sortable(),

                                       TextColumn::make('model'),

                                       TextColumn::make('imei'),

                                       TextColumn::make('is_pta'),

                                       TextColumn::make('user_id'),

                                       TextColumn::make('total_amount'),
                                   ]);
        }

        public static function getPages(): array
        {
            return [
                'index'  => Pages\ListPurchases::route('/'),
                'create' => Pages\CreatePurchase::route('/create'),
                'edit'   => Pages\EditPurchase::route('/{record}/edit'),
            ];
        }

        public static function getGloballySearchableAttributes(): array
        {
            return ['title'];
        }
    }
