<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admins-read')->only('index');
        $this->middleware('permission:admins-create')->only('create');
        $this->middleware('permission:admins-update')->only('edit');
        $this->middleware('permission:admins-delete')->only('destroy');
    }

    public function index(Request $request)
    {

        $admins = Admin::WhereRoleIs('admin')->where(function($q) use ($request){
            return $q->when($request->search,function($query) use ($request){
                return $query->Where('first_name','like','%'. $request->search .'%')
                ->orWhere('last_name','like','%'. $request->search .'%');
            });
        })->latest()->paginate(5);
        return view('admin.admins.index',compact('admins'));
    }


    public function create()
    {
        return view('admin.admins.create');
    }


    public function store(AdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $request_data = $request->except(['password','password_confirmation','permissions','image']);
            $request_data['password'] = bcrypt($request->password);
            if($request->image){
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/admin_images/'. $request->image->hashname()));
                $request_data['image'] = $request->image->hashname();
            }

            $admin = Admin::create($request_data);
            $admin->attachRole('admin');
            if($request->permissions != []){
                $admin->syncPermissions($request->permissions);
            }
            DB::commit();
            return redirect()->route('admin.admins.index')->with('success',__('site.added_successfully'));
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.admins.index')->with('error',__('site.exception_error'));
        }

    }



    public function edit(Admin $admin)
    {
        return view('admin.admins.edit',compact('admin'));
    }


    public function update(AdminRequest $request, Admin $admin)
    {
        try {
            DB::beginTransaction();
            $request_data = $request->except(['password','password_confirmation','permissions']);
            if($request->password != null ){
                $request_data['password'] = bcrypt($request->password);
            }

            if($request->image){
                if($admin->image != 'default.png'){
                    Storage::disk('public_uploads')->delete('/admin_images/'.$admin->image);
                }
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/admin_images/'. $request->image->hashname()));
                $request_data['image'] = $request->image->hashname();
            }
            $admin->update($request_data);
            if($request->permissions == null){
                $admin->detachPermissions($request->permissions);
            }else{
                $admin->syncPermissions($request->permissions);
            }
            DB::commit();
            return redirect()->route('admin.admins.index')->with('success',__('site.updated_successfully'));
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.admins.index')->with('error',__('site.exception_error'));
        }  

    }


    public function destroy(Admin $admin)
    {
        try{
            if($admin->image != 'dafault.png'){
                Storage::disk('public_uploads')->delete('/admin_images/'.$admin->image);
            }
            $admin->delete();
            return redirect()->route('admin.admins.index')->with('success',__('site.deleted_successfully'));
        }catch(\Exception $ex){
            return redirect()->route('admin.admins.index')->with('error',__('site.exception_error'));
        }

    }
}
