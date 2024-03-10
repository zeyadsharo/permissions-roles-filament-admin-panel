<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
 use Filament\Forms\Components\Section;
                use Filament\Forms\Components\Actions\Action;
                use Filament\Support\Enums\Alignment;
class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               

                Section::make('Customer Information')
                    ->description('Basic customer information')
                    ->icon('heroicon-m-user')
                    ->schema([
                        Forms\Components\TextInput::make('arabic_title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kurdish_title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_info')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('logo')
                            ->maxLength(255),
                    ]),
            

                Section::make('Location Information')
                    ->description('Customer location details')
                    // ->icon('heroicon-m-location-marker')
                    ->schema([
                        Forms\Components\TextInput::make('area_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('sector_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('latitude')
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric(),
                    ])
                  ,

                Section::make('Additional Information')
                    ->description('Additional details about the customer')
                    ->icon('heroicon-m-information-circle')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('about')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('display_order')
                            ->required()
                            ->numeric(),
                        Forms\Components\Toggle::make('activation_state')
                            ->required(),
                        Forms\Components\DatePicker::make('next_payment'),
                    ])
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('area_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sector_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('arabic_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kurdish_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_info')
                    ->searchable(),
                Tables\Columns\TextColumn::make('display_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('activation_state')
                    ->boolean(),
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_payment')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
