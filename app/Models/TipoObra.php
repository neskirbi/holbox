<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoObra extends Model
{
    use HasFactory;
    protected    $table = 'tipoobras';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
