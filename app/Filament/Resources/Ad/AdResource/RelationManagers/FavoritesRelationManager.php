<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use App\Models\Ad\Favorite;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class FavoritesRelationManager extends HasManyRelationManager
{
 protected static string $relationship = 'favorites';
 protected static ?string $recordTitleAttribute = 'id';

 public static function form(Form $form): Form
 {
  return $form->schema([
                        BelongsToSelect::make('user_id')
                                       ->visible(fn(?Favorite $record): bool => $record?->user ? false : true)
                                       ->relationship('user', 'name',
                                        fn(Builder $query) => $query->where('rule', 'admin'))
                                       ->default(function () {
                                        return User::where('rule', 'admin')
                                                   ->first()->id;
                                       }),
                        Placeholder::make('user_id')
                                   ->label('Created By')
                                   ->content(fn(?Favorite $record): string => $record ? $record->user?->name : '-')
                                   ->visible(fn(?Favorite $record): bool => $record?->user ? true : false),
                       ]);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('user.name')
                                    ->label('Created By')
                                    ->searchable()
                                    ->sortable(),
                         ])
               ->filters([//
                         ]);
 }
}
