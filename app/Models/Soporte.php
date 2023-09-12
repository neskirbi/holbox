<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Soporte extends Authenticatable
{
    use HasFactory;
    protected $table = 'soporte';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
