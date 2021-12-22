<?php

namespace App\Filament\Resources\Ad;

use App\Filament\Resources\Ad\AdResource\RelationManagers\ReportsRelationManager;
use App\Filament\Resources\Ad\ReportResource\Pages;
use App\Filament\Resources\Ad\ReportResource\RelationManagers;
use App\Models\Ad\Report;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class ReportResource extends Resource
{
 protected static ?string $model = Report::class;
 protected static ?string $navigationIcon = 'heroicon-o-collection';
 protected static ?string $navigationGroup = 'Ads';

 public static function form(Form $form): Form
 {
  $schema = [
   TextInput::make('title')
            ->required(),
   BelongsToSelect::make('user_id')
                  ->visible(fn(?Report $record): bool => $record?->user ? false : true)
                  ->relationship('user', 'name', fn(Builder $query) => $query->where('rule', 'admin'))
                  ->default(function () {
                   return User::where('rule', 'admin')
                              ->first()->id;
                  }),
   BelongsToSelect::make('ad_id')
                  ->visible(fn(?Report $record): bool => $record?->ad ? false : true)
                  ->relationship('ad', 'title')
                  ->searchable(),
   Placeholder::make('user_id')
              ->label('Created By')
              ->content(fn(?Report $record): string => $record ? $record->user?->name : '-')
              ->visible(fn(?Report $record): bool => $record?->user ? true : false),
   Placeholder::make('ad_id')
              ->label('Ad Title')
              ->content(fn(?Report $record): string => $record ? $record->ad?->title : '-')
              ->visible(fn(?Report $record): bool => $record?->ad ? true : false),
  ];
  return $form->schema($schema);
 }

 public static function table(Table $table): Table
 {
  $columns = [
   TextColumn::make('title')
             ->searchable()
             ->sortable(),
   TextColumn::make('user.name')
             ->label('Created By')
             ->searchable()
             ->sortable(),
   TextColumn::make('ad.title')
             ->label('Ad')
             ->searchable()
             ->sortable(),
  ];
  return $table->columns($columns)
               ->filters([//
                         ]);
 }

 public static function getRelations(): array
 {
  return [//
  ];
 }

 public static function getPages(): array
 {
  return [
   'index' => Pages\ListReports::route('/'),
   'create' => Pages\CreateReport::route('/create'),
   'edit' => Pages\EditReport::route('/{record}/edit'),
  ];
 }
}
