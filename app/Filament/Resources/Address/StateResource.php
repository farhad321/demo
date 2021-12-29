<?php

namespace App\Filament\Resources\Address;

use App\Filament\Resources\Address\StateResource\Pages;
use App\Filament\Resources\Address\StateResource\RelationManagers;
use App\Models\Address\State;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class StateResource extends Resource
{
 protected static ?string $model = State::class;
 protected static ?string $navigationIcon = 'heroicon-o-collection';
 protected static ?string $recordTitleAttribute = 'name';
 protected static ?string $navigationGroup = 'General';
 protected static ?int $navigationSort = 1;

 public static function form(Form $form): Form
 {
  return $form->schema([
                        TextInput::make('name')
                                 ->required(),
                        TextInput::make('slug')
                                 ->required(),
                       ]);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('name')
                                    ->searchable()
                                    ->sortable(),
                         ])
               ->filters([//
                         ]);
 }

 public static function getRelations(): array
 {
  return [
   RelationManagers\CitiesRelationManager::class,
  ];
 }

 public static function getPages(): array
 {
  return [
   'index' => Pages\ListStates::route('/'),
   'create' => Pages\CreateState::route('/create'),
   'edit' => Pages\EditState::route('/{record}/edit'),
  ];
 }
}
