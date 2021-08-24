<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Employe;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class AnalysisController extends Controller {

    public function index(Company $company) {
        $latest_report = Report::where('company_id', $company->id)
            ->orderByDesc('year')
            ->orderByDesc('quarter')
            ->first();
        return view('company.analysis.index', compact('company', 'latest_report'));
    }

    public function numberToRoman($number) {
        switch ($number) {
            case '1':
                return 'I';
            
            case '2':
                return 'II';
            
            case '3':
                return 'III';
            
            case '4':
                return 'IV';
            
            default:
                return 'I';
            }
        }

    public function getValueByAccountCode($collection, $account_code) {
        return array_search($account_code, array_column(
            json_decode(
                json_encode($collection)
            ),
            'account_code'
        ));
    }

    /**
     * Fungsi saveDivider digunakan untuk mengamankan operasi
     * pembagian matematika. Suatu angka yang dibagi dengan angka 0
     * akan menimbulkan error pada program. Sehingga jika pembagi
     * adalah 0, maka hasilnya 0 atau infinite.
     */
    public function saveDivider ($the_number, $divider) {
        if ($divider == 0) {
            return 0;
        }
        
        return $the_number/$divider;
    }

    /**
     * Fungsi ini digunakan untuk menghitung persentase kenaikan
     * atau penurunan dari periode sebelumnya ($basic), dengan periode
     * selanjutnya ($delta)
     * 
     * Contoh input:
     *  $basic = 100
     *  $delta = 50
     * 
     * Contoh output:
     *  $result = (50-100)/100 = -50/100 = -0.5
     */
    public function getPercentage($basic, $delta) {
        // return dd($basic, $delta);
        return $this->saveDivider($delta - $basic, $basic)*100;
    }

    /**
     * Fungsi nFormat digunakan untuk memformat angka dengan titik.
     * 
     * Contoh input: -1000000,99
     * Contoh output: -1.000.000,99
     * 
     * Dikombinasikan dengan fungsi ifNegatif menjadi
     * 
     */
    public function nFormat($number, $comma) {
        return number_format($number, $comma, ',', '.');
    }

    /**
     * Fungsi ifNegative berguna untuk menambah round brecket "()"
     * pada angka negatif.
     * 
     * Contoh input: -1000,99
     * Contoh output: (1000,99)
     * 
     * Dikombinasikan dengan nFormat menjadi
     * Contoh output: (1.000,99)
     */
    public function ifNegative($number, $comma = 0) {
        if($number < 0) {
            return '('.$this->nFormat($number*(-1), $comma).')';
        }
        return $this->nFormat($number, $comma);
    }

    /**
     * Fungsi exportWord digunakan untuk mengeksport data ke word
     */
    public function exportWord(Company $company, Request $request) {
        $latest_report = Report::where('company_id', $company->id)
            ->orderByDesc('year')
            ->orderByDesc('quarter')
            ->limit(5)
            ->get();
            

        $q1 = $latest_report[4];
        $q2 = $latest_report[1];
        $q3 = $latest_report[0];

        $ACC_KSK = 'LPK_A_AL_KSK';
        $ACC_PDG = 'LO_PDG_TOTAL_OPG';
        $ACC_ALL = 'LPK_A_AL_ALL';
        $ACC_AL = 'LPK_A_TOTAL_AL';
        $ACC_ATL = 'LPK_A_TOTAL_ATL';
        $ACC_TA = 'LPK_A_TOTAL';
        $ACC_LL = 'LPK_L_TOTAL_LL';
        $ACC_LTL = 'LPK_L_TOTAL_LTL';
        $ACC_TL = 'LPK_L_TOTAL';
        $ACC_MD = 'LPK_E_MD';
        $ACC_SLRAT = 'LPK_E_SLR_SLRAT';
        $ACC_LRTB = 'LPK_E_SLR_LRTB';
        $ACC_TE = 'LPK_E_TOTAL';
        $ACC_PIJIH = 'LAK_AKDAO_PKD_PJ';
        $ACC_PA = 'LAK_AKDAO_PKD_PA';
        $ACC_PO = 'LRK_P_TOTAL_PO';
        $ACC_PNO = 'LRK_P_TOTAL_PNO';
        $ACC_JP = 'LRK_P_TOTAL';
        $ACC_BO = 'LRK_B_TOTAL_BO';
        $ACC_BNO = 'LRK_B_BNO';
        $ACC_JB = 'LRK_B_TOTAL';
        $ACC_LRSP = 'LRK_B_LRSP';
        $ACC_TPP = 'LRK_TPP';
        $ACC_LRPB = 'LRK_LRPB';
        $ACC_JOG = 'LO_PDG_TOTAL_OPG';
        $ACC_JPD = 'LO_PDG_TOTAL_UPG';
        $ACC_JN = 'LO_PDG_TOTAL_N';
        $ACC_TPP = 'LRK_TPP';

        $company_cp = Employe::where(['company_id' => $company->id, 'is_contact_person' => 1])->first();
        $company_member = Employe::where(['company_id' => $company->id, 'is_contact_person' => 0])->limit(4)->get();

        /**
         * Kode berikut digunakan untuk mengatur local time
         */
        setlocale(LC_ALL, 'id-ID', 'id_ID');

        $data_to_write = array(
            'company_name' => $company->name,
            'company_address' => $company->add_road.', '.$company->add_village.', '.$company->add_subdistrict.', '.$company->add_province.', '.$company->postalcode,
            'company_phone' => $company->phone,
            'company_lic_number' => $company->lic_number,
            'company_lic_date' => $company->lic_date,
            'company_tax_number' => $company->tax_number,
            'company_region' => $company->regional,
            'company_email' => $company->email,
            'company_contact_person_name' => $company_cp ? $company_cp->name : '',
            'company_contact_person_position' => $company_cp ? $company_cp->position : '',
            'company_contact_person_phone' => $company_cp ? $company_cp->phone : '',
            'company_member_name_1' => count($company_member) == 1 ? $company_member[0]->name : '',
            'company_member_name_2' => count($company_member) == 2 ? $company_member[1]->name : '',
            'company_member_name_3' => count($company_member) == 3 ? $company_member[2]->name : '',
            'company_member_name_4' => count($company_member) == 4 ? $company_member[3]->name : '',
            'company_member_position_1' => count($company_member) == 1 ? $company_member[0]->position : '',
            'company_member_position_2' => count($company_member) == 2 ? $company_member[1]->position : '',
            'company_member_position_3' => count($company_member) == 3 ? $company_member[2]->position : '',
            'company_member_position_4' => count($company_member) == 4 ? $company_member[3]->position : '',
            'quarter' => $this->numberToRoman($q3->quarter),
            'year' => $q3->year,
            'ksk1' => $this->ifNegative($q1->data->where('account_code', $ACC_KSK)->first()->value),
            'ksk2' => $this->ifNegative($q2->data->where('account_code', $ACC_KSK)->first()->value),
            'ksk3' => $this->ifNegative($q3->data->where('account_code', $ACC_KSK)->first()->value),
            'ksky' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_KSK)->first()->value,
                $q3->data->where('account_code', $ACC_KSK)->first()->value,
            ), 2),
            'kskq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_KSK)->first()->value,
                $q3->data->where('account_code', $ACC_KSK)->first()->value,
            ), 2),
            'pdg1' => $this->ifNegative($q1->data->where('account_code', $ACC_PDG)->first()->value),
            'pdg2' => $this->ifNegative($q2->data->where('account_code', $ACC_PDG)->first()->value),
            'pdg3' => $this->ifNegative($q3->data->where('account_code', $ACC_PDG)->first()->value),
            'pdgy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_PDG)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value,
            ), 2),
            'pdgq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_PDG)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value,
            ), 2),
            'all1' => $this->ifNegative($q1->data->where('account_code', $ACC_ALL)->first()->value),
            'all2' => $this->ifNegative($q2->data->where('account_code', $ACC_ALL)->first()->value),
            'all3' => $this->ifNegative($q3->data->where('account_code', $ACC_ALL)->first()->value),
            'ally' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_ALL)->first()->value,
                $q3->data->where('account_code', $ACC_ALL)->first()->value,
            ), 2),
            'allq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_ALL)->first()->value,
                $q3->data->where('account_code', $ACC_ALL)->first()->value,
            ), 2),
            'al1' => $this->ifNegative($q1->data->where('account_code', $ACC_AL)->first()->value),
            'al2' => $this->ifNegative($q2->data->where('account_code', $ACC_AL)->first()->value),
            'al3' => $this->ifNegative($q3->data->where('account_code', $ACC_AL)->first()->value),
            'aly' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_AL)->first()->value,
                $q3->data->where('account_code', $ACC_AL)->first()->value,
            ), 2),
            'alq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_AL)->first()->value,
                $q3->data->where('account_code', $ACC_AL)->first()->value,
            ), 2),
            'atl1' => $this->ifNegative($q1->data->where('account_code', $ACC_ATL)->first()->value),
            'atl2' => $this->ifNegative($q2->data->where('account_code', $ACC_ATL)->first()->value),
            'atl3' => $this->ifNegative($q3->data->where('account_code', $ACC_ATL)->first()->value),
            'atly' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_ATL)->first()->value,
                $q3->data->where('account_code', $ACC_ATL)->first()->value,
            ), 2),
            'atlq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_ATL)->first()->value,
                $q3->data->where('account_code', $ACC_ATL)->first()->value,
            ), 2),
            'ta1' => $this->ifNegative($q1->data->where('account_code', $ACC_TA)->first()->value),
            'ta2' => $this->ifNegative($q2->data->where('account_code', $ACC_TA)->first()->value),
            'ta3' => $this->ifNegative($q3->data->where('account_code', $ACC_TA)->first()->value),
            'tay' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_TA)->first()->value,
                $q3->data->where('account_code', $ACC_TA)->first()->value,
            ), 2),
            'taq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_TA)->first()->value,
                $q3->data->where('account_code', $ACC_TA)->first()->value,
            ), 2),
            'll1' => $this->ifNegative($q1->data->where('account_code', $ACC_LL)->first()->value),
            'll2' => $this->ifNegative($q2->data->where('account_code', $ACC_LL)->first()->value),
            'll3' => $this->ifNegative($q3->data->where('account_code', $ACC_LL)->first()->value),
            'lly' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_LL)->first()->value,
                $q3->data->where('account_code', $ACC_LL)->first()->value,
            ), 2),
            'llq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_LL)->first()->value,
                $q3->data->where('account_code', $ACC_LL)->first()->value,
            ), 2),
            'ltl1' => $this->ifNegative($q1->data->where('account_code', $ACC_LTL)->first()->value),
            'ltl2' => $this->ifNegative($q2->data->where('account_code', $ACC_LTL)->first()->value),
            'ltl3' => $this->ifNegative($q3->data->where('account_code', $ACC_LTL)->first()->value),
            'ltly' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_LTL)->first()->value,
                $q3->data->where('account_code', $ACC_LTL)->first()->value,
            ), 2),
            'ltlq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_LTL)->first()->value,
                $q3->data->where('account_code', $ACC_LTL)->first()->value,
            ), 2),
            'tl1' => $this->ifNegative($q1->data->where('account_code', $ACC_TL)->first()->value),
            'tl2' => $this->ifNegative($q2->data->where('account_code', $ACC_TL)->first()->value),
            'tl3' => $this->ifNegative($q3->data->where('account_code', $ACC_TL)->first()->value),
            'tly' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_TL)->first()->value,
                $q3->data->where('account_code', $ACC_TL)->first()->value,
            ), 2),
            'tlq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_TL)->first()->value,
                $q3->data->where('account_code', $ACC_TL)->first()->value,
            ), 2),
            'md1' => $this->ifNegative($q1->data->where('account_code', $ACC_MD)->first()->value),
            'md2' => $this->ifNegative($q2->data->where('account_code', $ACC_MD)->first()->value),
            'md3' => $this->ifNegative($q3->data->where('account_code', $ACC_MD)->first()->value),
            'mdy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_MD)->first()->value,
                $q3->data->where('account_code', $ACC_MD)->first()->value,
            ), 2),
            'mdq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_MD)->first()->value,
                $q3->data->where('account_code', $ACC_MD)->first()->value,
            ), 2),
            'slr1' => $this->ifNegative($q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value),
            'slr2' => $this->ifNegative($q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value),
            'slr3' => $this->ifNegative($q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value),
            'slry' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ), 2),
            'slrq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ), 2),
            'slrat1' => $this->ifNegative($q1->data->where('account_code', $ACC_SLRAT)->first()->value),
            'slrat2' => $this->ifNegative($q2->data->where('account_code', $ACC_SLRAT)->first()->value),
            'slrat3' => $this->ifNegative($q3->data->where('account_code', $ACC_SLRAT)->first()->value),
            'slraty' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_SLRAT)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value,
            ), 2),
            'slratq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_SLRAT)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value,
            ), 2),
            'lrtb1' => $this->ifNegative($q1->data->where('account_code', $ACC_LRTB)->first()->value),
            'lrtb2' => $this->ifNegative($q2->data->where('account_code', $ACC_LRTB)->first()->value),
            'lrtb3' => $this->ifNegative($q3->data->where('account_code', $ACC_LRTB)->first()->value),
            'lrtby' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ), 2),
            'lrtbq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ), 2),
            'te1' => $this->ifNegative($q1->data->where('account_code', $ACC_TE)->first()->value),
            'te2' => $this->ifNegative($q2->data->where('account_code', $ACC_TE)->first()->value),
            'te3' => $this->ifNegative($q3->data->where('account_code', $ACC_TE)->first()->value),
            'tey' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_TE)->first()->value,
                $q3->data->where('account_code', $ACC_TE)->first()->value,
            ), 2),
            'teq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_TE)->first()->value,
                $q3->data->where('account_code', $ACC_TE)->first()->value,
            ), 2),
            'pijih1' => $this->ifNegative($q1->data->where('account_code', $ACC_PIJIH)->first()->value),
            'pijih2' => $this->ifNegative($q2->data->where('account_code', $ACC_PIJIH)->first()->value),
            'pijih3' => $this->ifNegative($q3->data->where('account_code', $ACC_PIJIH)->first()->value),
            'pijihy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_PIJIH)->first()->value,
                $q3->data->where('account_code', $ACC_PIJIH)->first()->value,
            ), 2),
            'pijihq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_PIJIH)->first()->value,
                $q3->data->where('account_code', $ACC_PIJIH)->first()->value,
            ), 2),
            'pa1' => $this->ifNegative($q1->data->where('account_code', $ACC_PA)->first()->value),
            'pa2' => $this->ifNegative($q2->data->where('account_code', $ACC_PA)->first()->value),
            'pa3' => $this->ifNegative($q3->data->where('account_code', $ACC_PA)->first()->value),
            'pay' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_PA)->first()->value,
                $q3->data->where('account_code', $ACC_PA)->first()->value,
            ), 2),
            'paq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_PA)->first()->value,
                $q3->data->where('account_code', $ACC_PA)->first()->value,
            ), 2),
            'po1' => $this->ifNegative($q1->data->where('account_code', $ACC_PO)->first()->value),
            'po2' => $this->ifNegative($q2->data->where('account_code', $ACC_PO)->first()->value),
            'po3' => $this->ifNegative($q3->data->where('account_code', $ACC_PO)->first()->value),
            'poy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_PO)->first()->value,
                $q3->data->where('account_code', $ACC_PO)->first()->value,
            ), 2),
            'poq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_PO)->first()->value,
                $q3->data->where('account_code', $ACC_PO)->first()->value,
            ), 2),
            'pno1' => $this->ifNegative($q1->data->where('account_code', $ACC_PNO)->first()->value),
            'pno2' => $this->ifNegative($q2->data->where('account_code', $ACC_PNO)->first()->value),
            'pno3' => $this->ifNegative($q3->data->where('account_code', $ACC_PNO)->first()->value),
            'pnoy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_PNO)->first()->value,
                $q3->data->where('account_code', $ACC_PNO)->first()->value,
            ), 2),
            'pnoq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_PNO)->first()->value,
                $q3->data->where('account_code', $ACC_PNO)->first()->value,
            ), 2),
            'jp1' => $this->ifNegative($q1->data->where('account_code', $ACC_JP)->first()->value),
            'jp2' => $this->ifNegative($q2->data->where('account_code', $ACC_JP)->first()->value),
            'jp3' => $this->ifNegative($q3->data->where('account_code', $ACC_JP)->first()->value),
            'jpy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_JP)->first()->value,
                $q3->data->where('account_code', $ACC_JP)->first()->value,
            ), 2),
            'jpq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_JP)->first()->value,
                $q3->data->where('account_code', $ACC_JP)->first()->value,
            ), 2),
            'bo1' => $this->ifNegative($q1->data->where('account_code', $ACC_BO)->first()->value),
            'bo2' => $this->ifNegative($q2->data->where('account_code', $ACC_BO)->first()->value),
            'bo3' => $this->ifNegative($q3->data->where('account_code', $ACC_BO)->first()->value),
            'boy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_BO)->first()->value,
                $q3->data->where('account_code', $ACC_BO)->first()->value,
            ), 2),
            'boq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_BO)->first()->value,
                $q3->data->where('account_code', $ACC_BO)->first()->value,
            ), 2),
            'bno1' => $this->ifNegative($q1->data->where('account_code', $ACC_BNO)->first()->value),
            'bno2' => $this->ifNegative($q2->data->where('account_code', $ACC_BNO)->first()->value),
            'bno3' => $this->ifNegative($q3->data->where('account_code', $ACC_BNO)->first()->value),
            'bnoy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_BNO)->first()->value,
                $q3->data->where('account_code', $ACC_BNO)->first()->value,
            ), 2),
            'bnoq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_BNO)->first()->value,
                $q3->data->where('account_code', $ACC_BNO)->first()->value,
            ), 2),
            'jb1' => $this->ifNegative($q1->data->where('account_code', $ACC_JB)->first()->value),
            'jb2' => $this->ifNegative($q2->data->where('account_code', $ACC_JB)->first()->value),
            'jb3' => $this->ifNegative($q3->data->where('account_code', $ACC_JB)->first()->value),
            'jby' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_JB)->first()->value,
                $q3->data->where('account_code', $ACC_JB)->first()->value,
            ), 2),
            'jbq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_JB)->first()->value,
                $q3->data->where('account_code', $ACC_JB)->first()->value,
            ), 2),
            'lrsp1' => $this->ifNegative($q1->data->where('account_code', $ACC_LRSP)->first()->value),
            'lrsp2' => $this->ifNegative($q2->data->where('account_code', $ACC_LRSP)->first()->value),
            'lrsp3' => $this->ifNegative($q3->data->where('account_code', $ACC_LRSP)->first()->value),
            'lrspy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_LRSP)->first()->value,
                $q3->data->where('account_code', $ACC_LRSP)->first()->value,
            ), 2),
            'lrspq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_LRSP)->first()->value,
                $q3->data->where('account_code', $ACC_LRSP)->first()->value,
            ), 2),
            'tpp1' => $this->ifNegative($q1->data->where('account_code', $ACC_TPP)->first()->value),
            'tpp2' => $this->ifNegative($q2->data->where('account_code', $ACC_TPP)->first()->value),
            'tpp3' => $this->ifNegative($q3->data->where('account_code', $ACC_TPP)->first()->value),
            'tppy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_TPP)->first()->value,
                $q3->data->where('account_code', $ACC_TPP)->first()->value,
            ), 2),
            'tppq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_TPP)->first()->value,
                $q3->data->where('account_code', $ACC_TPP)->first()->value,
            ), 2),
            'lrpb1' => $this->ifNegative($q1->data->where('account_code', $ACC_LRPB)->first()->value),
            'lrpb2' => $this->ifNegative($q2->data->where('account_code', $ACC_LRPB)->first()->value),
            'lrpb3' => $this->ifNegative($q3->data->where('account_code', $ACC_LRPB)->first()->value),
            'lrpby' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_LRPB)->first()->value,
                $q3->data->where('account_code', $ACC_LRPB)->first()->value,
            ), 2),
            'lrpbq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_LRPB)->first()->value,
                $q3->data->where('account_code', $ACC_LRPB)->first()->value,
            ), 2),
            'jpd1' => $this->ifNegative($q1->data->where('account_code', $ACC_JPD)->first()->value),
            'jpd2' => $this->ifNegative($q2->data->where('account_code', $ACC_JPD)->first()->value),
            'jpd3' => $this->ifNegative($q3->data->where('account_code', $ACC_JPD)->first()->value),
            'jpdy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ), 2),
            'jpdq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ), 2),
            'jog1' => $this->ifNegative($q1->data->where('account_code', $ACC_JOG)->first()->value),
            'jog2' => $this->ifNegative($q2->data->where('account_code', $ACC_JOG)->first()->value),
            'jog3' => $this->ifNegative($q3->data->where('account_code', $ACC_JOG)->first()->value),
            'jogy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_JOG)->first()->value,
                $q3->data->where('account_code', $ACC_JOG)->first()->value,
            ), 2),
            'jogq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_JOG)->first()->value,
                $q3->data->where('account_code', $ACC_JOG)->first()->value,
            ), 2),
            'jn1' => $this->ifNegative($q1->data->where('account_code', $ACC_JN)->first()->value),
            'jn2' => $this->ifNegative($q2->data->where('account_code', $ACC_JN)->first()->value),
            'jn3' => $this->ifNegative($q3->data->where('account_code', $ACC_JN)->first()->value),
            'jny' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_JN)->first()->value,
                $q3->data->where('account_code', $ACC_JN)->first()->value,
            ), 2),
            'jnq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_JN)->first()->value,
                $q3->data->where('account_code', $ACC_JN)->first()->value,
            ), 2),
            'slr1' => $this->ifNegative($q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value),
            'slr2' => $this->ifNegative($q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value),
            'slr3' => $this->ifNegative($q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value),
            'slry' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ), 2),
            'slrq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ), 2),
            'pd1' => $this->ifNegative($q1->data->where('account_code', $ACC_PDG)->first()->value + $q1->data->where('account_code', $ACC_JPD)->first()->value),
            'pd2' => $this->ifNegative($q2->data->where('account_code', $ACC_PDG)->first()->value + $q2->data->where('account_code', $ACC_JPD)->first()->value),
            'pd3' => $this->ifNegative($q3->data->where('account_code', $ACC_PDG)->first()->value + $q3->data->where('account_code', $ACC_JPD)->first()->value),
            'pdy' => $this->ifNegative($this->getPercentage(
                $q1->data->where('account_code', $ACC_PDG)->first()->value + $q1->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value + $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ), 2),
            'pdq' => $this->ifNegative($this->getPercentage(
                $q2->data->where('account_code', $ACC_PDG)->first()->value + $q2->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value + $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ), 2),
            'cr1' => $this->ifNegative($this->saveDivider($q1->data->where('account_code', $ACC_PDG)->first()->value, $q1->data->where('account_code', $ACC_LL)->first()->value)),
            'cr2' => $this->ifNegative($this->saveDivider($q2->data->where('account_code', $ACC_PDG)->first()->value, $q2->data->where('account_code', $ACC_LL)->first()->value)),
            'cr3' => $this->ifNegative($this->saveDivider($q3->data->where('account_code', $ACC_PDG)->first()->value, $q3->data->where('account_code', $ACC_LL)->first()->value)),
            'cry' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_PDG)->first()->value, $q1->data->where('account_code', $ACC_LL)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_PDG)->first()->value, $q3->data->where('account_code', $ACC_LL)->first()->value),
            ), 2),
            'crq' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_PDG)->first()->value, $q2->data->where('account_code', $ACC_LL)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_PDG)->first()->value, $q3->data->where('account_code', $ACC_LL)->first()->value),
            ), 2),
            'der1' => $this->ifNegative($this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value)),
            'der2' => $this->ifNegative($this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value)),
            'der3' => $this->ifNegative($this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value)),
            'dery' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ), 2),
            'derq' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ), 2),
            'dar1' => $this->ifNegative($this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value)),
            'dar2' => $this->ifNegative($this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value)),
            'dar3' => $this->ifNegative($this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value)),
            'dary' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ), 2),
            'darq' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ), 2),
            'roa1' => $this->ifNegative($this->saveDivider($q1->data->where('account_code', $ACC_LRPB)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value)),
            'roa2' => $this->ifNegative($this->saveDivider($q2->data->where('account_code', $ACC_LRPB)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value)),
            'roa3' => $this->ifNegative($this->saveDivider($q3->data->where('account_code', $ACC_LRPB)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value)),
            'roay' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_LRPB)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRPB)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ), 2),
            'roaq' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_LRPB)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRPB)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ), 2),
            'roe1' => $this->ifNegative($this->saveDivider($q1->data->where('account_code', $ACC_LRTB)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value)),
            'roe2' => $this->ifNegative($this->saveDivider($q2->data->where('account_code', $ACC_LRTB)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value)),
            'roe3' => $this->ifNegative($this->saveDivider($q3->data->where('account_code', $ACC_LRTB)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value)),
            'roey' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_LRTB)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRTB)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ), 2),
            'roeq' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_LRTB)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRTB)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ), 2),
            'bopo1' => $this->ifNegative($this->saveDivider($q1->data->where('account_code', $ACC_BO)->first()->value, $q1->data->where('account_code', $ACC_PO)->first()->value)),
            'bopo2' => $this->ifNegative($this->saveDivider($q2->data->where('account_code', $ACC_BO)->first()->value, $q2->data->where('account_code', $ACC_PO)->first()->value)),
            'bopo3' => $this->ifNegative($this->saveDivider($q3->data->where('account_code', $ACC_BO)->first()->value, $q3->data->where('account_code', $ACC_PO)->first()->value)),
            'bopoy' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_BO)->first()->value, $q1->data->where('account_code', $ACC_PO)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_BO)->first()->value, $q3->data->where('account_code', $ACC_PO)->first()->value),
            ), 2),
            'bopoq' => $this->ifNegative($this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_BO)->first()->value, $q2->data->where('account_code', $ACC_PO)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_BO)->first()->value, $q3->data->where('account_code', $ACC_PO)->first()->value),
            ), 2),
            'laba_rugi_condition' => ($q3->data->where('account_code', $ACC_LRPB)->first()->value) < 0 ? 'rugi bersih' : 'laba bersih',
            'ta32' => ($q3->data->where('account_code', $ACC_TA)->first()->value - $q2->data->where('account_code', $ACC_TA)->first()->value),
            'ta32_condition' => ($q3->data->where('account_code', $ACC_TA)->first()->value - $q2->data->where('account_code', $ACC_TA)->first()->value) < 0 ? 'turun' : 'naik',
            'tl32' => ($q3->data->where('account_code', $ACC_TL)->first()->value - $q2->data->where('account_code', $ACC_TL)->first()->value),
            'tl32_condition' => ($q3->data->where('account_code', $ACC_TL)->first()->value - $q2->data->where('account_code', $ACC_TL)->first()->value) < 0 ? 'turun' : 'naik',
            'te32' => ($q3->data->where('account_code', $ACC_TE)->first()->value - $q2->data->where('account_code', $ACC_TE)->first()->value),
            'te32_condition' => ($q3->data->where('account_code', $ACC_TE)->first()->value - $q2->data->where('account_code', $ACC_TE)->first()->value) < 0 ? 'turun' : 'naik',
            'bo32' => ($q3->data->where('account_code', $ACC_BO)->first()->value - $q2->data->where('account_code', $ACC_BO)->first()->value),
            'bo32_condition' => ($q3->data->where('account_code', $ACC_BO)->first()->value - $q2->data->where('account_code', $ACC_BO)->first()->value) < 0 ? 'turun' : 'naik',
            'po32' => ($q3->data->where('account_code', $ACC_PO)->first()->value - $q2->data->where('account_code', $ACC_PO)->first()->value),
            'po32_condition' => ($q3->data->where('account_code', $ACC_PO)->first()->value - $q2->data->where('account_code', $ACC_PO)->first()->value) < 0 ? 'turun' : 'naik',
            'report_periode' => strftime("%d %B %Y", strtotime($q3->periode)),
            'report_date' => strftime("%d %B %Y", strtotime($q3->reported_at)),
            // 'report_time_condition' => (new DateTime(strtotime($q3->periode)))->diff(strtotime($q3->reported_at)),
        );
        
        $file = Storage::path('office/LHA_Template.docx');
        $template = new TemplateProcessor($file);

        foreach ($data_to_write as $key => $value) 
            $template->setValue($key, $value);
        
        return $template->saveAs('Lol.docx');
    }
}
