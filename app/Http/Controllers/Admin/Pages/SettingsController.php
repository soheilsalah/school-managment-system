<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function index()
    {
        return view('admin.pages.settings.index');
    }

    public function updateInfo(Request $request)
    {
        $name = $request->input('username');
        $email = $request->input('email');

        Admin::first()->update([
            'name' => $name,
            'email' => $email,
        ]);

        $this->successMsg('تم تحديث بياناتك');
    }

    public function updatePassword(Request $request)
    {
        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        !Hash::check($current_password, Auth::guard('admin')->user()->password) ? $this->errorMsg('كلمة السر الحالية غير صحيحة') : true;

        strlen($new_password) < 6 ? $this->errorMsg('يجب ان تكون كلمة السر مكونة من 6 رموز علي الاقل') : true;

        $new_password !== $confirm_password ? $this->errorMsg('كلمة السر غير متطابقة') : true;

        Admin::first()->update([
            'password' => Hash::make($new_password),
        ]);

        $this->successMsg('تم تحديث كلمة السر الخاصة بالحساب');

        Auth::guard('admin')->logout();

        $this->reloadPage();
    }
}
