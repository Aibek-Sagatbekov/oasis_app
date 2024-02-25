<?php

// app/Filament/Pages/Actions/ExportToExcelAction.php

namespace App\Filament\Pages\Actions;

use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use app\Exports\ExcellExportClass;

class ExportToExcelAction extends Action
{
    public static $actionName  = 'exportToExcel';
    
    public function handle()
    {
        dd('ExportToExcelAction executed');
        $data = [
            ['Name' => 'John Doe', 'Email' => 'john@example.com'],
            ['Name' => 'Jane Smith', 'Email' => 'jane@example.com'],
        ];
        return Excel::download(new ExcellExportClass($data), 'contracts.xlsx');
    }
    
}