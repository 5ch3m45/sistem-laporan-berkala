<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'uri',
      'description',
      'company_id',
      'uploaded_by'
    ];

    public function company()
    {
      return $this->belongsTo(Company::class, 'company_id');
    }

    public function uploader()
    {
      return $this->belongsTo(User::class, 'uploaded_by');
    }
}
