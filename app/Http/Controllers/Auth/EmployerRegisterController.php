<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployerRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-employer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request) {

            $logoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'employer',
            ]);


            Employer::create([
                'user_id' => $user->id,
                'name' => $request->company_name,
                'logo' => $logoPath,
            ]);


            Auth::login($user);
        });

        return redirect('/');

    }
}
