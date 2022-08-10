<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    static $rules = [
		'name' => 'required',
    ];

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'address',
        'longitude',
        'latitude',
    ];
}
