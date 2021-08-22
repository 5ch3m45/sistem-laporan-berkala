<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyReport;
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

    public function saveDivider ($the_number, $divider) {
        if ($divider == 0) {
            return 0;
        }
        return $the_number/$divider;
    }

    public function getPercentage($basic, $delta) {
        return $this->saveDivider($delta - $basic, $basic)*100;
    }

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
        $ACC_JPD = 'LO_PDG_TOTAL_UPG';
        $ACC_JN = 'LO_PDG_TOTAL_N';
        $ACC_TPP = 'LRK_TPP';

        $data_to_write = array(
            'company_name' => $company->name,
            'company_phone' => $company->phone,
            'company_lic_number' => $company->lic_number,
            'company_lic_date' => $company->lic_date,
            'company_tax_number' => $company->tax_number,
            'company_region' => $company->regional,
            'company_email' => $company->email,
            'quarter' => $this->numberToRoman($q3->quarter),
            'year' => $q3->year,
            'ksk1' => $q1->data->where('account_code', $ACC_KSK)->first()->value,
            'ksk2' => $q2->data->where('account_code', $ACC_KSK)->first()->value,
            'ksk3' => $q3->data->where('account_code', $ACC_KSK)->first()->value,
            'ksky' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_KSK)->first()->value,
                $q3->data->where('account_code', $ACC_KSK)->first()->value,
            ),
            'kskq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_KSK)->first()->value,
                $q3->data->where('account_code', $ACC_KSK)->first()->value,
            ),
            'pdg1' => $q1->data->where('account_code', $ACC_PDG)->first()->value,
            'pdg2' => $q2->data->where('account_code', $ACC_PDG)->first()->value,
            'pdg3' => $q3->data->where('account_code', $ACC_PDG)->first()->value,
            'pdgy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_PDG)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value,
            ),
            'pdgq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_PDG)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value,
            ),
            'all1' => $q1->data->where('account_code', $ACC_ALL)->first()->value,
            'all2' => $q2->data->where('account_code', $ACC_ALL)->first()->value,
            'all3' => $q3->data->where('account_code', $ACC_ALL)->first()->value,
            'ally' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_ALL)->first()->value,
                $q3->data->where('account_code', $ACC_ALL)->first()->value,
            ),
            'allq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_ALL)->first()->value,
                $q3->data->where('account_code', $ACC_ALL)->first()->value,
            ),
            'al1' => $q1->data->where('account_code', $ACC_AL)->first()->value,
            'al2' => $q2->data->where('account_code', $ACC_AL)->first()->value,
            'al3' => $q3->data->where('account_code', $ACC_AL)->first()->value,
            'aly' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_AL)->first()->value,
                $q3->data->where('account_code', $ACC_AL)->first()->value,
            ),
            'alq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_AL)->first()->value,
                $q3->data->where('account_code', $ACC_AL)->first()->value,
            ),
            'atl1' => $q1->data->where('account_code', $ACC_ATL)->first()->value,
            'atl2' => $q2->data->where('account_code', $ACC_ATL)->first()->value,
            'atl3' => $q3->data->where('account_code', $ACC_ATL)->first()->value,
            'atly' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_ATL)->first()->value,
                $q3->data->where('account_code', $ACC_ATL)->first()->value,
            ),
            'atlq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_ATL)->first()->value,
                $q3->data->where('account_code', $ACC_ATL)->first()->value,
            ),
            'ta1' => $q1->data->where('account_code', $ACC_TA)->first()->value,
            'ta2' => $q2->data->where('account_code', $ACC_TA)->first()->value,
            'ta3' => $q3->data->where('account_code', $ACC_TA)->first()->value,
            'tay' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_TA)->first()->value,
                $q3->data->where('account_code', $ACC_TA)->first()->value,
            ),
            'taq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_TA)->first()->value,
                $q3->data->where('account_code', $ACC_TA)->first()->value,
            ),
            'll1' => $q1->data->where('account_code', $ACC_LL)->first()->value,
            'll2' => $q2->data->where('account_code', $ACC_LL)->first()->value,
            'll3' => $q3->data->where('account_code', $ACC_LL)->first()->value,
            'lly' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_LL)->first()->value,
                $q3->data->where('account_code', $ACC_LL)->first()->value,
            ),
            'llq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_LL)->first()->value,
                $q3->data->where('account_code', $ACC_LL)->first()->value,
            ),
            'ltl1' => $q1->data->where('account_code', $ACC_LTL)->first()->value,
            'ltl2' => $q2->data->where('account_code', $ACC_LTL)->first()->value,
            'ltl3' => $q3->data->where('account_code', $ACC_LTL)->first()->value,
            'ltly' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_LTL)->first()->value,
                $q3->data->where('account_code', $ACC_LTL)->first()->value,
            ),
            'ltlq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_LTL)->first()->value,
                $q3->data->where('account_code', $ACC_LTL)->first()->value,
            ),
            'tl1' => $q1->data->where('account_code', $ACC_TL)->first()->value,
            'tl2' => $q2->data->where('account_code', $ACC_TL)->first()->value,
            'tl3' => $q3->data->where('account_code', $ACC_TL)->first()->value,
            'tly' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_TL)->first()->value,
                $q3->data->where('account_code', $ACC_TL)->first()->value,
            ),
            'tlq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_TL)->first()->value,
                $q3->data->where('account_code', $ACC_TL)->first()->value,
            ),
            'md1' => $q1->data->where('account_code', $ACC_MD)->first()->value,
            'md2' => $q2->data->where('account_code', $ACC_MD)->first()->value,
            'md3' => $q3->data->where('account_code', $ACC_MD)->first()->value,
            'mdy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_MD)->first()->value,
                $q3->data->where('account_code', $ACC_MD)->first()->value,
            ),
            'mdq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_MD)->first()->value,
                $q3->data->where('account_code', $ACC_MD)->first()->value,
            ),
            'slr1' => $q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value,
            'slr2' => $q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value,
            'slr3' => $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            'slry' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ),
            'slrq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ),
            'slrat1' => $q1->data->where('account_code', $ACC_SLRAT)->first()->value,
            'slrat2' => $q2->data->where('account_code', $ACC_SLRAT)->first()->value,
            'slrat3' => $q3->data->where('account_code', $ACC_SLRAT)->first()->value,
            'slraty' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_SLRAT)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value,
            ),
            'slratq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_SLRAT)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value,
            ),
            'lrtb1' => $q1->data->where('account_code', $ACC_LRTB)->first()->value,
            'lrtb2' => $q2->data->where('account_code', $ACC_LRTB)->first()->value,
            'lrtb3' => $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            'lrtby' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ),
            'lrtbq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ),
            'te1' => $q1->data->where('account_code', $ACC_TE)->first()->value,
            'te2' => $q2->data->where('account_code', $ACC_TE)->first()->value,
            'te3' => $q3->data->where('account_code', $ACC_TE)->first()->value,
            'tey' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_TE)->first()->value,
                $q3->data->where('account_code', $ACC_TE)->first()->value,
            ),
            'teq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_TE)->first()->value,
                $q3->data->where('account_code', $ACC_TE)->first()->value,
            ),
            'pijih1' => $q1->data->where('account_code', $ACC_PIJIH)->first()->value,
            'pijih2' => $q2->data->where('account_code', $ACC_PIJIH)->first()->value,
            'pijih3' => $q3->data->where('account_code', $ACC_PIJIH)->first()->value,
            'pijihy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_PIJIH)->first()->value,
                $q3->data->where('account_code', $ACC_PIJIH)->first()->value,
            ),
            'pijihq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_PIJIH)->first()->value,
                $q3->data->where('account_code', $ACC_PIJIH)->first()->value,
            ),
            'pa1' => $q1->data->where('account_code', $ACC_PA)->first()->value,
            'pa2' => $q2->data->where('account_code', $ACC_PA)->first()->value,
            'pa3' => $q3->data->where('account_code', $ACC_PA)->first()->value,
            'pay' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_PA)->first()->value,
                $q3->data->where('account_code', $ACC_PA)->first()->value,
            ),
            'paq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_PA)->first()->value,
                $q3->data->where('account_code', $ACC_PA)->first()->value,
            ),
            'po1' => $q1->data->where('account_code', $ACC_PO)->first()->value,
            'po2' => $q2->data->where('account_code', $ACC_PO)->first()->value,
            'po3' => $q3->data->where('account_code', $ACC_PO)->first()->value,
            'poy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_PO)->first()->value,
                $q3->data->where('account_code', $ACC_PO)->first()->value,
            ),
            'poq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_PO)->first()->value,
                $q3->data->where('account_code', $ACC_PO)->first()->value,
            ),
            'pno1' => $q1->data->where('account_code', $ACC_PNO)->first()->value,
            'pno2' => $q2->data->where('account_code', $ACC_PNO)->first()->value,
            'pno3' => $q3->data->where('account_code', $ACC_PNO)->first()->value,
            'pnoy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_PNO)->first()->value,
                $q3->data->where('account_code', $ACC_PNO)->first()->value,
            ),
            'pnoq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_PNO)->first()->value,
                $q3->data->where('account_code', $ACC_PNO)->first()->value,
            ),
            'jp1' => $q1->data->where('account_code', $ACC_JP)->first()->value,
            'jp2' => $q2->data->where('account_code', $ACC_JP)->first()->value,
            'jp3' => $q3->data->where('account_code', $ACC_JP)->first()->value,
            'jpy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_JP)->first()->value,
                $q3->data->where('account_code', $ACC_JP)->first()->value,
            ),
            'jpq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_JP)->first()->value,
                $q3->data->where('account_code', $ACC_JP)->first()->value,
            ),
            'bo1' => $q1->data->where('account_code', $ACC_BO)->first()->value,
            'bo2' => $q2->data->where('account_code', $ACC_BO)->first()->value,
            'bo3' => $q3->data->where('account_code', $ACC_BO)->first()->value,
            'boy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_BO)->first()->value,
                $q3->data->where('account_code', $ACC_BO)->first()->value,
            ),
            'boq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_BO)->first()->value,
                $q3->data->where('account_code', $ACC_BO)->first()->value,
            ),
            'bno1' => $q1->data->where('account_code', $ACC_BNO)->first()->value,
            'bno2' => $q2->data->where('account_code', $ACC_BNO)->first()->value,
            'bno3' => $q3->data->where('account_code', $ACC_BNO)->first()->value,
            'bnoy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_BNO)->first()->value,
                $q3->data->where('account_code', $ACC_BNO)->first()->value,
            ),
            'bnoq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_BNO)->first()->value,
                $q3->data->where('account_code', $ACC_BNO)->first()->value,
            ),
            'jb1' => $q1->data->where('account_code', $ACC_JB)->first()->value,
            'jb2' => $q2->data->where('account_code', $ACC_JB)->first()->value,
            'jb3' => $q3->data->where('account_code', $ACC_JB)->first()->value,
            'jby' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_JB)->first()->value,
                $q3->data->where('account_code', $ACC_JB)->first()->value,
            ),
            'jbq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_JB)->first()->value,
                $q3->data->where('account_code', $ACC_JB)->first()->value,
            ),
            'lrsp1' => $q1->data->where('account_code', $ACC_LRSP)->first()->value,
            'lrsp2' => $q2->data->where('account_code', $ACC_LRSP)->first()->value,
            'lrsp3' => $q3->data->where('account_code', $ACC_LRSP)->first()->value,
            'lrspy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_LRSP)->first()->value,
                $q3->data->where('account_code', $ACC_LRSP)->first()->value,
            ),
            'lrspq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_LRSP)->first()->value,
                $q3->data->where('account_code', $ACC_LRSP)->first()->value,
            ),
            'tpp1' => $q1->data->where('account_code', $ACC_TPP)->first()->value,
            'tpp2' => $q2->data->where('account_code', $ACC_TPP)->first()->value,
            'tpp3' => $q3->data->where('account_code', $ACC_TPP)->first()->value,
            'tppy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_TPP)->first()->value,
                $q3->data->where('account_code', $ACC_TPP)->first()->value,
            ),
            'tppq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_TPP)->first()->value,
                $q3->data->where('account_code', $ACC_TPP)->first()->value,
            ),
            'lrpb1' => $q1->data->where('account_code', $ACC_LRPB)->first()->value,
            'lrpb2' => $q2->data->where('account_code', $ACC_LRPB)->first()->value,
            'lrpb3' => $q3->data->where('account_code', $ACC_LRPB)->first()->value,
            'lrpby' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_LRPB)->first()->value,
                $q3->data->where('account_code', $ACC_LRPB)->first()->value,
            ),
            'lrpbq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_LRPB)->first()->value,
                $q3->data->where('account_code', $ACC_LRPB)->first()->value,
            ),
            'jpd1' => $q1->data->where('account_code', $ACC_JPD)->first()->value,
            'jpd2' => $q2->data->where('account_code', $ACC_JPD)->first()->value,
            'jpd3' => $q3->data->where('account_code', $ACC_JPD)->first()->value,
            'jpdy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ),
            'jpdq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ),
            'jn1' => $q1->data->where('account_code', $ACC_JN)->first()->value,
            'jn2' => $q2->data->where('account_code', $ACC_JN)->first()->value,
            'jn3' => $q3->data->where('account_code', $ACC_JN)->first()->value,
            'jny' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_JN)->first()->value,
                $q3->data->where('account_code', $ACC_JN)->first()->value,
            ),
            'jnq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_JN)->first()->value,
                $q3->data->where('account_code', $ACC_JN)->first()->value,
            ),
            'slr1' => $q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value,
            'slr2' => $q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value,
            'slr3' => $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            'slry' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_SLRAT)->first()->value + $q1->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ),
            'slrq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_SLRAT)->first()->value + $q2->data->where('account_code', $ACC_LRTB)->first()->value,
                $q3->data->where('account_code', $ACC_SLRAT)->first()->value + $q3->data->where('account_code', $ACC_LRTB)->first()->value,
            ),
            'pd1' => $q1->data->where('account_code', $ACC_PDG)->first()->value + $q1->data->where('account_code', $ACC_JPD)->first()->value,
            'pd2' => $q2->data->where('account_code', $ACC_PDG)->first()->value + $q2->data->where('account_code', $ACC_JPD)->first()->value,
            'pd3' => $q3->data->where('account_code', $ACC_PDG)->first()->value + $q3->data->where('account_code', $ACC_JPD)->first()->value,
            'pdy' => $this->getPercentage(
                $q1->data->where('account_code', $ACC_PDG)->first()->value + $q1->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value + $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ),
            'pdq' => $this->getPercentage(
                $q2->data->where('account_code', $ACC_PDG)->first()->value + $q2->data->where('account_code', $ACC_JPD)->first()->value,
                $q3->data->where('account_code', $ACC_PDG)->first()->value + $q3->data->where('account_code', $ACC_JPD)->first()->value,
            ),
            'cr1' => $this->saveDivider($q1->data->where('account_code', $ACC_PDG)->first()->value, $q1->data->where('account_code', $ACC_LL)->first()->value),
            'cr2' => $this->saveDivider($q2->data->where('account_code', $ACC_PDG)->first()->value, $q2->data->where('account_code', $ACC_LL)->first()->value),
            'cr3' => $this->saveDivider($q3->data->where('account_code', $ACC_PDG)->first()->value, $q3->data->where('account_code', $ACC_LL)->first()->value),
            'cry' => $this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_PDG)->first()->value, $q1->data->where('account_code', $ACC_LL)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_PDG)->first()->value, $q3->data->where('account_code', $ACC_LL)->first()->value),
            ),
            'crq' => $this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_PDG)->first()->value, $q2->data->where('account_code', $ACC_LL)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_PDG)->first()->value, $q3->data->where('account_code', $ACC_LL)->first()->value),
            ),
            'der1' => $this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value),
            'der2' => $this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value),
            'der3' => $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            'dery' => $this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ),
            'derq' => $this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ),
            'dar1' => $this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value),
            'dar2' => $this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value),
            'dar3' => $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            'dary' => $this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_TL)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ),
            'darq' => $this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_TL)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_TL)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ),
            'roa1' => $this->saveDivider($q1->data->where('account_code', $ACC_LRPB)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value),
            'roa2' => $this->saveDivider($q2->data->where('account_code', $ACC_LRPB)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value),
            'roa3' => $this->saveDivider($q3->data->where('account_code', $ACC_LRPB)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            'roay' => $this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_LRPB)->first()->value, $q1->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRPB)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ),
            'roaq' => $this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_LRPB)->first()->value, $q2->data->where('account_code', $ACC_TA)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRPB)->first()->value, $q3->data->where('account_code', $ACC_TA)->first()->value),
            ),
            'roe1' => $this->saveDivider($q1->data->where('account_code', $ACC_LRTB)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value),
            'roe2' => $this->saveDivider($q2->data->where('account_code', $ACC_LRTB)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value),
            'roe3' => $this->saveDivider($q3->data->where('account_code', $ACC_LRTB)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            'roey' => $this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_LRTB)->first()->value, $q1->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRTB)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ),
            'roeq' => $this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_LRTB)->first()->value, $q2->data->where('account_code', $ACC_TE)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_LRTB)->first()->value, $q3->data->where('account_code', $ACC_TE)->first()->value),
            ),
            'bopo1' => $this->saveDivider($q1->data->where('account_code', $ACC_BO)->first()->value, $q1->data->where('account_code', $ACC_PO)->first()->value),
            'bopo2' => $this->saveDivider($q2->data->where('account_code', $ACC_BO)->first()->value, $q2->data->where('account_code', $ACC_PO)->first()->value),
            'bopo3' => $this->saveDivider($q3->data->where('account_code', $ACC_BO)->first()->value, $q3->data->where('account_code', $ACC_PO)->first()->value),
            'bopoy' => $this->getPercentage(
                $this->saveDivider($q1->data->where('account_code', $ACC_BO)->first()->value, $q1->data->where('account_code', $ACC_PO)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_BO)->first()->value, $q3->data->where('account_code', $ACC_PO)->first()->value),
            ),
            'bopoq' => $this->getPercentage(
                $this->saveDivider($q2->data->where('account_code', $ACC_BO)->first()->value, $q2->data->where('account_code', $ACC_PO)->first()->value),
                $this->saveDivider($q3->data->where('account_code', $ACC_BO)->first()->value, $q3->data->where('account_code', $ACC_PO)->first()->value),
            ),
        );
        
        $file = Storage::path('office/LHA_Template.docx');
        $template = new TemplateProcessor($file);

        foreach ($data_to_write as $key => $value) 
            $template->setValue($key, $value);
        
        return $template->saveAs('Lol.docx');
    }
}
