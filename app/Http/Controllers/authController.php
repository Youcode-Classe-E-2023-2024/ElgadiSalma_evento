<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;
use Spatie\Permission\Models\Role;

class authController extends Controller
{
    public function registerView()
    {
        return view('Auth.register');
    }
    public function register(Request $request)
    {
        // dd($request);
        $request->validate([
            'files' => 'required',
            'name' => 'required',
            'role' => 'required|in:Utilisateur,Organisateur',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],            
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
            'id_picture' => $request->input('picture'),
        ]);

        $role = $request->input('role');
        $roleModel = Role::where('name', $role)->first();

        if ($roleModel) {
            $user->assignRole($roleModel);
        }

        // Handle file upload
        foreach ($request->file('files') as $file) {
            $storedFile = $file->store('uploads');

            $media = $user->addMedia(storage_path('app/' . $storedFile))->toMediaCollection();

            $user->id_picture = $media->id;
            $user->save();
        }

        return view('Auth.register');
    }


    public function loginView()
    {
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
    
                return redirect()->route('dashboard.view')->with('success', 'Vous êtes bien connecté ');
                
            }        
        
    
        return back()->withErrors([
            'email'=> 'Email ou mot de passe incorrect.'
            ])->onlyInput('email');

    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('login.show'); 
    }


    // forgot password
    public function forgot_show()
    {
        return view('Auth.forgot-password');
    }
    public function reset($token)
    {
        $user = User::where('remember_token', $token)->first();
    
        if (!empty($user)) {
            $data['user'] = $user;
            $data['token'] = $token; // Pass the token to the view
            return view('Auth.reset-password', $data);
        } else {
            abort(404);
        }
    }
    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if(!empty($user))
        {
            $user->remember_token = Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            
            return back()->withErrors([
                'email'=> 'Check ton email'
                ])->onlyInput('email');
        }else{
            return back()->withErrors([
                'email'=> 'Email non trouvé.'
                ])->onlyInput('email');
        }
    }
    public function post_reset($token, Request $request)
    {
        $user = User::where('remember_token','=',$token)->first();
        if(!empty($user))
        {
            if($request->password == $request->confirm_password)
            {
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(40);
                $user->save();

                return redirect()->route('login.show'); 

            }else{
                return redirect()->back()->with('error', 'Mots de passe non identiques');
            }
        }else{
            abort(404);
        }
    }  


    // page profil 
    public function showProfil()
    {
        $user = Auth::user();
        return view('Auth.profil', compact('user'));
    }
}
