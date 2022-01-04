<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\PostResource\Pages;
use App\Models\Blog\Post;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostResource extends Resource
{
 protected static ?string $model = Post::class;
 protected static ?string $slug = 'blog/posts';
 protected static ?string $recordTitleAttribute = 'title';
 protected static ?string $navigationGroup = 'Blog';
 protected static ?string $navigationIcon = 'heroicon-o-document-text';
 protected static ?int $navigationSort = 0;

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
                                               ->disabled()
                                               ->required()
                                               ->unique(Post::class, 'slug', fn($record) => $record),
                                      MarkdownEditor::make('content')
                                                    ->required()
                                                    ->columnSpan([
                                                                  'sm' => 2,
                                                                 ]),
                                      SpatieMediaLibraryFileUpload::make('SpecialImage')
                                                                  ->disk('ads')
                                                                  ->directory('storage/app/public/aaaaaaaaaaa4455555')
                                                                  ->collection('SpecialImage')
                                                                  ->columnSpan([
                                                                                'sm' => 2,
                                                                               ]),
                                      SpatieMediaLibraryFileUpload::make('gallery')
//                                                                  ->disk('ads')
//                                                                  ->directory('storage/app/public/aaaaaaaaaaa')
                                                                  ->multiple()
                                                                  ->collection('gallery')
                                                                  ->columnSpan([
                                                                                'sm' => 2,
                                                                               ]),
                                      BelongsToSelect::make('user_id')
                                                     ->relationship('user', 'name')
                                                     ->searchable()
                                                     ->required(),
                                      BelongsToSelect::make('blog_category_id')
                                                     ->relationship('category', 'name')
                                                     ->searchable()
                                                     ->required(),
                                      DatePicker::make('published_at')
                                                ->label('Published Date'),
                                      SpatieTagsInput::make('tags')
                                                     ->type('post')
                                                     ->required(),
                                     ])
                            ->columns([
                                       'sm' => 2,
                                      ])
                            ->columnSpan(2),
                        Card::make()
                            ->schema([
                                      Placeholder::make('created_at')
                                                 ->label('Created at')
                                                 ->content(fn(?Post $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                      Placeholder::make('updated_at')
                                                 ->label('Last modified at')
                                                 ->content(fn(?Post $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
                          TextColumn::make('slug')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('user.name')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('category.name')
                                    ->searchable()
                                    ->sortable(),
                          TextColumn::make('published_at')
                                    ->label('Published Date')
                                    ->date(),
                         ])
               ->filters([
                          Tables\Filters\Filter::make('published_at')
                                               ->form([
                                                       DatePicker::make('published_from')
                                                                 ->placeholder(fn($state): string => 'Dec 18, ' . now()
                                                                   ->subYear()
                                                                   ->format('Y')),
                                                       DatePicker::make('published_until')
                                                                 ->placeholder(fn($state): string => now()->format('M d, Y')),
                                                      ])
                                               ->query(function (Builder $query, array $data): Builder {
                                                return $query->when($data['published_from'],
                                                 fn(Builder $query, $date): Builder => $query->whereDate('published_at',
                                                                                                         '>=', $date),)
                                                             ->when($data['published_until'], fn(Builder $query,
                                                                                                         $date): Builder => $query->whereDate('published_at',
                                                                                                                                              '<=',
                                                                                                                                              $date),);
                                               }),
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
   'index' => Pages\ListPosts::route('/'),
   'create' => Pages\CreatePost::route('/create'),
   'edit' => Pages\EditPost::route('/{record}/edit'),
  ];
 }

 protected static function getGlobalSearchEloquentQuery(): Builder
 {
  return parent::getGlobalSearchEloquentQuery()
               ->with([
                       'user',
                       'category'
                      ]);
 }

 public static function getGloballySearchableAttributes(): array
 {
  return [
   'title',
   'slug',
   'user.name',
   'category.name'
  ];
 }

 public static function getGlobalSearchResultDetails(Model $record): array
 {
  $details = [];
  if ($record->user) {
   $details['User'] = $record->user->name;
  }
  if ($record->category) {
   $details['Category'] = $record->category->name;
  }
  return $details;
 }
}
