<?php

namespace App\Filament\Resources\Ad;

use App\Filament\Resources\Ad\CategoryResource\Pages;
use App\Filament\Resources\Ad\CategoryResource\RelationManagers;
use App\Models\Ad\Category;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
 protected static ?string $model = Category::class;
 protected static ?string $navigationIcon = 'heroicon-o-collection';
 protected static ?string $navigationGroup = 'Ads';

 public static function form(Form $form): Form
 {
  $schema = [
   Card::make()
       ->schema([
                 Grid::make()
                     ->schema([
                               TextInput::make('name')
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn($state, callable $set) => $set('slug',
                                                                                              Str::slug($state))),
                               TextInput::make('slug')
                                        ->disabled()
                                        ->required()
                                        ->unique(Category::class, 'slug', fn($record) => $record),
                               Toggle::make('is_visible')
                                     ->label('Visible to customers.')
                                     ->default(true),
                               TextInput::make('position')
                                        ->default(0)
                                        ->required()
                                        ->numeric(),
                              ]),
                 TextInput::make('seo_title')
                          ->required()
                          ->maxLength(60),
                 BelongsToSelect::make('parent_id')
                                ->label('Parent')
                                ->relationship('parent', 'name')
                                ->searchable()
                                ->placeholder('Select parent category'),
                 RichEditor::make('description')
                           ->disableToolbarButtons([
                                                    'attachFiles',
                                                    'codeBlock',
                                                   ]),
                 TextInput::make('seo_description')
                          ->required()
                          ->maxLength(160),
                ])
       ->columnSpan(2),
   Card::make()
       ->schema([
                 Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?Category $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                 Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?Category $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                ])
       ->columnSpan(1),
  ];
  return $form->schema($schema)
              ->columns(3);
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

 public static function getRelations(): array
 {
  return [
   RelationManagers\AttributesRelationManager::class
  ];
 }

 public static function getPages(): array
 {
  return [
   'index' => Pages\ListCategories::route('/'),
   'create' => Pages\CreateCategory::route('/create'),
   'edit' => Pages\EditCategory::route('/{record}/edit'),
  ];
 }
}
