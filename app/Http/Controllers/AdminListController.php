<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index()
    {
        $userData = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();
        return view('admin.list.index', compact('userData'));
    }

    public function deleteList($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'User account deleted!']);
    }

    public function search(Request $request)
    {
        $userData = User::orWhere('name', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('email', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('address', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('gender', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->get();
        return view('admin.list.index', compact('userData'));
    }
}
