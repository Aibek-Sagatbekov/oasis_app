<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\DatePicker;


use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Filament\Forms\Components\TextInput\Mask;
use STS\FilamentImpersonate\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static function getNavigationLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.resource.single');
    }

    protected static function getNavigationGroup(): ?string
    {
        // return config('filament-user.group');
        return __('filament-shield::filament-shield.nav.group');
    }

    protected function getTitle(): string
    {
        return trans('filament-user::user.resource.title.resource');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            Group::make()
                ->schema([
                    Section::make(__('filament-user::user.section.general.title'))
                        ->label(__('filament-user::user.section.general.title'))
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->label(trans('filament-user::user.resource.name')),

                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->label(trans('filament-user::user.resource.email')),

                            Forms\Components\TextInput::make('password')
                                ->label(trans('filament-user::user.resource.password'))
                                ->password()
                                ->maxLength(255)
                                ->dehydrateStateUsing(static function ($state) use ($form) {
                                    if (!empty($state)) {
                                        return Hash::make($state);
                                    }
                                    $user = User::find($form->getColumns());
                                    if ($user) {
                                        return $user->password;
                                    }
                                }),
                        ]),
                ])
                ->columns(1)
                ->columnSpan(['lg' => fn () => !config('filament-user.shield') ? 'full' : 1]),

            Group::make()
                ->schema([
                    Section::make(__('filament-user::user.section.roles.title'))
                        ->label(__('filament-user::user.section.roles.title'))
                        ->schema([
                            Select::make('roles')->relationship('roles', 'name')
                                ->multiple()
                                ->label(trans('filament-user::user.resource.roles')),
                        ]),
                ])
                ->columnSpan(['lg' => 1])
                ->hidden(fn () => (!config('filament-user.shield') or !auth()->user()->isAdmin())),

        ];

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                TextColumn::make('id')
                    ->label(trans('filament-user::user.resource.id'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label(trans('filament-user::user.resource.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label(trans('filament-user::user.resource.email'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TagsColumn::make('roles.name')
                    ->label(trans('filament-user::user.resource.roles'))
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')->label(trans('filament-user::user.resource.created_at'))
                    ->dateTime('M j, Y')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('updated_at')->label(trans('filament-user::user.resource.updated_at'))
                    ->dateTime('M j, Y')
                    ->toggleable()
                    ->sortable(),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->filters([
                // Tables\Filters\Filter::make('verified')
                //     ->label(trans('filament-user::user.resource.verified'))
                //     ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                // Tables\Filters\Filter::make('unverified')
                //     ->label(trans('filament-user::user.resource.unverified'))
                //     ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ]);

        if (config('filament-user.impersonate')) {
            $table->prependActions([
                Impersonate::make('impersonate'),
            ]);
        }

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/view/{record}'),
        ];
    }
}
