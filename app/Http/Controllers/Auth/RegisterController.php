<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Usuario; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Auth\Events\Registered; 

class RegisterController extends Controller
{
    
    use RegistersUsers;

    /**
    
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME; 

    /**
     
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param  array  $data Los datos que vienen del formulario
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
  
        return Validator::make($data, [
            'documento'         => ['required', 'numeric', 'unique:usuarios,documento'], 
            'nombres'           => ['required', 'string', 'max:255'],
            'apellidos'         => ['required', 'string', 'max:255'],
            'correo'            => ['required', 'string', 'email', 'max:255', 'unique:usuarios,correo'], 
            'ciudad_nacimiento' => ['nullable', 'string', 'max:255'], 
            'saldo_inicial'     => ['nullable', 'numeric', 'min:0'],  
            'contra'            => ['required', 'string', 'min:8', 'confirmed'], 
        ]);
    }

    /**
     
     * @param  array  $data Los datos validados del formulario
     * @return \App\Models\Usuario
     */
    protected function create(array $data)
    {
       
        return Usuario::create([
            'documento'         => $data['documento'],
            'nombres'           => $data['nombres'],
            'apellidos'         => $data['apellidos'],
            'correo'            => $data['correo'],
            'ciudad_nacimiento' => $data['ciudad_nacimiento'] ?? null, // Si no viene, guarda null
            'saldo_inicial'     => $data['saldo_inicial'] ?? 0.00,   // Si no viene, guarda 0.00
            'contra'            => Hash::make($data['contra']), // Hashea la contraseña antes de guardarla
        ]);
    }


}