<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use App\Models\Ad\Ad;
use App\Models\Ad\Report;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ReportsRelationManager extends HasManyRelationManager
{
 protected static string $relationship = 'reports';
 protected static ?string $recordTitleAttribute = 'id';

 public static function form(Form $form): Form
 {
  return $form->schema([
                        TextInput::make('title')
                                 ->required(),
                        BelongsToSelect::make('user_id')
                                       ->visible(fn(?Report $record): bool => $record?->user ? false : true)
                                       ->relationship('user', 'name',
                                        fn(Builder $query) => $query->where('rule', 'admin'))
                                       ->default(function () {
                                        return User::where('rule', 'admin')
                                                   ->first()->id;
                                       }),
                        Placeholder::make('user_id')
                                   ->label('Created By')
                                   ->content(fn(?Report $record): string => $record ? $record->user?->name : '-')
                                   ->visible(fn(?Report $record): bool => $record?->user ? true : false),
                       ]);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('title')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('user_id')
                                    ->label('User Name')
                                    ->formatStateUsing(fn(string $state): string => User::find($state)->name)
                                    ->searchable()
                                    ->sortable(),
                         ])
               ->filters([//
                         ]);
 }
}
