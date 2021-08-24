<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
      'company_id',
      'year',
      'quarter',
      'reporter_id',
      'version',
      'periode',
      'reported_at'
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function reporter() {
      return $this->belongsTo(User::class, 'reporter_id');
    }

    public function data() {
        return $this->hasMany(CompanyReport::class, 'report_id');
    }
}
