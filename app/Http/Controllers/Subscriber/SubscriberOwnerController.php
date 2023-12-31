<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberOwnerController extends Controller
{
    public function AllOwner()
    {
        $user_id = Auth::user()->id;
        $owners = Owner::where('added_by',$user_id)->latest()->get();
        return view('subscriber.owners.all_owners',compact('owners'));
    }

    public function AddOwner()
    {
        return view('subscriber.owners.add_owners');
    }

    public function StoreOwner(Request $request)
    {
        $data = new Owner();
        $data->name = $request->name;
        $data->role = $request->role;
        $data->address = $request->name;
        $data->phone = $request->phone;
        $data->added_by = Auth::user()->id;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/subscriber_owner_images'), $filename);

            // Remove previous photo if it exists
            if ($data->photo && file_exists(public_path('upload/subscriber_owner_images/' . $data->photo))) {
                unlink(public_path('upload/subscriber_owner_images/' . $data->photo));
            }

            // $data->photo = $filename;
            $data->photo = 'upload/subscriber_owner_images/' . $filename;

        }

        $data->save();

        $notification = array(
            'message' => 'تم اضافة المستأجر او المالك بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('subscriber.all.owner')->with($notification);
    }

    public function EditOwner($id)
    {


        // $owner = Owner::findOrFail($id);
        $owner = Owner::where('id',$id)->latest()->first();

        if (!$owner)
        {
            return redirect()->back();
        }

        if($owner->added_by != Auth::user()->id)
        {
            // abort(403);
            return redirect()->back();
        }

        return view('subscriber.owners.edit_owners',compact('owner'));
    }


    public function UpdateOwner(Request $request)
    {
        $owner = Owner::findOrFail($request->id);

        $owner->name = $request->name;
        $owner->role = $request->role;
        $owner->address = $request->address;
        $owner->phone = $request->phone;

        // Handle photo update
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/subscriber_owner_images'), $filename);

            // Remove previous photo if it exists
            if ($owner->photo && file_exists(public_path($owner->photo))) {
                unlink(public_path($owner->photo));
            }

            // $owner->photo = $filename;
            $owner->photo = 'upload/subscriber_owner_images/' . $filename;

        }

        $owner->save();

        $notification = [
            'message' => 'تم تحديث بيانات المستأجر او المالك بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('subscriber.all.owner')->with($notification);
    }



    public function DeleteOwner($id)
    {
        $owner = Owner::findOrFail($id);
        $img = $owner->photo;

        // Check if the photo exists and then delete it
        if ($img && file_exists(public_path($img))) {
            unlink(public_path($img));
        }

        $owner->delete();

        $notification = [
            'message' => 'تم حذف المستأجر او المالك بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function OwnerInactive($id)
    {
        Owner::findOrFail($id)->update([
            'status' => 'inactive',
           ]);

           $notification = array(
               'message' => 'المستأجر او المالك غير مفعل',
               'alert-type' => 'success'
           );

           return redirect()->back()->with($notification);

    }


    public function OwnerActive($id)
    {
        Owner::findOrFail($id)->update([
            'status' => 'active',
            ]);

            $notification = array(
                'message' => 'المستأجر او المالك مفعل',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }

}
