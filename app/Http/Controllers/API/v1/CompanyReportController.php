<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Report;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use PhpOffice\PhpWord\TemplateProcessor;

class CompanyReportController extends Controller
{
    public function show(Request $request) {
        $callback_data = 'data';

        $report = Report::select('id', 'company_id', 'year', 'quarter', DB::raw('year + quarter/10 as periode'))->where('company_id', $request->company_id);

        if(isset($request->year)) {
            $report = $report->where('year', $request->year);
        }

        if(isset($request->quarter)) {
            $report = $report->where('quarter', $request->quarter);
        }

        if(isset($request->from_year)) {
            $report = $report->where('year', '>=', $request->from_year);
        }

        if(isset($request->from_quarter)) {
            $report = $report->where('quarter', '>=', $request->from_quarter);
        }

        if(isset($request->to_year)) {
            $report = $report->where('year', '<=', $request->to_year)->where('quarter', '<=', 4);
        }

        if(isset($request->to_quarter) && isset($request->to_year)) {

            $report = $report->whereRaw('year + quarter/10 <= '.$request->to_year.'.'.$request->to_quarter);
        }

        if(isset($request->account_code)) {
            $callback_data = ['data' => function($q) use($request) {
                $q->where('account_code', $request->account_code);
            }];
        }

        $report = $report->orderByDesc('year')->orderByDesc('quarter')->with($callback_data);
        
        if(isset($request->limit)) {
            $report = $report->limit($request->limit);
        }
        
        $report = $report->get();
        return response()->json(compact('report'), 200);
    }

    public function integerFormat($value) {
        if(intval($value)) {
            return intval($value);
        }
        return $value;
    }

    public function percentFormat($value) {
        if(floatval($value)) {
            return number_format(floatval($value), 2, ',', '.').'%';
        }
        return $value;
    }

    public function exportWord(Request $request) {
        $company = Company::find($request->company);
        $last_report = $company->reports()->orderByDesc('id')->first();
        $company_data = [
            'cname' => $company->name,
            'caddress' => $company->add_road.', '.$company->add_village.', '.$company->add_subdistrict.', '.$company->add_province.', '.$company->postalcode,
            'cphone' => $company->phone,
            'clic_number' => $company->lic_number,
            'clic_date' => $company->lic_date,
            'ctax_number' => $company->tax_number,
            'cregion' => $company->regional,
            'cemail' => $company->email,
            'ccontact_person_name' => $last_report->cp_name ?? '',
            'ccontact_person_position' => $last_report->cp_position ?? '',
            'ccontact_person_phone' => $last_report->cp_phone ?? '',
            'cemployename#1' => isset(($company->employes)[0]) ? ($company->employes)[0]->name : '',
            'cemployename#2' => isset(($company->employes)[1]) ? ($company->employes)[1]->name : '',
            'cemployename#3' => isset(($company->employes)[2]) ? ($company->employes)[2]->name : '',
            'cemployename#4' => isset(($company->employes)[3]) ? ($company->employes)[3]->name : '',
            'cemployepos#1' => isset(($company->employes)[0]) ? ($company->employes)[0]->position : '',
            'cemployepos#2' => isset(($company->employes)[1]) ? ($company->employes)[1]->position : '',
            'cemployepos#3' => isset(($company->employes)[2]) ? ($company->employes)[2]->position : '',
            'cemployepos#4' => isset(($company->employes)[3]) ? ($company->employes)[3]->position : '',
        ];
        $report_info = [
            'quarter' => $request->report_quarter,
            'year' => $request->report_year,
            'capt#1' => $request->quarter_caption[0],
            'capt#4' => $request->quarter_caption[3],
            'capt#5' => $request->quarter_caption[4],
            'rperiode' => $last_report->periode,
            'rdate' => $last_report->repoted_at,
            'rdate_cond' => strtotime($last_report->periode) - strtotime($last_report->reported_at) < 0 ? 'belum' : 'telah',
        ];

        
        $data_keys = ['ksk', 'pdg', 'all', 'al', 'atl', 'ta', 'll', 'ltl', 'tl', 'md', 
        'slr', 'slrat', 'lrtb', 'te', 'pij', 'pa', 'po', 'pno', 'jp', 'bo',
        'bno', 'jb', 'lrsp', 'tpp', 'lrpb', 'pyd', 'jpyd', 'jog', 'jn', 
        'cr', 'der', 'dar', 'roa', 'roe', 'bopo'];
        $data_values = $request->data;
        $report_data = array();
        for ($i=0; $i < count($data_keys); $i++) { 
            for ($j=0; $j < count($data_values[$j]['value']); $j++) {
                if ($j < 5) {
                    if ($i < 29) {
                        $report_data[$data_keys[$i].'#'.$j+1] = $this->integerFormat($data_values[$i]['value'][$j]); // akun-akun
                    } else {
                        $report_data[$data_keys[$i].'#'.$j+1] = $this->percentFormat($data_values[$i]['value'][$j]); // ratio-ratio
                    }
                } else {
                    $report_data[$data_keys[$i].'#'.$j+1] = $data_values[$i]['value'][$j]; // ratio-ratio
                }
            }
        }
        
        $condition_data = [
            'laba_rugi_cond' => $report_data['lrpb#4'] < 0 ? 'rugi' : 'laba', // lrpb adalah index ke 24, q5 adalah index ke 4
            'laba_rugi_incr' => abs(round($report_data['lrpb#5']/1000)),
            'ta_incr' => abs(round(($report_data['ta#5'] - $report_data['ta#4'])/1000)),
            'ta_cond' => $report_data['ta#5'] - $report_data['ta#4'] < 0 ? 'turun' : 'naik',
            'tl_incr' => abs(round(($report_data['tl#5'] - $report_data['tl#4'])/1000)),
            'tl_cond' => $report_data['tl#5'] - $report_data['tl#4'] < 0 ? 'turun' : 'naik',
            'te_incr' => abs(round(($report_data['te#5'] - $report_data['te#4'])/1000)),
            'te_cond' => $report_data['te#5'] - $report_data['te#4'] < 0 ? 'turun' : 'naik',
            'bo_incr' => abs(round(($report_data['bo#5'] - $report_data['bo#4'])/1000)),
            'bo_cond' => $report_data['bo#5'] - $report_data['bo#4'] < 0 ? 'turun' : 'naik',
            'po_incr' => abs(round(($report_data['po#5'] - $report_data['po#4'])/1000)),
            'po_cond' => $report_data['po#5'] - $report_data['po#4'] < 0 ? 'turun' : 'naik',
            'jpyd#5jt' => abs(round($report_data['jpyd#5']/1000)),
            'jog#5jt' => abs(round($report_data['jog#5']/1000)),
        ];

        $file = Storage::path('office/LHA_Template.docx');
        $template = new TemplateProcessor($file);
        $template->setValues($company_data);
        $template->setValues($report_info);
        $template->setValues($report_data);
        $template->setValues($condition_data);
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Access-Control-Expose-Headers: X-Suggested-Filename');
        header('Content-Disposition: attachment; filename="Analisis Tahunan Triwulan '.$last_report->quarter.' '.$last_report->year.' '.$company->name.'.docx"');
        return $template->saveAs('php://output');
    }

