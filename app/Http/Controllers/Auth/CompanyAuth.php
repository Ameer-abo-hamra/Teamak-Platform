<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuth extends Controller
{
    public function login()
    {
        return view('auth.company.login');
    }




    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'Official_email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (
            Auth::guard('company')->attempt([
                'Official_email' => $credentials['Official_email'],
                'password' => $credentials['password'],
            ])
        ) {

            $request->session()->regenerate();

            return redirect()->intended(route('company.index'))->with('success', 'logged in successfully');
        }

        return back()
            ->with(
                'error',
                'Invalid credentials.',
            )
        ;
    }
    public function register()
    {
        return view('auth.company.register');
    }


    public function signUp(Request $request)
    {
        $validated = $request->validate([
            'Company_name' => ['required', 'string', 'min:3', 'max:255'],
            'Official_email' => ['required', 'email', 'unique:companies,Official_email'],
            'Phone_number' => ['required', 'string', 'max:20'],
            'Address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        $company = Company::create([
            'Company_name' => $validated['Company_name'],
            'Official_email' => $validated['Official_email'],
            'Phone_number' => $validated['Phone_number'],
            'Address' => $validated['Address'],
            'password' => Hash::make($validated['password']),
            'Creation_date' => Carbon::now(),
        ]);
        Auth::guard('company')->login($company);
        return redirect()->intended(route('company.index'))
            ->with('success', 'Account created successfully.');
    }
}
