<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use App\Filament\Resources\Ad\CategoryResource;
use App\Models\Ad\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;

class CategoriesRelationManager extends BelongsToManyRelationManager
{
 protected static string $relationship = 'categories';
 protected static ?string $recordTitleAttribute = 'name';

 public static function form(Form $form): Form
 {
  return CategoryResource::form($form);
 }

 public static function table(Table $table): Table
 {
  $columns = [
   TextColumn::make('name')
             ->label('Name')
             ->searchable()
             ->sortable(),
   TextColumn::make('parent.name')
             ->label('Parent')
             ->searchable()
             ->sortable(),
//   TextColumn::make('parent_id')
//             ->label('Parent')
//             ->formatStateUsing(fn(string $state): string => dd($state)
//  $state?
//             Category::find($state)?->name:'-'
// )
//             ->searchable()
//             ->sortable(),
   BooleanColumn::make('is_visible')
                ->label('Visibility')
                ->sortable(),
   TextColumn::make('updated_at')
             ->label('Updated Date')
             ->date()
             ->sortable(),
  ];
  return $table->columns($columns)
               ->filters([//
                         ]);
 }
}
