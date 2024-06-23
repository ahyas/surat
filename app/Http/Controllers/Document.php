<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class Document extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $file = public_path('template.docx');
        $templateProcessor = new TemplateProcessor($file);
        $templateProcessor->setValue('firstname', 'Ahyas');
        $templateProcessor->setValue('lastname', 'Widyatmaka');
        $templateProcessor->saveAs(storage_path('Result.docx'));
    }
}
