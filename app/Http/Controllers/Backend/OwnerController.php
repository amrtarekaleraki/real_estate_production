<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function AllOwner()
    {
        $owners = Owner::with('User')->latest()->get();
        return view('backend.owners.all_owners',compact('owners'));
    }

        public function AllTenant()
    {
        $user_id = Auth::user()->role === 'admin';
        $tenants = Owner::with('User')->where('role','tenant')->where('added_by',$user_id)->latest()->get();
        return view('backend.owners.all_tenants',compact('tenants'));
    }


    public function AllOnlyOwner()
    {
        $user_id = Auth::user()->role === 'admin';
        $only_owners = Owner::with('User')->where('role','owner')->where('added_by',$user_id)->latest()->get();
        return view('backend.owners.only_owners',compact('only_owners'));
    }


    public function AddOwner()
    {
        return view('backend.owners.add_owners');
    }


    public function StoreOwner(Request $request)
    {
        DB::beginTransaction();

        try {

        $data = new Owner();
        $data->name = $request->name;
        $data->role = $request->role;
        $data->address = $request->name;
        $data->phone = $request->phone;
        $data->added_by = Auth::user()->id;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/owner_images'), $filename);

            // Remove previous photo if it exists
            if ($data->photo && file_exists(public_path('upload/owner_images/' . $data->photo))) {
                unlink(public_path('upload/owner_images/' . $data->photo));
            }

            // $data->photo = $filename;
            $data->photo = 'upload/owner_images/' . $filename;

        }

        $data->save();

        DB::commit();

        $notification = array(
            'message' => 'تم اضافة المستأجر او المالك بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.owner')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الاضافه',
                'alert-type' => 'error'
            ]);
        }
    }


    public function EditOwner($id)
    {
        $owner = Owner::findOrFail($id);

        return view('backend.owners.edit_owners',compact('owner'));
    }

    public function UpdateOwner(Request $request)
    {

        DB::beginTransaction();

        try {

        $owner = Owner::findOrFail($request->id);

        $owner->name = $request->name;
        $owner->role = $request->role;
        $owner->address = $request->address;
        $owner->phone = $request->phone;

        // Handle photo update
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/owner_images'), $filename);

            // Remove previous photo if it exists
            if ($owner->photo && file_exists(public_path($owner->photo))) {
                unlink(public_path($owner->photo));
            }

            // $owner->photo = $filename;
            $owner->photo = 'upload/owner_images/' . $filename;

        }

        $owner->save();

        DB::commit();

        $notification = [
            'message' => 'تم تحديث بيانات المستأجر او المالك بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.all.owner')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء التحديث',
                'alert-type' => 'error'
            ]);
        }

    }


    public function DeleteOwner($id)
    {

        DB::beginTransaction();

        try {

        $owner = Owner::findOrFail($id);
        $img = $owner->photo;


        // Check if the photo exists and then delete it
        if ($img && file_exists(public_path($img))) {
            unlink(public_path($img));
        }

        $owner->delete();


        DB::commit();

        $notification = [
            'message' => 'تم حذف المستأجر او المالك بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الحذف',
                'alert-type' => 'error'
            ]);
        }

    }


    public function OwnerInactive($id)
    {

        DB::beginTransaction();

        try {

        Owner::findOrFail($id)->update([
            'status' => 'inactive',
           ]);

           DB::commit();

           $notification = array(
               'message' => 'المستأجر او المالك غير مفعل',
               'alert-type' => 'success'
           );

           return redirect()->back()->with($notification);

            } catch (\Exception $e) {
                DB::rollback();

                return redirect()->back()->with([
                    'message' => 'حدث خطا اثناء تغيير الحاله',
                    'alert-type' => 'error'
                ]);
            }

    }


    public function OwnerActive($id)
    {

        DB::beginTransaction();

        try {

        Owner::findOrFail($id)->update([
            'status' => 'active',
            ]);

            DB::commit();

            $notification = array(
                'message' => 'المستأجر او المالك مفعل',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

            } catch (\Exception $e) {
                DB::rollback();

                return redirect()->back()->with([
                    'message' => 'حدث خطا اثناء تغيير الحاله',
                    'alert-type' => 'error'
                ]);
            }

    }





}
