<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='branches';

    protected $fillable = [
        'name',
        'address',
        'country',
        'state',
        'city',
        'pin_code',
    ];
}
