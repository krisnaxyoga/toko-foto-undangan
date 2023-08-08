<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function save_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->role_id = 2;

            $data->save();

            $cust = new Customer();
            $cust->user_id = $data->id;
            $cust->name = $request->name;
            $cust->phone = $request->phone;
            $cust->address = $request->address;
            $cust->save();

            return redirect('/login')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    public function dologin(Request $request)
    {
        // validasi
        // dd($request->pin);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user superadmin
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/customer');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgetpassword(){
        return view('auth.forgetpassword');
    }

    public function sendEmail(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        // Get the user by email
        $user = User::where('email', $request->email)->first();

        // Generate a new password reset token
        $token = Str::random(8);

        // Save the token to the database
        $user->password = Hash::make($token);
        $user->save();

        // Send an email to the user with the password reset link
        Mail::to($user->email)->send(new ForgotPassword($user, $token));

        // Return a success response
        return redirect()
                ->route('login')
                ->with('message', 'The password has been updated successfully, you can check your email for a new password');
    }
}
