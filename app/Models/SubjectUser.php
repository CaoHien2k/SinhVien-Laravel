<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectUser extends Model
{
    use HasFactory;

    public $table = 'subject_user';

    protected $fillable = [
        'user_id',
        'subject_id',
        'created_at',
        'updated_at',
    ];
}
