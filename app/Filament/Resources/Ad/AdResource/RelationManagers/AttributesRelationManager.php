<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;

class AttributesRelationManager extends BelongsToManyRelationManager
{
 protected static string $relationship = 'attributes';
 protected static ?string $recordTitleAttribute = 'title';

 public static function form(Form $form): Form
 {
  return $form->schema([
                        TextInput::make('name')
                                 ->required(),
                        TextInput::make('validation'),
                        TextInput::make('position')
                                 ->numeric(),
                        Toggle::make('is_filterable'),
                        Toggle::make('is_visible_on_front'),
                       ]);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('name')
                                    ->sortable(),
                          TextColumn::make('type')
                                    ->sortable(),
                          BooleanColumn::make('is_visible_on_front')
                                       ->sortable(),
                          TextColumn::make('updated_at')
                                    ->date()
                                    ->sortable(),
                         ])
               ->filters([//
                         ]);
 }
}
