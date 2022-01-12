<?php

namespace App\Filament\Resources\Ad\AdResource\RelationManagers;

use App\Models\Ad\AdAttribute;
use App\Models\Ad\Attribute;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class Attributes2RelationManager extends HasManyRelationManager
{
 protected static string $relationship = 'attrs2';
 protected static ?string $recordTitleAttribute = 'id';

 public static function form(Form $form): Form
 {
  $schema = [
   Select::make('ad_attribute_id')
         ->label('attribute')
         ->options(function (callable $get) {
          return Attribute::all()
                          ->pluck('name', 'id')
                          ->toArray();
         })
         ->searchable()
         ->placeholder('Select  attribute')
         ->disabled(function (callable $get) {
          return $get('ad_attribute_id') !== null;
         })
         ->reactive(),
   TextInput::make('text')
            ->label(function (callable $get) {
             return Attribute::find($get('ad_attribute_id'))?->name;
            })
            ->visible(function (callable $get) {
             return Attribute::find($get('ad_attribute_id'))?->type == 'Text';
            }),
   Textarea::make('text')
           ->label(function (callable $get) {
            return Attribute::find($get('ad_attribute_id'))?->name;
           })
           ->visible(function (callable $get) {
            return Attribute::find($get('ad_attribute_id'))?->type == 'Textarea';
           }),
   TextInput::make('integer')
            ->label(function (callable $get) {
             return Attribute::find($get('ad_attribute_id'))?->name;
            })
            ->numeric()
            ->visible(function (callable $get) {
             return Attribute::find($get('ad_attribute_id'))?->type == 'Price';
            }),
   Toggle::make('boolean')
         ->label(function (callable $get) {
          return Attribute::find($get('ad_attribute_id'))?->name;
         })
         ->visible(function (callable $get) {
          return Attribute::find($get('ad_attribute_id'))?->type == 'Boolean';
         }),
   /*   TextInput::make('float')
               ->label(function (callable $get) {
                return Attribute::find($get('ad_attribute_id'))?->name;
               })
               ->numeric()
               ->visible(function (callable $get) {
                return Attribute::find($get('ad_attribute_id'))?->type == 'float';
               }),*/
   Select::make('text')
         ->options(function (callable $get) {
          return Attribute::find($get('ad_attribute_id'))?->options_array;
         })
         ->label(function (callable $get) {
          return Attribute::find($get('ad_attribute_id'))?->name;
         })
         ->visible(function (callable $get) {
          return Attribute::find($get('ad_attribute_id'))?->type == 'Select';
         }),
   MultiSelect::make('json')
              ->options(function (callable $get) {
//               return [
//                'tailwind' => 'TailwindCSS',
//                'alpine' => 'Alpine.js',
//                'laravel' => 'Laravel',
//                'livewire' => 'Laravel Livewire',
//               ];
               return Attribute::find($get('ad_attribute_id'))?->options_array;
              })
              ->label(function (callable $get) {
               return Attribute::find($get('ad_attribute_id'))?->name;
              })
              ->visible(function (callable $get) {
               return Attribute::find($get('ad_attribute_id'))?->type == 'Multiselect';
              }),
   DateTimePicker::make('date_time')
                 ->label(function (callable $get) {
                  return Attribute::find($get('ad_attribute_id'))?->name;
                 })
                 ->format('Y-m-d H:i:s')
                 ->displayFormat('Y-m-d H:i:s')
                 ->rules(['date_format:Y-m-d H:i:s'])
                 ->visible(function (callable $get) {
                  return Attribute::find($get('ad_attribute_id'))?->type == 'Datetime';
                 }),
   DatePicker::make('date')
             ->format('Y-m-d')
             ->displayFormat('Y-m-d')
             ->label(function (callable $get) {
              return Attribute::find($get('ad_attribute_id'))?->name;
             })
             ->rules(['date'])
             ->visible(function (callable $get) {
              return Attribute::find($get('ad_attribute_id'))?->type == 'Date';
             }),
   FileUpload::make('text')
             ->image()
             ->label(function (callable $get) {
              return Attribute::find($get('ad_attribute_id'))?->name;
             })
             ->visible(function (callable $get) {
              return Attribute::find($get('ad_attribute_id'))?->type == 'Image';
             }),
   FileUpload::make('text')
             ->label(function (callable $get) {
              return Attribute::find($get('ad_attribute_id'))?->name;
             })
             ->visible(function (callable $get) {
              return Attribute::find($get('ad_attribute_id'))?->type == 'File';
             }),
   Checkbox::make('boolean')
           ->label(function (callable $get) {
            return Attribute::find($get('ad_attribute_id'))?->name;
           })
           ->visible(function (callable $get) {
            return Attribute::find($get('ad_attribute_id'))?->type == 'Checkbox';
           }),
  ];
  return $form->schema($schema);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('attribute.name')
                                    ->label('Attribute name')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('attribute.type')
                                    ->label('Attribute type')
                                    ->searchable()
                                    ->sortable(),
                         ])
               ->filters([//
                         ]);
 }
}
