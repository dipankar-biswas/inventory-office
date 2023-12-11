<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required','email',
        ]);

        $User = User::where('email', $request->email)->first();
        if($User){
            if(Hash::check($request->password, $User->password)){
                if(User::where('email', $request->email)->where('status', 1)->count() > 0){
                    Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember);
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->back()->with('failure','Your Account is Deactive. Please Contact!');
                }
            }else{
                return redirect()->back()->with('failure','Email or password not match!');
            }
        }

        // $request->validate([
        //     'title' => 'required',
        //     'name' => 'required|max:255',
        //     'bday' => 'required|date',
        //     'age' => 'required|numeric',
        //     'gender' => 'required',
        //     'phone' => 'required|min:10',
        //     'address' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|min:6|max:255',
        //     't&c' => 'required',
        // ]);

        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
