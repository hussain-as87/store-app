<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelController extends Controller
{
    public function export()
    {
        //return Excel::download(new UsersExport,'users.xlsx');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'name');
        $sheet->setCellValue('C1', 'email');
        $sheet->setCellValue('D1', 'created_at');
        $sheet->setCellValue('E1', 'updated_at');

        $row = 2;

        foreach (User::all() as $user) {
            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $sheet->setCellValue('D' . $row, $user->created_at);
            $sheet->setCellValue('E' . $row, $user->updated_at);
            $row++;
        }
        $excel_file = response()->streamDownload(function () use ($spreadsheet) {
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }, 'users.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-oficedocument.spreadsheetml.sheet']);

        return $excel_file;
    }

    public function import()
    {
        /*  $spreadsheet = new Spreadsheet();
        $reader = IOFactory::createReaderForFile(public_path('users (6).xlsx'));
        $spreadsheet = $reader->load(public_path('users (6).xlsx'));

        dd($spreadsheet->getActiveSheet()->toArray()); */

        Excel::import(new UsersImport, public_path('users (6).xlsx'));
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
