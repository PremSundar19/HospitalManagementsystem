<?php

namespace App\Http\Controllers;

use App\Models\HospitalUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'dob' => 'required',
            'age' => 'required',
            'email' => 'required|unique:hospital_user,email',
            'mobile' => 'required',
            'password' => 'required',

        ]);
        $user = new HospitalUser();
        $user->first_name = $request->first_name;
        $user->last_name = $request->lastname;
        $user->dob = $request->dob;
        $user->age = $request->age;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('register')->with('message', 'Registration successfully!');
    }
}
