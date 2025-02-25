<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Category;
use App\Models\History;
use App\Models\MultiImg;
use App\Models\MultiVideo;
use App\Models\Owner;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuildingController extends Controller
{
    public function AllBuilding()
    {
        $buildings = Building::latest()->get();
        return view('backend.building.building_all',compact('buildings'));
    }

    public function SortByCategory($id)
    {
        $category = Category::findOrFail($id);
        $buildings = Building::where('category_id', $category->id)->latest()->get();
        $chosenCategory = Category::find($category->id)->category_name;
        return view('backend.building.sort_all', compact('buildings','chosenCategory'));
    }

    public function SortByRent()
    {
        $buildings = Building::where('building_selling_status','rent')->latest()->get();
        $chosenType = 'إيجار';
        return view('backend.building.sort_rent', compact('buildings','chosenType'));
    }

    public function SortByBuy()
    {
        $buildings = Building::where('building_selling_status','sell')->latest()->get();
        $chosenType = 'بيع';
        return view('backend.building.sort_buy', compact('buildings','chosenType'));
    }


    public function AddBuilding()
    {
        $tenants = Owner::where('role','tenant')->latest()->get();
        $owners = Owner::where('role','owner')->latest()->get();
        $categories = Category::latest()->get();
        return view('backend.building.building_add',compact('tenants','owners','categories'));
    }


    public function StoreBuilding(Request $request)
    {

        DB::beginTransaction();

        if($request->building_avilability_status === 'bussy')
        {

                //// Validate request
                $validated = $request->validate([
                    'building_cover_img' => 'required',
                    'building_title' => 'required',
                    'building_location' => 'required',
                    'category_id' => 'required',
                    'contract_price' => 'required',
                    'contract_date' => 'required',
                    'contract_longtime' => 'required',
                    'tenant_id' => 'required',
                    'owner_id' => 'required',
                    'contract_img' => 'required',
                    'building_selling_status' => 'required',
                    'status' => 'required',
                ], [
                    // Custom messages
                    'building_cover_img.required' => 'صوره العقار مطلوبه',
                    'building_title.required' => 'اسم العقار مطلوب',
                    'building_location.required' => 'عنوان العقار مطلوب',
                    'category_id.required' => 'اسم القسم مطلوب',
                    'contract_price.required' => ' قيمه العقد مطلوب',
                    'contract_date.required' => ' تاريخ التعاقد مطلوب',
                    'contract_longtime.required' => ' مده التعاقد مطلوب',
                    'tenant_id.required' => 'اسم المشتري او المستاجر مطلوب',
                    'owner_id.required' => 'اسم المالك مطلوب',
                    'contract_img.required' => 'صوره العقد مطلوبه',
                    'building_selling_status.required' => ' نوع العقار مطلوب',
                    'status.required' => ' حاله العقار مطلوب',
                ]);

        try {

        // building cover image start //
            $image = $request->file('building_cover_img');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/buildings/cover'),$name_gen);
            $save_url = 'upload/buildings/cover/'.$name_gen;
        // building cover image end //

        // building contract image start //
            $contract_image = $request->file('contract_img');
            $name_gen = hexdec(uniqid()).'.'.$contract_image->getClientOriginalExtension();
            $contract_image->move(public_path('upload/buildings/contract'),$name_gen);
            $save_url_contract = 'upload/buildings/contract/'.$name_gen;
        // building contract image end //


        $building_id = Building::insertGetId([

            'building_cover_img' => $save_url,
            'building_title' => $request->building_title,
            'building_location' => $request->building_location,
            'security_number' => $request->security_number,
            'building_map' => $request->building_map,
            'category_id' => $request->category_id,
            'area' => $request->area,
            'place' => $request->place,
            'rooms_num' => $request->rooms_num,
            'floor' => $request->floor,
            'floor_num' => $request->floor_num,
            'bathroom_num' => $request->bathroom_num,
            'building_size' => $request->building_size,
            'building_price' => $request->building_price,
            'building_selling_status' => $request->building_selling_status,
            'building_avilability_status' => $request->building_avilability_status,
            'wifi_status' => $request->wifi_status,
            'parking_status' => $request->parking_status,
            'building_desc' => $request->building_desc,
            'added_by' => Auth::user()->id,
            'notes' => $request->notes,
            'owner_id' => $request->owner_id,
            'tenant_id' => $request->tenant_id,
            'contract_price' => $request->contract_price,
            'contract_date' => $request->contract_date,
            'contract_img' => $save_url_contract,
            'contract_longtime' => $request->contract_longtime,
            'status' => $request->status,
            'created_at'=>Carbon::now(),

        ]);

        /// Multiple Image Upload From her //////
        if ($request->hasFile('multi_img'))
        {
            $images = $request->file('multi_img');
            foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('upload/buildings/multi-image/'),$make_name);
            $uploadPath = 'upload/buildings/multi-image/'.$make_name;

            MultiImg::insert([
                'building_id' => $building_id,
                'photo_name' => $uploadPath,
            ]);
            } // end foreach
        }

        /// End Multiple Image Upload From her //////



        /// Multiple video Upload From her //////
        if ($request->hasFile('multi_vid'))
        {
            $videos = $request->file('multi_vid');
            foreach($videos as $video){
            $make_name = hexdec(uniqid()).'.'.$video->getClientOriginalExtension();
            $video->move(public_path('upload/buildings/multi-video/'),$make_name);
            $videoPath = 'upload/buildings/multi-video/'.$make_name;

            MultiVideo::insert([
                'building_id' => $building_id,
                'video_name' => $videoPath,
            ]);
            } // end foreach
        }

        /// End Multiple video Upload From her //////



        /// history From her //////
            History::insert([
                'building_id' => $building_id,
                'owner_id' => $request->tenant_id,
                'contract_price' => $request->contract_price,
                'contract_date' => $request->contract_date,
                'contract_img' => $save_url_contract,
                'contract_long' => $request->contract_longtime,
                'created_at'=>Carbon::now(),
            ]);
        /// End history From her //////


        //start building-num for owner /////////////

        $owner_count = Owner::find($request->owner_id);
        if ($owner_count) {
            $buildingsCount = $owner_count->buildings()->count();
            $owner_count->update(['owner_building_num' => $buildingsCount]);
        }
        // end building-num for owner /////////////

        // Commit the transaction
        DB::commit();

        $notification = array(
            'message' => 'تم اضافه العقار بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.building')->with($notification);

        } //try end
        catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            // Return a redirect with an error message
            return redirect()->route('all.building')->with([
                'message' => 'حدث خطا اثناء الاضافه',
                'alert-type' => 'error'
            ]);
        }

        } //if end
        else
        {

            //// Validate request
            $validated = $request->validate([
                'building_cover_img' => 'required',
                'building_title' => 'required',
                'building_location' => 'required',
                'category_id' => 'required',
                'owner_id' => 'required',
                'building_selling_status' => 'required',
                'status' => 'required',
            ], [
                // Custom messages
                'building_cover_img.required' => 'صوره العقار مطلوبه',
                'building_title.required' => 'اسم العقار مطلوب',
                'building_location.required' => 'عنوان العقار مطلوب',
                'category_id.required' => 'اسم القسم مطلوب',
                'owner_id.required' => 'اسم المالك مطلوب',
                'building_selling_status.required' => ' نوع العقار مطلوب',
                'status.required' => ' حاله العقار مطلوب',
            ]);

            try {

                // building cover image start //
                    $image = $request->file('building_cover_img');
                    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('upload/buildings/cover'),$name_gen);
                    $save_url = 'upload/buildings/cover/'.$name_gen;
                // building cover image end //


                $building_id = Building::insertGetId([

                    'building_cover_img' => $save_url,
                    'building_title' => $request->building_title,
                    'building_location' => $request->building_location,
                    'security_number' => $request->security_number,
                    'building_map' => $request->building_map,
                    'category_id' => $request->category_id,
                    'area' => $request->area,
                    'place' => $request->place,
                    'rooms_num' => $request->rooms_num,
                    'floor' => $request->floor,
                    'floor_num' => $request->floor_num,
                    'bathroom_num' => $request->bathroom_num,
                    'building_size' => $request->building_size,
                    'building_price' => $request->building_price,
                    'building_selling_status' => $request->building_selling_status,
                    'building_avilability_status' => $request->building_avilability_status,
                    'wifi_status' => $request->wifi_status,
                    'parking_status' => $request->parking_status,
                    'building_desc' => $request->building_desc,
                    'added_by' => Auth::user()->id,
                    'notes' => $request->notes,
                    'owner_id' => $request->owner_id,
                    'status' => $request->status,
                    'created_at'=>Carbon::now(),

                ]);

                /// Multiple Image Upload From her //////
                if ($request->hasFile('multi_img'))
                {
                    $images = $request->file('multi_img');
                    foreach($images as $img){
                    $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                    $img->move(public_path('upload/buildings/multi-image/'),$make_name);
                    $uploadPath = 'upload/buildings/multi-image/'.$make_name;

                    MultiImg::insert([
                        'building_id' => $building_id,
                        'photo_name' => $uploadPath,
                    ]);
                    } // end foreach
                }

                /// End Multiple Image Upload From her //////



                /// Multiple video Upload From her //////
                if ($request->hasFile('multi_vid'))
                {
                    $videos = $request->file('multi_vid');
                    foreach($videos as $video){
                    $make_name = hexdec(uniqid()).'.'.$video->getClientOriginalExtension();
                    $video->move(public_path('upload/buildings/multi-video/'),$make_name);
                    $videoPath = 'upload/buildings/multi-video/'.$make_name;

                    MultiVideo::insert([
                        'building_id' => $building_id,
                        'video_name' => $videoPath,
                    ]);
                    } // end foreach
                }

                /// End Multiple video Upload From her //////


                //start building-num for owner /////////////

                $owner_count = Owner::find($request->owner_id);
                if ($owner_count) {
                    $buildingsCount = $owner_count->buildings()->count();
                    $owner_count->update(['owner_building_num' => $buildingsCount]);
                }
                // end building-num for owner /////////////

                // Commit the transaction
                DB::commit();

                $notification = array(
                    'message' => 'تم اضافه العقار بنجاح',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.building')->with($notification);

                } //try end
                catch (\Exception $e) {
                    // An error occurred; cancel the transaction...
                    DB::rollback();

                    // Return a redirect with an error message
                    return redirect()->route('all.building')->with([
                        'message' => 'حدث خطا اثناء الاضافه',
                        'alert-type' => 'error'
                    ]);
                }
        }//else end

    }//end method


    public function ShowBuilding($id)
    {
         $histories = History::with('Building')->where('building_id',$id)->get();
         $buildings = Building::with('Owner')->findOrFail($id);
         $multiImgs = MultiImg::where('building_id',$id)->get();
         $multiVideos = MultiVideo::where('building_id',$id)->get();
         return view('backend.building.building_show',compact('multiImgs','multiVideos','buildings','histories'));
    }//end method



    public function EditBuilding($id)
    {
         $multiImgs = MultiImg::where('building_id',$id)->get();
         $multiVideos = MultiVideo::where('building_id',$id)->get();
         $buildings = Building::with('Owner')->findOrFail($id);
         $tenants = Owner::where('role','tenant')->latest()->get();
         $owners = Owner::where('role','owner')->latest()->get();
         $categories = Category::latest()->get();
         return view('backend.building.building_edit',compact('multiImgs','multiVideos','buildings','tenants','owners','categories'));
    }//end method



    public function UpdateBuilding(Request $request)
    {

        DB::beginTransaction();

        if($request->building_avilability_status === 'bussy')
        {

                //// Validate request
                $validated = $request->validate([
                    'building_title' => 'required',
                    'building_location' => 'required',
                    'category_id' => 'required',
                    'contract_price' => 'required',
                    'contract_date' => 'required',
                    'contract_longtime' => 'required',
                    'tenant_id' => 'required',
                    'owner_id' => 'required',
                ], [
                    // Custom messages
                    'building_title.required' => 'اسم العقار مطلوب',
                    'building_location.required' => 'عنوان العقار مطلوب',
                    'category_id.required' => 'اسم القسم مطلوب',
                    'contract_price.required' => ' قيمه العقد مطلوب',
                    'contract_date.required' => ' تاريخ التعاقد مطلوب',
                    'contract_longtime.required' => ' مده التعاقد مطلوب',
                    'tenant_id.required' => 'اسم المشتري او المستاجر مطلوب',
                    'owner_id.required' => 'اسم المالك مطلوب',
                ]);

        try {
            // Your existing code here...


            $building = Building::findOrFail($request->id);


            $building->building_title = $request->building_title;
            $building->building_location = $request->building_location;
            $building->security_number = $request->security_number;
            $building->building_map = $request->building_map;
            $building->category_id = $request->category_id;
            $building->area = $request->area;
            $building->place = $request->place;
            $building->rooms_num = $request->rooms_num;
            $building->floor = $request->floor;
            $building->floor_num = $request->floor_num;
            $building->bathroom_num = $request->bathroom_num;
            $building->building_size = $request->building_size;
            $building->building_price = $request->building_price;
            $building->building_selling_status = $request->building_selling_status;
            $building->building_avilability_status = $request->building_avilability_status;
            $building->wifi_status = $request->wifi_status;
            $building->parking_status = $request->parking_status;
            $building->building_desc = $request->building_desc;
            $building->notes = $request->notes;
            // $building->owner_id = $request->owner_id;
            $building->tenant_id = $request->tenant_id;
            $building->contract_price = $request->contract_price;
            $building->contract_date = $request->contract_date;
            $building->contract_longtime = $request->contract_longtime;
            $building->status = $request->status;




        // Handle cover image update
        if ($request->hasFile('building_cover_img'))
        {
            $file = $request->file('building_cover_img');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/buildings/cover'), $filename);

            // Remove previous building_cover_img if it exists
            if ($building->building_cover_img && file_exists(public_path($building->building_cover_img))) {
                unlink(public_path($building->building_cover_img));
            }

            $building->building_cover_img = 'upload/buildings/cover/' . $filename;
        }


        // Handle contract image update
        if ($request->hasFile('contract_img'))
        {
            $file = $request->file('contract_img');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/buildings/contract'), $filename);

            // Remove previous contract_img if it exists
            // if ($building->contract_img && file_exists(public_path($building->contract_img))) {
            //     unlink(public_path($building->contract_img));
            // }

            $building->contract_img = 'upload/buildings/contract/' . $filename;
            $update_url_contract = 'upload/buildings/contract/'.$filename;
        }


           /// Multiple Image Upload From her //////
           if ($request->hasFile('multi_img'))
           {
               $images = $request->file('multi_img');
               foreach($images as $img){
               $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
               $img->move(public_path('upload/buildings/multi-image/'),$make_name);
               $uploadPath = 'upload/buildings/multi-image/'.$make_name;

               MultiImg::insert([
                   'building_id' => $building->id,
                   'photo_name' => $uploadPath,
               ]);
               } // end foreach
           }

           /// End Multiple Image Upload From her //////



           /// Multiple video Upload From her //////
           if ($request->hasFile('multi_vid'))
           {
               $videos = $request->file('multi_vid');
               foreach($videos as $video){
               $make_name = hexdec(uniqid()).'.'.$video->getClientOriginalExtension();
               $video->move(public_path('upload/buildings/multi-video/'),$make_name);
               $videoPath = 'upload/buildings/multi-video/'.$make_name;

               MultiVideo::insert([
                   'building_id' => $building->id,
                   'video_name' => $videoPath,
               ]);
               } // end foreach
           }

           /// End Multiple video Upload From her //////


        // $building->save();



        //// check if there any change in contract date insert new record in history
        $lastHistoryRecord = History::where('building_id',$building->id)->latest()->first(); // Retrieve the last record in history

        if ($lastHistoryRecord) {
            $lastContractDate = new DateTime($lastHistoryRecord->contract_date);
            $newContractDate = new DateTime($request->contract_date);

            $lastDateString = $lastContractDate->format('Y-m-d');
            $newDateString = $newContractDate->format('Y-m-d');

            if ($lastDateString === $newDateString) {
                // Do not insert into history table as the dates are the same
            } else {

                ///// copy the contract image
                $oldContractImagePath = public_path($building->contract_img);

                if (file_exists($oldContractImagePath)) {
                    // Generate a unique filename with timestamp:
                    $filename = date('YmdHis') . '_' . basename($oldContractImagePath);
                    $newContractImagePath = public_path('upload/buildings/contract/' . $filename);

                    if (copy($oldContractImagePath, $newContractImagePath)) {
                        $building->contract_img = 'upload/buildings/contract/' . $filename;
                        // ... (update other related fields or variables as needed)
                    }
                }

                // Insert into history table
                History::insert([
                    'building_id' => $building->id,
                    'owner_id' => $building->tenant_id,
                    'contract_price' => $building->contract_price,
                    'contract_date' => $building->contract_date,
                    // 'contract_img' => isset($update_url_contract) ? $update_url_contract : $building->contract_img,
                    'contract_img' => isset($update_url_contract) ? $update_url_contract : $building->contract_img,
                    'contract_long' => $building->contract_longtime,
                    'created_at'=>Carbon::now(),
                ]);
            }
        }else
        {
            History::insert([
                'building_id' => $building->id,
                'owner_id' => $building->tenant_id,
                'contract_price' => $building->contract_price,
                'contract_date' => $building->contract_date,
                // 'contract_img' => isset($update_url_contract) ? $update_url_contract : $building->contract_img,
                'contract_img' => isset($update_url_contract) ? $update_url_contract : $building->contract_img,
                'contract_long' => $building->contract_longtime,
                'created_at'=>Carbon::now(),
            ]);
        }

        //// check if there any change in owner id change the building_num in owners table
        $oldOwnerId = $building->owner_id;
        $newOwnerId = $request->owner_id;

        if ($oldOwnerId !== $newOwnerId) {
            $oldOwner = Owner::find($oldOwnerId);
            $newOwner = Owner::find($newOwnerId);

            if ($oldOwner && $oldOwner->owner_building_num > 0) {
                $oldOwner->decrement('owner_building_num');
            }

            if ($newOwner) {
                $newOwner->increment('owner_building_num');
            }
        }


            $building->owner_id = $request->owner_id;
            $building->save();

        // ////////////////////////////////////////////////////////////

        // Commit the transaction
        DB::commit();

        $notification = array(
        'message' => 'تم تحديث معلومات المبني بنجاح',
        'alert-type' => 'success'
        );

        return redirect()->route('all.building')->with($notification);

        } /// try end
        catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            // Return a redirect with an error message
            return redirect()->route('all.building')->with([
                'message' => 'حدث خطأ أثناء التحديث',
                'alert-type' => 'error'
            ]);
        } /// catch end
    } // if end
    else
    {
                //// Validate request
                $validated = $request->validate([
                    'building_title' => 'required',
                    'building_location' => 'required',
                    'category_id' => 'required',
                    'owner_id' => 'required',
                ], [
                    // Custom messages
                    'building_title.required' => 'اسم العقار مطلوب',
                    'building_location.required' => 'عنوان العقار مطلوب',
                    'category_id.required' => 'اسم القسم مطلوب',
                    'owner_id.required' => 'اسم المالك مطلوب',
                ]);

        try {
            // Your existing code here...


            $building = Building::findOrFail($request->id);


            $building->building_title = $request->building_title;
            $building->building_location = $request->building_location;
            $building->security_number = $request->security_number;
            $building->building_map = $request->building_map;
            $building->category_id = $request->category_id;
            $building->area = $request->area;
            $building->place = $request->place;
            $building->rooms_num = $request->rooms_num;
            $building->floor = $request->floor;
            $building->floor_num = $request->floor_num;
            $building->bathroom_num = $request->bathroom_num;
            $building->building_size = $request->building_size;
            $building->building_price = $request->building_price;
            $building->building_selling_status = $request->building_selling_status;
            $building->building_avilability_status = $request->building_avilability_status;
            $building->wifi_status = $request->wifi_status;
            $building->parking_status = $request->parking_status;
            $building->building_desc = $request->building_desc;
            $building->notes = $request->notes;
            // $building->owner_id = $request->owner_id;
            $building->tenant_id = $request->tenant_id;
            $building->contract_price = $request->contract_price;
            $building->contract_date = $request->contract_date;
            $building->contract_longtime = $request->contract_longtime;
            $building->status = $request->status;




        // Handle cover image update
        if ($request->hasFile('building_cover_img'))
        {
            $file = $request->file('building_cover_img');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/buildings/cover'), $filename);

            // Remove previous building_cover_img if it exists
            if ($building->building_cover_img && file_exists(public_path($building->building_cover_img))) {
                unlink(public_path($building->building_cover_img));
            }

            $building->building_cover_img = 'upload/buildings/cover/' . $filename;
        }

        // Handle contract image update
        if ($request->hasFile('contract_img'))
        {
            $file = $request->file('contract_img');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/buildings/contract'), $filename);

            // Remove previous contract_img if it exists
            // if ($building->contract_img && file_exists(public_path($building->contract_img))) {
            //     unlink(public_path($building->contract_img));
            // }

            $building->contract_img = 'upload/buildings/contract/' . $filename;
            $update_url_contract = 'upload/buildings/contract/'.$filename;
        }


         //// check if there any change in contract date insert new record in history
         $lastHistoryRecord = History::where('building_id',$building->id)->latest()->first(); // Retrieve the last record in history

         if ($lastHistoryRecord) {
             $lastContractDate = new DateTime($lastHistoryRecord->contract_date);
             $newContractDate = new DateTime($request->contract_date);

             $lastDateString = $lastContractDate->format('Y-m-d');
             $newDateString = $newContractDate->format('Y-m-d');

             if ($lastDateString === $newDateString) {
                 // Do not insert into history table as the dates are the same
             } else {

                 ///// copy the contract image
                 $oldContractImagePath = public_path($building->contract_img);

                 if (file_exists($oldContractImagePath)) {
                     // Generate a unique filename with timestamp:
                     $filename = date('YmdHis') . '_' . basename($oldContractImagePath);
                     $newContractImagePath = public_path('upload/buildings/contract/' . $filename);

                     if (copy($oldContractImagePath, $newContractImagePath)) {
                         $building->contract_img = 'upload/buildings/contract/' . $filename;
                         // ... (update other related fields or variables as needed)
                     }
                 }

                 // Insert into history table
                 History::insert([
                     'building_id' => $building->id,
                     'owner_id' => $building->tenant_id,
                     'contract_price' => $building->contract_price,
                     'contract_date' => $building->contract_date,
                     // 'contract_img' => isset($update_url_contract) ? $update_url_contract : $building->contract_img,
                     'contract_img' => isset($update_url_contract) ? $update_url_contract : $building->contract_img,
                     'contract_long' => $building->contract_longtime,
                     'created_at'=>Carbon::now(),
                 ]);
             }
         }

           /// Multiple Image Upload From her //////
           if ($request->hasFile('multi_img'))
           {
               $images = $request->file('multi_img');
               foreach($images as $img){
               $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
               $img->move(public_path('upload/buildings/multi-image/'),$make_name);
               $uploadPath = 'upload/buildings/multi-image/'.$make_name;

               MultiImg::insert([
                   'building_id' => $building->id,
                   'photo_name' => $uploadPath,
               ]);
               } // end foreach
           }

           /// End Multiple Image Upload From her //////



           /// Multiple video Upload From her //////
           if ($request->hasFile('multi_vid'))
           {
               $videos = $request->file('multi_vid');
               foreach($videos as $video){
               $make_name = hexdec(uniqid()).'.'.$video->getClientOriginalExtension();
               $video->move(public_path('upload/buildings/multi-video/'),$make_name);
               $videoPath = 'upload/buildings/multi-video/'.$make_name;

               MultiVideo::insert([
                   'building_id' => $building->id,
                   'video_name' => $videoPath,
               ]);
               } // end foreach
           }

           /// End Multiple video Upload From her //////


        // $building->save();


        //// check if there any change in owner id change the building_num in owners table
        $oldOwnerId = $building->owner_id;
        $newOwnerId = $request->owner_id;

        if ($oldOwnerId !== $newOwnerId) {
            $oldOwner = Owner::find($oldOwnerId);
            $newOwner = Owner::find($newOwnerId);

            if ($oldOwner && $oldOwner->owner_building_num > 0) {
                $oldOwner->decrement('owner_building_num');
            }

            if ($newOwner) {
                $newOwner->increment('owner_building_num');
            }
        }


            $building->owner_id = $request->owner_id;
            $building->save();

        // ////////////////////////////////////////////////////////////

        // Commit the transaction
        DB::commit();

        $notification = array(
        'message' => 'تم تحديث معلومات المبني بنجاح',
        'alert-type' => 'success'
        );

        return redirect()->route('all.building')->with($notification);

        } /// try end
        catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            // Return a redirect with an error message
            return redirect()->route('all.building')->with([
                'message' => 'حدث خطأ أثناء التحديث',
                'alert-type' => 'error'
            ]);
        } /// catch end
    } /// else end


    }//end method



    // Multi Image Update
    public function UpdateBuildingMultiimage(Request $request){

        DB::beginTransaction();

        try {

        $imgs = $request->multi_img;

        foreach($imgs as $id => $img ){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            // Generate a unique name for the image
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();

            // Move the uploaded file to the desired directory
            $img->move('upload/buildings/multi-image/', $make_name);

            $uploadPath = 'upload/buildings/multi-image/'.$make_name;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        } // end foreach

        DB::commit();
        $notification = array(
            'message' => 'تم تحديث صور العقار بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا ما اثناء التحديث',
                'alert-type' => 'error'
            ]);
        }

    }// End Method



    public function MulitImageDelelte($id){

        DB::beginTransaction();

        try {

        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImg::findOrFail($id)->delete();

        DB::commit();

        $notification = array(
            'message' => 'تم حذف صور العقار بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الحذف',
                'alert-type' => 'error'
            ]);
        }


    }// End Method




    // Multi Video Update
    public function UpdateBuildingMultiVideo(Request $request){

        DB::beginTransaction();

        try {

        $videos = $request->multi_video;

        foreach($videos as $id => $video ){
            $videoDel = MultiVideo::findOrFail($id);
            unlink($videoDel->video_name);

            // Generate a unique name for the image
            $make_name = hexdec(uniqid()).'.'.$video->getClientOriginalExtension();

            // Move the uploaded file to the desired directory
            $video->move('upload/buildings/multi-video/', $make_name);

            $uploadPath = 'upload/buildings/multi-video/'.$make_name;

            MultiVideo::where('id',$id)->update([
                'video_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        } // end foreach

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث فيديوهات العقار بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا ما اثناء التحديث',
                'alert-type' => 'error'
            ]);
        }

    }// End Method



    public function MultiVideoDelelte($id){

        DB::beginTransaction();

        try {

        $oldVideo = MultiVideo::findOrFail($id);
        unlink($oldVideo->video_name);

        MultiVideo::findOrFail($id)->delete();


        DB::commit();

        $notification = array(
            'message' => 'تم حذف فيديوهات العقار بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الحذف',
                'alert-type' => 'error'
            ]);
        }


    }// End Method




