<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
  use HasFactory, SoftDeletes;
  protected $fillable = [
    'note',
    'is_read',
    'user_id',
    'company_id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
