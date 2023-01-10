<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function authenticated()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "owner") {
                return redirect('dormitories');
            } else {
                return redirect()->route('agreement.noti.show');
            }
        } else {
            return redirect('auth.login');
        }
    }

    public function saveImage($image, $upload_location)
    {
        // การเข้ารหัสภาพ
        $name_gen =  hexdec(uniqid()); // genarate ชื่อ
        $img_ext = strtolower($image->getClientOriginalExtension()); // ดึงนามสกุล File Image
        $img_name = $name_gen . '.' . $img_ext;
        //อัพโหลดภาพ
        // $upload_location = 'image/dorm/';
        $full_path = $upload_location . $img_name;
        $image->move($upload_location, $img_name);

        return $full_path;
    }
}
