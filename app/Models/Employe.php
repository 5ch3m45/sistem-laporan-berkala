<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'is_contact_person',
        'company_id',
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
