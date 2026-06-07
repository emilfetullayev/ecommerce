<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('site.auth.register');
    }

    public function showLogin()
    {
        return view('site.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'E-mail ünvanınızı daxil edin.',
            'email.email'       => 'Düzgün bir e-mail ünvanı daxil edin.',
            'password.required' => 'Şifrənizi daxil edin.',
        ]);

        $company = Company::where('email', $request->email)->first();

        if (!$company) {
            return back()->withErrors([
                'email' => 'Daxil etdiyiniz e-mail və ya şifrə yanlışdır.',
            ])->onlyInput('email');
        }

        if ($company->status !== 'active') {
            return back()->withErrors([
                'email' => 'Hesabınız hələ aktivləşdirilməyib. Administrator tərəfindən təsdiqləndikdən sonra daxil ola bilərsiniz.',
            ])->onlyInput('email');
        }

        $remember = $request->has('remember');

        if (Auth::guard('company')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('cart.index'))
                ->with('success', 'Xoş gəlmisiniz!');
        }

        return back()->withErrors([
            'email' => 'Daxil etdiyiniz e-mail və ya şifrə yanlışdır.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:companies',
            'phone'        => 'nullable|string|max:20',
            'password'     => 'required|string|min:6|confirmed',
        ], [
            'company_name.required' => 'Şirkət adını daxil edin.',
            'name.required'         => 'Ad və soyadınızı daxil edin.',
            'email.required'        => 'E-mail ünvanınızı daxil edin.',
            'email.email'           => 'Düzgün e-mail ünvanı daxil edin.',
            'email.unique'          => 'Bu e-mail artıq istifadə olunur.',
            'password.required'     => 'Şifrəni daxil edin.',
            'password.min'          => 'Şifrə ən azı 6 simvol olmalıdır.',
            'password.confirmed'    => 'Şifrələr uyğun gəlmir.',
        ]);

        Company::create([
            'company_name' => $request->company_name,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'status'       => 'pending', // admin aktivləşdirəcək
            'password'     => Hash::make($request->password),
        ]);

        return redirect()
            ->route('company.login')
            ->with(
                'success',
                'Qeydiyyat uğurla tamamlandı. Hesabınız yoxlanıldıqdan sonra aktivləşdiriləcək. Aktivləşdirildikdən sonra sistemə daxil ola bilərsiniz.'
            );
    }

    public function logout(Request $request)
    {
        Auth::guard('company')->logout();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
