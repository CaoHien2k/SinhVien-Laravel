<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'grade',
        'birthday',
        'address',
        'phone',
    ];


    public function user(){
        return $this->belongsTo('App\Models\User');
   }
}
