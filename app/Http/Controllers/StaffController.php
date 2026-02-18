<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::where('role', 'petugas')->latest()->paginate(10);
        return view('admin.md-staff.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.md-staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'username' =>'required|min:3|max:225',
            'nama_lengkap' =>'required|min:3|max:255',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:8',
            'alamat' =>'required|min:5|max:255',
            ]);

        if($validator->fails()) {
            return redirect()->route('admin.staff.create')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->role = $request->role;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->save();
        
        return redirect()->route('admin.staff.index')->with('success', 'You have been registered successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = User::findOrFail($id);

        return view('admin.md-staff.show',compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = User::findOrFail($id);
        return view('admin.md-staff.edit',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = User::findOrFail($id);

        $request->validate([
            'username'     => 'nullable|min:3|max:225' . $id,
            'nama_lengkap' => 'nullable|min:3|max:255',
            'email'        => 'nullable|email|unique:users,email,' . $id,
            'password'     => 'nullable|min:8',
            'alamat'       => 'nullable|min:5|max:255',
        ]);

        $staff->nama_lengkap = $request->nama_lengkap;
        $staff->username = $request->username;
        $staff->email = $request->email;
        $staff->password = $request->password;
        $staff->alamat = $request->alamat;

        if ($request->filled('password')) {
            $staff->password = Hash::make($request->password);
        }

        $staff->save();

        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