    public function findAccount($collection, $account) {
        return array_reverse(($collection->where('account', $account)->first())['value']);
    }
    
    public function dataWriter($worksheet, $array) {
        foreach ($array as $key => $value) {
            $worksheet->getCell($key)->setValue($value);
        }
    }

    public function exportExcel() {
        $company = Company::find(1);
        $reports = $company->reports()->with('data')->orderByDesc('year')->orderByDesc('quarter')->limit(5)->get();
        $formated_data = array();
        foreach ($reports as $i => $report) {
            foreach ($report->data as $j => $data) {
                if($i == 0) {
                    array_push($formated_data, array('account' => $data->account_code, 'value' => array($data->value)));
                } else {
                    array_push($formated_data[$j]['value'], $data->value);
                }
            }
        }
        $collectible = collect($formated_data);

        $company_info = [
            'E5' => $company->name,
            'E6' => 'Triwulan '.$reports[0]->quarter.' '.$reports[0]->year,
            'E9' => $company->name,
            'E10' => $company->add_road.', '.$company->add_village.', '.$company->add_subdistrict.', '.$company->add_province.', '.$company->postalcode,
            'E11' => $company->phone,
            'E12' => $company->lic_number.' '.$company->lic_date,
            'E13' => $company->birthdate,
            'E14' => $company->tax_number,
            'E15' => $company->lic_number.' '.$company->lic_date,
            'E16' => $company->regional,
            'E17' => isset(($company->employes)[0]) ? ($company->employes)[0]->name.' : '.($company->employes)[0]->position : '',
            'E18' => isset(($company->employes)[1]) ? ($company->employes)[1]->name.' : '.($company->employes)[1]->position : '',
            'E19' => isset(($company->employes)[2]) ? ($company->employes)[2]->name.' : '.($company->employes)[2]->position : '',
            'E20' => isset(($company->employes)[3]) ? ($company->employes)[3]->name.' : '.($company->employes)[3]->position : '',
            'E21' => $reports[0]->cp_name,
            'E22' => $reports[0]->cp_position,
            'E23' => $reports[0]->cp_phone,
            'E24' => $reports[0]->cp_email,
        ];
        
        $file = Storage::path('excel/T.xlsx');
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->setActiveSheetIndex(0);
        $this->dataWriter($worksheet, $company_info);
        $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_KSK'), null, 'J8');
        // $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_I'), null, 'J9');
        $worksheet->fromArray($this->findAccount($collectible, 'LO_PDG_TOTAL_OPG'), null, 'J10');
        $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_PMHD'), null, 'J11');
        $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_BDD'), null, 'J12');
        $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_ALL'), null, 'J13');
        $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_BDD'), null, 'J12');
        $worksheet->fromArray($this->findAccount($collectible, 'LPK_A_AL_BDD'), null, 'J12');
        $downloadable = new WriterXlsx($spreadsheet);
        $downloadable = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="nomaden.xlsx"');
        header('Cache-Control: max-age=0');
        $downloadable->save('report.xlsx');
        return response()->json(['url' => '/report.xlsx']);
    }
}
