<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function file()
    {
      return $this->hasMany(File::class, 'company_id');
    }

    public function reports()
    {
      return $this->hasMany(Report::class, 'company_id');
    }
}
