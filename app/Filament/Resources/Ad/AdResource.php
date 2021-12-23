<?php

namespace App\Filament\Resources\Ad;

use App\Filament\Resources\Ad\AdResource\Pages;
use App\Filament\Resources\Ad\AdResource\RelationManagers;
use App\Models\Ad\Ad;
use App\Models\Address\City;
use App\Models\Address\State;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryMultipleFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultipleFileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Livewire\Component;
use Spatie\Tags\Tag;
use Illuminate\Support\Str;

class AdResource extends Resource
{
 protected static ?string $model = Ad::class;
 protected static ?string $navigationIcon = 'heroicon-o-collection';
 protected static ?string $navigationGroup = 'Ads';

 public static function form(Form $form): Form
 {
  return $form->schema([
                        Card::make()
                            ->schema([
                                      TextInput::make('title')
                                               ->required()
                                               ->reactive()
                                               ->afterStateUpdated(fn($state, callable $set) => $set('slug',
                                                                                                     Str::slug($state))),
                                      TextInput::make('slug')
                                               ->required()
                                               ->unique(ignorable: fn(?Model $record): ?Model => $record)
                                               ->reactive()
                                               ->afterStateUpdated(fn($state, callable $set) => $set('slug',
                                                                                                     Str::slug($state))),
                                      TextInput::make('seo_title')
                                               ->required()
                                               ->maxLength(60),
                                      TextInput::make('seo_description')
                                               ->required()
                                               ->maxLength(160),
                                      TextInput::make('price')
                                               ->numeric(),
                                      Toggle::make('is_visible')
                                            ->inline(false)
//                                       ,
                                     ])
                            ->columns([
                                       'sm' => 2,
                                      ]),
                        Card::make()
                            ->schema([
                                      RichEditor::make('description')
                                                ->disableToolbarButtons([
                                                                         'attachFiles',
                                                                         'codeBlock',
                                                                        ])
                                     ])
                            ->columnSpan(3),
                        Card::make()
                            ->schema([
                                      Select::make('state_id')
                                            ->label('State')
                                            ->options(function (callable $get) {
                                             return State::all()
                                                         ->pluck('name', 'id')
                                                         ->toArray();
                                            })
                                            ->reactive()
                                            ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),
                                      Select::make('city_id')
                                            ->label('City')
                                            ->options(function (callable $get) {
                                             $state = State::find($get('state_id'));
                                             if (!$state) {
                                              return City::all()
                                                         ->pluck('name', 'id');
                                             }
                                             return $state->cities->pluck('name', 'id');
                                            }),
                                     ])
                            ->columns([
                                       'sm' => 2,
                                      ])
                            ->columnSpan(2),
                        Card::make()
                            ->schema([
                                      SpatieTagsInput::make('tags')
                                                     ->type('ad')
                                                     ->suggestions(function () {
                                                      $vars = Tag::whereType('ad')
                                                                 ->get('name')
                                                                 ->toArray();
                                                      return Arr::flatten($vars);
                                                     })
                                     ])
                            ->columnSpan(1),
                        Card::make()
                            ->schema([
                                      SpatieMediaLibraryFileUpload::make('SpecialImage')
                                                                  ->collection('SpecialImage'),
                                      SpatieMediaLibraryFileUpload::make('SpecialVideo')
                                                                  ->collection('SpecialVideo')
                                                                  ->acceptedFileTypes(['video/*']),
                                      SpatieMediaLibraryMultipleFileUpload::make('Gallery')
                                                                          ->collection('Gallery'),
                                     ])
                            ->columns([
                                       'sm' => 2,
                                      ])
                            ->columnSpan(2),
                        Card::make()
                            ->schema([
                                      Placeholder::make('user_id')
                                                 ->label('Created By')
                                                 ->content(fn(?Ad $record): string => $record && $record->user ? $record->user->name : '-'),
                                      Placeholder::make('created_at')
                                                 ->label('Created at')
                                                 ->content(fn(?Ad $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                      Placeholder::make('updated_at')
                                                 ->label('Last modified at')
                                                 ->content(fn(?Ad $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                                     ])
                            ->columnSpan(1),
                       ])
              ->columns(3);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('title')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('state')
                                    ->getStateUsing(fn($record): ?string => $record->state?->name),
                         ])
               ->filters([//
                         ]);
 }

 public static function getRelations(): array
 {
  return [
   RelationManagers\CategoriesRelationManager::class,
   RelationManagers\ReportsRelationManager::class,
   RelationManagers\FavoritesRelationManager::class,
   RelationManagers\ReviewsRelationManager::class,
   RelationManagers\AttributesRelationManager::class
  ];
 }

 public static function getPages(): array
 {
  return [
   'index' => Pages\ListAds::route('/'),
   'create' => Pages\CreateAd::route('/create'),
   'edit' => Pages\EditAd::route('/{record}/edit'),
  ];
 }
}
