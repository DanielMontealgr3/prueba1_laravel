<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recargas extends Model
{

    use HasFactory;

    protected $table = 'recargas';

    protected $fillable = [
        'documento_usuario',
        'cantidad_recarga',
        'saldo_anterior',
        'saldo_actual',
    ];

    protected $casts = [
        'cantidad_recarga' => 'decimal:2',
        'saldo_anterior' => 'decimal:2',
        'saldo_actual' => 'decimal:2',
    ];

  
}