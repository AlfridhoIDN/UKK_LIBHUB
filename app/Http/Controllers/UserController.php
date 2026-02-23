<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','pembaca')->paginate(5);
        return view('admin.md-user.index',compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.md-user.show',compact('user'));
    }

    public function login(){
        return view('auth.login');
    }

        public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->getID(),
                ]);
            } else {
                $user = User::create([
                    'username' => $googleUser->getName(),
                    'nama_lengkap' => $googleUser->getName(),    
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getID(),
                    'password' => Hash::make(str()->random(24)),
                ]);
            }

            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('landingpage');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong or login canceled');
        }
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' =>'required|email',
            'password' =>'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('login')->withInput()->withErrors($validator);
        }


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('landingpage');
        } else {
            return redirect()->route('login')->with('error', 'Invalid email or password');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'nama_lengkap' =>'required|min:3|max:255',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:8',
            ]);

        if($validator->fails()) {
            return redirect()->route('account.create')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('login')->with('success', 'You have been registered successfully');
        }
        
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('landingpage')->with('success', 'You have been logged out successfully');
    }
}
