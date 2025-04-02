<?php

namespace App\Models; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'documento';
    public $incrementing = false;
    protected $keyType = 'int'; 

    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'correo',
        'contra',
        'saldo_inicial',
        'ciudad_nacimiento',
    ];

    protected $hidden = [
        'contra',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'saldo_inicial' => 'decimal:2',
       
    ];

    public function getAuthPasswordName()
    {
        return 'contra';
    }

}