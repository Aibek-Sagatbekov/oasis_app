<?php

namespace App\Filament\Profile\Profile;

use RyanChandler\FilamentProfile\Pages\Profile;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class OasisProfile extends Profile implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Account';

    protected static string $view = 'filament-profile::filament.pages.profile';

    public $name;

    public $email;

    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    protected static function getNavigationLabel(): string
    {
        return trans('filament-user::user.profile.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.profile.plural_label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.profile.single');
    }

    protected function getTitle(): string
    {
        return trans('filament-user::user.profile.title');
    }

    protected static function getNavigationGroup(): ?string
    {
        // return config('filament-user.group');
        return __('filament-shield::filament-shield.nav.group');
    }

    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function submit()
    {
        $this->form->getState();

        $state = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
        ]);

        $user = auth()->user();

        $user->update($state);

        if ($this->new_password) {
            $this->updateSessionPassword($user);
        }

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->notify('success', 'Your profile has been updated.');
    }

    protected function updateSessionPassword($user)
    {
        request()->session()->put([
            'password_hash_' . auth()->getDefaultDriver() => $user->getAuthPassword(),
        ]);
    }

    public function getCancelButtonUrlProperty()
    {
        return static::getUrl();
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Profile',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('filament-user::user.section.general.title'))
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label(trans('filament-user::user.resource.name'))
                        ->required(),
                    TextInput::make('email')
                        ->label(trans('filament-user::user.resource.email'))
                        ->required(),
                ]),
            Section::make(__('filament-user::user.section.update_password.title'))
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label(trans('filament-user::user.resource.current_password'))
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label(trans('filament-user::user.resource.new_password'))
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label(trans('filament-user::user.resource.new_password_confirmation'))
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }
}
