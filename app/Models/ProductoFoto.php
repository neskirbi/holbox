<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFoto extends Model
{
    use HasFactory;
    protected $table = 'productofotos';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
