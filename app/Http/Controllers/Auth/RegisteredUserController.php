<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Rol;
use App\Models\User;
use App\Models\UserAddress;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //Quitado del validate: 'g-recaptcha-response' => 'required|recaptchav3:register,0.5'

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'recaptchav3' => 'Captcha inválido',
            'confirmed' => 'Las contraseñas no coinciden',
            'min.string' => 'La contraseña debe tener al menos 8 caracteres',
        ]);


        $city = City::firstOrCreate(['province'=>$request->ciudad]);


        $address = UserAddress::create([
            'address'=>$request->address,
            'city'=>$request->ciudad,
            'cp'=>$request->cp,
            'cities_id'=>$city->id, // asignar la id del city creado/obtenido
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol'=> 2,
            'addresses_id'=>$address->id, // asignar la id de la dirección creada
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}