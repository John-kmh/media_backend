<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct profile info
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->where('id', $id)->first();
        return view('admin.profile.index', compact('user'));
    }

    //direct edit page
    public function edit()
    {
        $id = Auth::user()->id;
        $userInfo = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->where('id', $id)->first();
        return view('admin.profile.profileUpdateView', compact('userInfo'));
    }

    //update profile
    public function update(Request $request)
    {
        $userData = $this->getUserInfo($request);
        $validator =  $this->validationChecked($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', Auth::user()->id)->update($userData);

        return back()->with(['updateSuccess' => 'Admin account updated!']);
    }

    //direct change password page
    public function changePassword()
    {
        return view('admin.profile.passwordChangeView');
    }

    //update password
    public function updatePassword(Request $request)
    {
        $validator =  $this->passwordValidationChecked($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        $hashUserPassword = Hash::make($request->newPassword);

        $updatedData = [
            'password' => $hashUserPassword,
        ];

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update($updatedData);
            return redirect()->route('login');
        } else {
            return back()->with(['fail' => 'Old Password Do not Match!']);
        }
    }

    //get user info
    private function getUserInfo($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
            'gender' => $request->adminGender,
        ];
    }

    //user validation
    private function validationChecked($request)
    {
        return  Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
            'adminAddress' => 'required',
            'adminPhone' => 'required',
            'adminGender' => 'required',
        ]);
    }

    //password validation
    private function passwordValidationChecked($request)
    {
        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|same:newPassword|min:8|max:15',
        ]);
    }
}