// public function HistoryDelelte($id){


//     $oldhistory = History::findOrFail($id);
//     $lastBuildingRecord = Building::latest()->first();


//     if($oldhistory->contract_img != $lastBuildingRecord->contract_img)
//     {

//         // Remove previous contract if it exists
//         if ($oldhistory->contract_img && file_exists(public_path($oldhistory->contract_img)))
//         {
//             unlink(public_path($oldhistory->contract_img));
//         }

//         History::findOrFail($id)->delete();



//         $notification = array(
//             'message' => 'تم حذف أرشيف العقار بنجاح',
//             'alert-type' => 'success'
//         );

//         return redirect()->back()->with($notification);

//     }
//     else
//     {
//         $notifications = array(
//             'message' => ' لا يمكن حذف أرشيف العقار لانه مستخدم حاليا مع العقار',
//             'alert-type' => 'error'
//         );

//         return redirect()->back()->with($notifications);
//     }

// }// End Method

    public function HistoryDelelte($id)
    {
        DB::beginTransaction();

        try {
            $oldhistory = History::findOrFail($id);
            $lastBuildingRecord = Building::latest()->first();

            if($oldhistory->contract_img != $lastBuildingRecord->contract_img)
            {
                // Remove previous contract if it exists
                if ($oldhistory->contract_img && file_exists(public_path($oldhistory->contract_img)))
                {
                    unlink(public_path($oldhistory->contract_img));
                }

                History::findOrFail($id)->delete();

                DB::commit();

                $notification = array(
                    'message' => 'تم حذف أرشيف العقار بنجاح',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }
            else
            {
                DB::rollback();

                $notifications = array(
                    'message' => ' لا يمكن حذف أرشيف العقار لانه مستخدم حاليا مع العقار',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notifications);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الحذف',
                'alert-type' => 'error'
            ]);
        }
    }



    public function BuildingDelete($id){


        DB::beginTransaction();

        try {

        $building = Building::findOrFail($id);
        unlink($building->building_cover_img);
        // unlink($building->contract_img);
        Building::findOrFail($id)->delete();

        $imges = MultiImg::where('building_id',$id)->get();
        foreach($imges as $img){
            unlink($img->photo_name);
            MultiImg::where('building_id',$id)->delete();
        }


        $videos = MultiVideo::where('building_id',$id)->get();
        foreach($videos as $video){
            unlink($video->video_name);
            MultiVideo::where('building_id',$id)->delete();
        }


        $histories = History::where('building_id',$id)->get();
        foreach($histories as $history){
            unlink($history->contract_img);
            History::where('building_id',$id)->delete();
        }



        DB::commit();

        $notification = array(
            'message' => 'تم حذف العقار بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الحذف',
                'alert-type' => 'error'
            ]);
        }

    }// End Method






}
