<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'prenoms' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'etablissement_id' => ['required', 'exists:etablissements,id'],
            'mention_id' => ['required', 'exists:mentions,id'],
            'niveau' => ['required', 'in:L1,L2,L3,M1,M2,Sortant'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'prenoms' => $data['prenoms'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'etablissement_id' => $data['etablissement_id'],
            'mention_id' => $data['mention_id'],
            'niveau' => $data['niveau'],
        ]);
    }

    public function showRegistrationForm()
    {
        $etablissements = Etablissement::all();
        return view('auth.register', compact('etablissements'));
    }

    public function register(Request $request)
    {
        // 1. Valider les données du formulaire
        $this->validator($request->all())->validate();

        // 2. Créer l'utilisateur
        $user = $this->create($request->all());

        // 3. Déclencher l'envoi de l'e-mail de vérification
        event(new Registered($user));

        // 4. Connexion automatique
        Auth::login($user);

        // 5. Redirection
        return redirect($this->redirectPath());
    }
}
