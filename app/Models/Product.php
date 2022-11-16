<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tax;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='products';

    protected $fillable = [
        'name',
        'cost',
        'tax_rate_id',
    ];
    public function taxes()
    {
        return $this->hasOne(Tax::class,'id','tax_rate_id');
    }
}
