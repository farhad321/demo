<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Forms\Components\AddressForm;
use App\Models\Address\City;
use App\Models\Address\State;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\Address\_IH_City_QB;
use Livewire\Component;

class UserResource extends Resource
{
 protected static ?string $model = User::class;
 protected static ?string $recordTitleAttribute = 'name';
 protected static ?string $navigationGroup = 'General';
 protected static ?string $navigationIcon = 'heroicon-o-user-group';
 protected static ?int $navigationSort = 1;

 public static function form(Form $form): Form
 {
  return $form->schema([
                        Card::make()
                            ->schema([
                                      TextInput::make('name')
                                               ->required(),
                                      TextInput::make('email')
                                               ->required()
                                               ->email()
//                                       ->unique(ignorable: $ignoredUser)
//                                               ->rule(function (Component $livewire) {
//                                                if ($livewire instanceof Pages\CreateUser) {
//                                                 return 'unique:users,email';
//                                                }
//                                               })
//                                               ->rules(['unique:users,email'])
                                               ->unique(ignorable: fn(?Model $record): ?Model => $record),
//                                               ->unique(Customer::class, 'email', fn($record) => $record),
                                      TextInput::make('phone'),
                                      DatePicker::make('birthday'),
//                                      AddressForm::make('address')
//                                                 ->columnSpan([
//                                                               'sm' => 2,
//                                                              ]),
                                      SpatieMediaLibraryFileUpload::make('profile')
                                                                  ->collection('profile'),
                                     ])
                            ->columns([
                                       'sm' => 2,
                                      ])
                            ->columnSpan(2),
                        Card::make()
                            ->schema([
                                      Placeholder::make('created_at')
                                                 ->label('Created at')
                                                 ->content(fn(?User $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                      Placeholder::make('updated_at')
                                                 ->label('Last modified at')
                                                 ->content(fn(?User $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                                     ])
                            ->columnSpan(1),
                        Card::make()
                            ->schema([
//                                      BelongsToSelect::make('state_id')
//                                                     ->relationship('state', 'name')
//                                                     ->searchable()
//                                                     ->preload(),
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
//                                      BelongsToSelect::make('city_id')
//                                                     ->relationship('city', 'name',
//                                                      function (callable $get, Builder $query) {
//                                                       if ($get('state_id')) {
//                                                        return $query->where('state_id', $get('state_id'));
//                                                       }
//                                                       return $query;
//                                                      })
//                                                     ->searchable()
//                                                     ->preload(),
                                      TextInput::make('address'),
                                     ])
                            ->columns([
                                       'sm' => 2,
                                      ])
                            ->columnSpan(2),
                        Card::make()
                            ->schema([
                                      TextInput::make('password')
                                               ->password()
                                               ->required()
                                               ->dehydrateStateUsing(fn($state) => bcrypt($state))
                                               ->visible(fn(Component $livewire): bool => $livewire instanceof Pages\CreateUser),
//
                                     ])
                            ->visible(fn(Component $livewire): bool => $livewire instanceof Pages\CreateUser)
                            ->columns([
                                       'sm' => 2,
                                      ])
                            ->columnSpan(2),
                       ])
              ->columns(3);
 }

 public static function table(Table $table): Table
 {
  return $table->columns([
                          TextColumn::make('name')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('email')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('rule')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('state')
                                    ->getStateUsing(fn($record): ?string => $record->state?->name),
                          TextColumn::make('phone')
                                    ->searchable()
                                    ->sortable(),
                         ])
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
   'index' => Pages\ListUsers::route('/'),
   'create' => Pages\CreateUser::route('/create'),
   'edit' => Pages\EditUser::route('/{record}/edit'),
  ];
 }
}
