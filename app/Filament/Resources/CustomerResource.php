<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\CustomerResource\Pages;
    use App\Models\Customer;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
    use Filament\Forms\Components\TextInput;
    use Filament\Resources\Resource;
    use Filament\Tables\Actions\DeleteAction;
    use Filament\Tables\Actions\EditAction;
    use Filament\Tables\Actions\ViewAction;
    use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
    use Filament\Tables\Table;
    use Filament\Forms\Form;
    use Filament\Tables\Columns\TextColumn;

    class CustomerResource extends Resource {

        protected static ?string $model = Customer::class;
        protected static ?string $navigationIcon = 'iconsax-lin-user';

        protected static ?string $slug = 'customers';

        protected static ?string $recordTitleAttribute = 'name';

        public static function form(Form $form): Form
        {
            return $form->schema([
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

                                     Placeholder::make('created_at')->label('Created Date')->content(fn(?Customer $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                                     Placeholder::make('updated_at')->label('Last Modified Date')->content(fn(?Customer $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                                 ]);
        }

        public static function table(Table $table): Table
        {
            return $table->columns([
                SpatieMediaLibraryImageColumn::make('dp'),

                                       TextColumn::make('name')->searchable()->sortable(),

                                       TextColumn::make('whatsapp_mobile'),

                                       TextColumn::make('mobile'),

                                       TextColumn::make('guarantor_whatsapp_mobile'),



                                   ])->actions([
                                       ViewAction::make(),
                                       EditAction::make(),
                                       DeleteAction::make(),
                                                                      ]);
        }

        public static function getPages(): array
        {
            return [
                'index'  => Pages\ListCustomers::route('/'),
                'create' => Pages\CreateCustomer::route('/create'),
                'edit'   => Pages\EditCustomer::route('/{record}/edit'),
            ];
        }

        public static function getGloballySearchableAttributes(): array
        {
            return ['name'];
        }
    }
