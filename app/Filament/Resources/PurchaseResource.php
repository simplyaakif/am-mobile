<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PurchaseResource\Pages;
    use App\Models\Customer;
    use App\Models\Purchase;
    use Filament\Forms\Components\Checkbox;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\Grid;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\Repeater;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Forms\Get;
    use Filament\Resources\Resource;
    use Filament\Tables\Actions\ViewAction;
    use Filament\Tables\Actions\DeleteAction;
    use Filament\Tables\Columns\IconColumn;
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
                                     Select::make('customer_id')
                                         ->relationship('customer','name')
                                         ->searchable()
                                         ->live()
                                         ->preload()
                                         ->required()
                                         ->createOptionForm([
                                             Grid::make(2)
                ->schema([

                                                                TextInput::make('name')->required(),

                                                                TextInput::make('whatsapp_mobile')
                                                                    ->placeholder('e.g +923001805559')
                                                                    ->hint('Use Country Code Mobile Numbers Only')
                                                                    ->required(),


                                                                TextInput::make('mobile')
                                                                    ->hint('GSM Mobile Number'),

                                                                TextInput::make('Comments')
                                                                    ->hint('Any other detail/information of use'),

                                                                TextInput::make('address'),

                                                                Select::make('occupation')
                                                                    ->options(Customer::OCCUPATIONS)
                                                                    ->required(),

                                                                TextInput::make('guarantor_whatsapp_mobile')
                                                                    ->placeholder('e.g +923001805559')
                                                                    ->hint('Optional Mobile Number for Guarantor'),

                                                                SpatieMediaLibraryFileUpload::make('dp')
                                                                    ->label('Customer Display Picture')
                                                                    ->image(),
                         ])
                                                            ]),

                                     Select::make('user_id')
                                         ->relationship('user','name')
                                         ->label('Sold By')
                                         ->native(false)
                                         ->required(),

                                     TextInput::make('title')->required(),

                                     TextInput::make('model')->label('Phone Model'),



                                     Grid::make(3)
                ->schema([

                                     TextInput::make('imei')->label('IMEI'),

                                     TextInput::make('total_amount')
                                         ->label('Total Amount in PKR')
                                         ->numeric()
                                         ->required(),

                                     Checkbox::make('is_pta')->label('Is PTA Approved'),

                         ]),


                                     Repeater::make('recoveries')
                                         ->relationship('recoveries')
                                         ->columnSpanFull()
                                        ->schema([
                                            Grid::make(2)
                                        ->schema([
                                                TextInput::make('customer_id')->hidden(),
                                                TextInput::make('amount')
                                                ->required()
                                                ->integer(),
                                                DatePicker::make('due_date')
                                                    ->after('yesterday')
                                                    ->native(false)
                                                    ->required(),
                                                  ]),
                                              ])
                                         ->mutateRelationshipDataBeforeCreateUsing(function (array $data,Get $get):
                                         array {
                                             $data['customer_id'] = $get('customer_id');

                                             return $data;
                                         }),

                                     Placeholder::make('created_at')->label('Created Date')->content(fn(?Purchase $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                                     Placeholder::make('updated_at')->label('Last Modified Date')->content(fn(?Purchase $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                                 ]);
        }



        public static function table(Table $table): Table
        {
            return $table->columns([
                                       TextColumn::make('customer.name')->searchable()->sortable(),

                                       TextColumn::make('title')->searchable()->sortable(),

                                       TextColumn::make('model'),

                                       TextColumn::make('imei'),

                                       IconColumn::make('is_pta')
                                           ->sortable()
                                       ->boolean(),

                                       TextColumn::make('user.name')->label('Sold By'),

                                       TextColumn::make('total_amount'),
                                       TextColumn::make('created_at')->date('h:iA d-m-Y')
                                           ->sortable(),

                                   ])
                ->actions([
                    ViewAction::make(),
                    DeleteAction::make(),
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
