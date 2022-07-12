<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offerwall extends Model
{
    use HasFactory;
    public $table='offerwall';
    protected $primaryKey='id';
    public $timstamps=false;
}
