<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Usuario; // <--- CAMBIO AQUÍ
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered; // Asegúrate de importar Registered

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        // La validación usa nombres de tabla y columna, así que se queda igual
        return Validator::make($data, [
            'documento' => ['required', 'numeric', 'unique:usuarios,documento'],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,correo'],
            'contra' => ['required', 'string', 'min:8', 'confirmed'],
            'ciudad_nacimiento' => ['nullable', 'string', 'max:255'],
            'saldo_inicial' => ['nullable', 'numeric', 'min:0']
        ]);
    }

    protected function create(array $data)
    {

        return Usuario::create([
            'documento' => $data['documento'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'correo' => $data['correo'],
            'contra' => Hash::make($data['contra']),
            'ciudad_nacimiento' => $data['ciudad_nacimiento'] ?? null,
            'saldo_inicial' => $data['saldo_inicial'] ?? 0.00,
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

      
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new \Illuminate\Http\JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }
}