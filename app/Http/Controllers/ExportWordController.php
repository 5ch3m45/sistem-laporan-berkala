<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

class ExportWordController extends Controller
{
    public function index() {
        $file = Storage::path('office/LHA_Template.docx');
        $template = new TemplateProcessor($file);
        $template->setValue('{company_name}', 'PT Maulana Anshory');
        $new_file = $template->saveAs('triump.docx');




        // $section = $phpword->addSection();
        // $section->addText('test insert text');
        // $objWriter = IOFactory::createWriter($phpword, 'Word2007');
        // header("Content-Disposition: attachment; filename=File.docx");
        // $objWriter->save('php://output');
    }
}
