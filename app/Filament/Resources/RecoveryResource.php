<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\RecoveryResource\Pages;
    use App\Models\Recovery;
    use Filament\Forms\Components\Checkbox;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\Grid;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables\Actions\DeleteAction;
    use Filament\Tables\Actions\ViewAction;
    use Filament\Tables\Columns\IconColumn;
    use Filament\Tables\Columns\Summarizers\Sum;
    use Filament\Tables\Enums\FiltersLayout;
    use Filament\Tables\Filters\Filter;
    use Filament\Tables\Filters\SelectFilter;
    use Filament\Tables\Table;
    use Filament\Tables\Columns\TextColumn;
    use Illuminate\Database\Eloquent\Builder;
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
                                       TextColumn::make('customer.name')->searchable()->sortable(),

                                       TextColumn::make('purchase.title'),
                                       TextColumn::make('purchase.model'),

                                       TextColumn::make('amount')
                                           ->summarize(Sum::make()),

                                       TextColumn::make('due_date')->date(),

                                       IconColumn::make('is_paid')
                                           ->sortable()
                                       ->boolean(),

                                       TextColumn::make('paid_on')->sortable()->date('d-m-Y'),

                                       TextColumn::make('account_id'),
                                       TextColumn::make('created_at')->sortable()->date('d-m-Y')
                                   ])->actions([
                                       ViewAction::make(),
                                       DeleteAction::make()
                                                                  ])
                ->filters([

                    Filter::make('due_date')
                        ->form([
                            Grid::make(2)
                            ->schema([
                                   DatePicker::make('due_from')->native(false),
                                   DatePicker::make('due_until')->native(false),
                                     ]),
                               ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['due_from'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('due_date', '>=', $date),
                                )
                                ->when(
                                    $data['due_until'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('due_date', '<=', $date),
                                );
                        }),
                    SelectFilter::make('is_paid')
                        ->label('Status')
                        ->columns(3)
                        ->options([
                                      0=>'Not Paid',
                                      1=>'Paid',
                                  ]),

                          ],layout: FiltersLayout::AboveContent)
                ->filtersFormColumns(2);
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
