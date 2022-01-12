<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use App\Models\Ad\Attribute;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
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
 protected static string $relationship = 'attrs';
 protected static ?string $recordTitleAttribute = 'name';
 protected static ?string $inverseRelationship = 'ads';

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

 public static function attachForm(Form $form): Form
 {
  $schema = [
   Select::make('recordId')
         ->label('attribute')
         ->options(function (callable $get) {
          return Attribute::all()
                          ->pluck('name', 'id')
                          ->toArray();
         })
         ->searchable()
         ->placeholder('Select  attribute')
         ->reactive(),
   TextInput::make('text')
            ->visible(function (callable $get) {
             return Attribute::find($get('recordId'))?->type == 'text';
            }),
   Toggle::make('boolean')
         ->visible(function (callable $get) {
          return Attribute::find($get('recordId'))?->type == 'boolean';
         }),
   TextInput::make('integer')
            ->numeric()
            ->visible(function (callable $get) {
             return Attribute::find($get('recordId'))?->type == 'integer';
            }),
   TextInput::make('float')
            ->numeric()
            ->visible(function (callable $get) {
             return Attribute::find($get('recordId'))?->type == 'float';
            }),
   DateTimePicker::make('date_time')
                 ->rules(['date_format:Y-m-d H:i:s'])
                 ->visible(function (callable $get) {
                  return Attribute::find($get('recordId'))?->type == 'date_time';
                 }),
   DatePicker::make('date')
             ->rules(['date'])
             ->visible(function (callable $get) {
              return Attribute::find($get('recordId'))?->type == 'date';
             }),
   TextInput::make('json')
            ->rules(['json'])
            ->visible(function (callable $get) {
             return Attribute::find($get('recordId'))?->type == 'json';
            }),
  ];
  return $form->schema($schema);
 }
}
