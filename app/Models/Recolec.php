<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Recolec extends Authenticatable
{
    use HasFactory;
    protected $table = 'recoleccion';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
