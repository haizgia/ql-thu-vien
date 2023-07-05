<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function loginPost(Request $request) {
        $data = $request->validate([
            'id' => 'required|numeric|max:1000000000',
            'password' => 'required|min:8',
        ], [
            'id.required' => "Mã số không được để trống",
            'id.max' => "Mã số không hợp lệ",
            'password.required' => "Mật khẩu không được để trống",
            'password.min' => "Mật khẩu phải có ít nhất 8 ký tự",
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            $user = User::find(Auth::user()->id);
            if ($user->hasRole('admin') || $user->hasRole('Super-Admin')) {
                return redirect('/admin');
            }
            return redirect('/');
        }

        return back()->withErrors([
            'error' => 'Mã số hoặc mật khẩu không chính xác',
        ]);
    }

    public function login(Request $request) {
        if (Auth::check()) {
            $this->logout($request);
        }
        // echo Hash::make('11111111');
        return view('user.login');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function change_password(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('user.change_password');
        } else {
            $validated = $request->validate([
                'oldpass' => 'required',
                'password' => ['required', 'confirmed', Password::min(8)],
                'password_confirmation' => 'required',
            ], [
                'oldpass.required' => 'Vui lòng nhập mật khẩu cũ',
                'password.required' => 'Vui lòng nhập mật khẩu mới',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
                'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
                'password_confirmation.required' => 'Vui lòng nhập xác nhận mật khẩu',
            ]);

            if(!Hash::check($request->oldpass, auth()->user()->password)){
                return back()->with("error", "Mật khẩu cũ không đúng");
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect('/')->with("success", "Password changed successfully!");
        }

    }
}
