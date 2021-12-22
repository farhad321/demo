<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CategoriesRelationManager extends BelongsToManyRelationManager
{
 protected static string $relationship = 'categories';
 protected static ?string $recordTitleAttribute = 'name';

 public static function form(Form $form): Form
 {
  return $form->schema([
                        TextInput::make('name')
                                 ->required()
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
}
