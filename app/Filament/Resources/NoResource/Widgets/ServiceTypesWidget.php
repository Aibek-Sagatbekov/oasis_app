<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\ServiceType;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use SolutionForest\FilamentTree\Actions\Action;
use SolutionForest\FilamentTree\Actions\ActionGroup;
use SolutionForest\FilamentTree\Actions\DeleteAction;
use SolutionForest\FilamentTree\Actions\EditAction;
use SolutionForest\FilamentTree\Actions\ViewAction;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;

class ServiceTypesWidget extends BaseWidget
{
    protected static string $model = ServiceType::class;

    protected static int $maxDepth = 10;

    protected ?string $treeTitle = 'Иерархия Видов Услуг';

    protected bool $enableTreeTitle = true;

    protected $listeners = ['updateServiceTypesWidget' => '$refresh'];

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title'),
        ];
    }

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    // public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    // {
    //     return null;
    // }

    // CUSTOMIZE ACTION OF EACH RECORD, CAN DELETE 
    protected function getTreeActions(): array
    {
        return [
            DeleteAction::make()->after(function () {
                $this->emit('refreshListServiceTypes');
            }),
        ];
    }
    // OR OVERRIDE FOLLOWING METHODS
    //protected function hasDeleteAction(): bool
    //{
    //    return true;
    //}
    //protected function hasEditAction(): bool
    //{
    //    return true;
    //}
    //protected function hasViewAction(): bool
    //{
    //    return true;
    //}
}
