<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::get();
        return view('admin.admins.index',compact('admins'));
    }


    public function create()
    {
        return view('admin.admins.create');
    }


    public function store(Request $request)
    {
        $admin = Admin::create([
            $request->except('_token')
        ]);
    }



    public function edit(Admin $admin)
    {
        //
    }


    public function update(Request $request, Admin $admin)
    {
        //
    }


    public function destroy(Admin $admin)
    {
        //
    }
}
