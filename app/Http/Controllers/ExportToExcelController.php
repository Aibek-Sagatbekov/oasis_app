<?php

namespace App\Http\Controllers;

use App\Filament\Pages\Actions\ExportToExcelAction;
use Illuminate\Http\Request;

class ExportToExcelController extends Controller
{
    public function export(Request $request)
    {
        $exportAction = ExportToExcelAction::make(); // Создание экземпляра экшена с использованием метода make()
        $exportAction->handle(); // Вызов метода handle() экшена
        return response()->json(['message' => 'ExportToExcelAction executed']);        
    }
}