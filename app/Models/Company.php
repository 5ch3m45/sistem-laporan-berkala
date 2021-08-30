<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $appends = [
        'current_ratio', 
        'debt_to_equity', 
        'debt_to_equity', 
        'return_on_asset',
        'return_on_equity',
        'bopo',
        'asset_total',
        'liability_total',
        'equity_total'
    ];

    protected $fillable = [
        'code',
        'name',
        'regional',
        'outlet',
        'add_postalcode',
        'add_province',
        'add_regency',
        'add_subdistrict',
        'add_village',
        'add_road',
        'email',
        'phone',
        'birthdate',
        'lic_number',
        'lic_date',
        'tax_number',
    ];

    public function employes() {
        return $this->hasMany(Employe::class, 'company_id');
    }

    public function files()
    {
      return $this->hasMany(File::class, 'company_id');
    }

    public function notes() {
        return $this->hasMany(Note::class, 'company_id');
    }

    public function reports()
    {
      return $this->hasMany(Report::class, 'company_id');
    }

    public function safeDivider($number, $divider) {
        if($divider == 0) {
            return 0;
        }
        return $number/$divider;
    }

    public function generateSingleStat($account) {
        $latest_report = $this->reports()->orderByDesc('year')->orderByDesc('quarter')->first();
        if(!$latest_report) {
            return [
                'yoy' => 0,
                'qtq' => 0
            ];
        }
        $last_year_report = $this->reports()->where('year', $latest_report->year - 1)->where('quarter', $latest_report->quarter)->first();
        if(!$last_year_report || !$latest_report) {
            return [
                'yoy' => 0,
                'qtq' => 0
            ];
        }
        if($latest_report->quarter == 1) {
            $last_quarter_report = $this->reports()->where('year', $latest_report->year - 1)->where('quarter', 4)->first();
        } else {
            $last_quarter_report = $this->reports()->where('year', $latest_report->year)->where('quarter', $latest_report->quarter - 1)->first();
        }

        $number_latest = $latest_report->data()->where('account_code', $account)->first();
        $number_last_y = $last_year_report->data()->where('account_code', $account)->first();
        $number_last_q = $last_quarter_report->data()->where('account_code', $account)->first();
        
        $latest = $number_latest->value;
        $last_y = $number_last_y->value;
        $last_q = $number_last_q->value;

        return [
            'yoy' => number_format($this->safeDivider($latest - $last_y, $last_y)*100, 2),
            'qtq' => number_format($this->safeDivider($latest - $last_q, $last_q)*100, 2),
        ];
    }

    public function generateStat($number_account, $divider_account) {
        $latest_report = $this->reports()->orderByDesc('year')->orderByDesc('quarter')->first();
        if(!$latest_report) {
            return [
                'yoy' => 0,
                'qtq' => 0
            ];
        }
        $last_year_report = $this->reports()->where('year', $latest_report->year - 1)->where('quarter', $latest_report->quarter)->first();
        if(!$last_year_report || !$latest_report) {
            return [
                'yoy' => 0,
                'qtq' => 0
            ];
        }
        if($latest_report->quarter == 1) {
            $last_quarter_report = $this->reports()->where('year', $latest_report->year - 1)->where('quarter', 4)->first();
        } else {
            $last_quarter_report = $this->reports()->where('year', $latest_report->year)->where('quarter', $latest_report->quarter - 1)->first();
        }

        $number_latest = $latest_report->data()->where('account_code', $number_account)->first();
        $number_last_y = $last_year_report->data()->where('account_code', $number_account)->first();
        $number_last_q = $last_quarter_report->data()->where('account_code', $number_account)->first();
    
        $divider_latest = $latest_report->data()->where('account_code', $divider_account)->first();
        $divider_last_y = $last_year_report->data()->where('account_code', $divider_account)->first();
        $divider_last_q = $last_quarter_report->data()->where('account_code', $divider_account)->first();
        
        $latest = $this->safeDivider($number_latest->value, $divider_latest->value);
        $last_y = $this->safeDivider($number_last_y->value, $divider_last_y->value);
        $last_q = $this->safeDivider($number_last_q->value, $divider_last_q->value);

        return [
            'yoy' => number_format($this->safeDivider($latest - $last_y, $last_y)*100, 2, ',', '.'),
            'qtq' => number_format($this->safeDivider($latest - $last_q, $last_q)*100, 2, ',', '.'),
        ];
    }

    public function getCurrentRatioAttribute() {
        return $this->generateStat('LPK_A_TOTAL_AL', 'LPK_L_TOTAL_LL');
    }

    public function getDebtToEquityAttribute() {
        return $this->generateStat('LPK_L_TOTAL', 'LPK_E_TOTAL');
    }

    public function getDebtToAssetAttribute() {
        return $this->generateStat('LPK_L_TOTAL', 'LPK_A_TOTAL');
    }

    public function getReturnOnAssetAttribute() {
        return $this->generateStat('LRK_LRPB', 'LPK_A_TOTAL');
    }

    public function getReturnOnEquityAttribute() {
        return $this->generateStat('LPK_E_SLR_LRTB', 'LPK_E_TOTAL');
    }

    public function getBopoAttribute() {
        return $this->generateStat('LRK_B_TOTAL_BO', 'LRK_P_TOTAL_PO');
    }

    public function getAssetTotalAttribute() {
        return $this->generateSingleStat('LPK_A_TOTAL');
    }

    public function getLiabilityTotalAttribute() {
        return $this->generateSingleStat('LPK_L_TOTAL');
    }

    public function getEquityTotalAttribute() {
        return $this->generateSingleStat('LPK_E_TOTAL');
    }
}
