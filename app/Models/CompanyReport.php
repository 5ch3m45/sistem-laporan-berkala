<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReport extends Model
{
    use HasFactory;

    protected $fillable = [
      'report_id',
      'account_code',
      'value'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
      'value' => 0
    ];

}
