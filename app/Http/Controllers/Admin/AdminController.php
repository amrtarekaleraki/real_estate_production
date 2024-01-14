<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BuildingExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Category;
use App\Models\History;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $buildings = Building::latest()->get();

        $sellingContractPrice = History::join('buildings', 'histories.building_id', '=', 'buildings.id')
        ->join('owners', 'buildings.owner_id', '=', 'owners.id')
        ->join('users', 'owners.added_by', '=', 'users.id')
        ->where('buildings.building_selling_status', 'sell')
        ->whereNotNull('histories.contract_price')
        ->where('users.role', 'admin')
        ->sum('histories.contract_price');

        // Cast the sum to an integer to remove the decimal part
        $sellingContractPrice = (int) $sellingContractPrice;


        // //////////////////////////////////////////////////////////////////
        $rentingContractPrice = History::join('buildings', 'histories.building_id', '=', 'buildings.id')
        ->join('owners', 'buildings.owner_id', '=', 'owners.id')
        ->join('users', 'owners.added_by', '=', 'users.id')
        ->where('buildings.building_selling_status', 'rent')
        ->whereNotNull('histories.contract_price')
        ->where('users.role', 'admin')
        ->sum('histories.contract_price');

        // Cast the sum to an integer to remove the decimal part
        $rentingContractPrice = (int) $rentingContractPrice;

        /////////////////////////////////////////////////////////////////////
        $currentMonth = Carbon::now()->month;

        $monthContractPrice = History::join('buildings', 'histories.building_id', '=', 'buildings.id')
            ->join('owners', 'buildings.owner_id', '=', 'owners.id')
            ->join('users', 'owners.added_by', '=', 'users.id')
            ->whereMonth('histories.contract_date', $currentMonth)  // Filter by current month directly
            ->whereYear('histories.contract_date', now()->year)   // Filter by current year
            ->where(function ($query) {
                $query->where('buildings.building_selling_status', 'sell')
                    ->orWhere('buildings.building_selling_status', 'rent');
            })
            ->whereNotNull('histories.contract_price')
            ->where('users.role', 'admin')
            ->sum('histories.contract_price');

        $monthContractPrice = (int) $monthContractPrice;

        ///////////////////////////////////////////////////////////////////////////


                $monthlyData = [];

                // Arabic month names array
                $arabicMonths = [
                    'يناير',
                    'فبراير',
                    'مارس',
                    'إبريل',
                    'مايو',
                    'يونيو',
                    'يوليو',
                    'أغسطس',
                    'سبتمبر',
                    'أكتوبر',
                    'نوفمبر',
                    'ديسمبر'
                ];

                // Get the current year
                $currentYear = Carbon::now()->year;

                // Loop through each month of the year
                for ($month = 1; $month <= 12; $month++) {
                    // Get the start and end date of the month
                    $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
                    $endDate = $startDate->copy()->endOfMonth();

                    // Get the Arabic month name
                    $monthName = $arabicMonths[$month - 1]; // Adjust array index (month starts from 1)

                    // Query to count rows for 'rent' status within the current month
                    $rentData = Building::where('building_selling_status', 'rent')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->count();

                    // Query to count rows for 'sell' status within the current month
                    $sellData = Building::where('building_selling_status', 'sell')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->count();

                    // Store the data for the current month in the array
                    $monthlyData[] = [
                        'month' => $monthName, // Month name in Arabic
                        'rent' => $rentData,
                        'sell' => $sellData
                    ];
                }


                ////////////////////// charts start/////////////////////////
                $sakani_chart = Building::where('category_id',1)->count();
                $tgari_chart = Building::where('category_id',2)->count();
                $aradi_chart = Building::where('category_id',3)->count();
                $estsmari_chart = Building::where('category_id',4)->count();


        //////////////////////////
        $rent_buildings = Building::join('users', 'buildings.added_by', '=', 'users.id')
        ->where('users.role', 'admin')
        ->where('building_selling_status','rent')
        ->count();
        $sell_buildings = Building::join('users', 'buildings.added_by', '=', 'users.id')
        ->where('users.role', 'admin')
        ->where('building_selling_status','sell')
        ->count();

        if($rent_buildings === 0)
        {
            $rent_percentage = 0;
        }
        else
        {
            $rent_percentage = (($rentingContractPrice / $rent_buildings) / 100);
        }
        //////////////////////////////
        if($sell_buildings === 0)
        {
            $sell_percentage = 0;
        }
        else
        {
           $sell_percentage = (($sellingContractPrice / $sell_buildings) / 100);
        }
        /////////////////////
        if($monthContractPrice === 0)
        {
            $month_percentage = 0;
        }
        else
        {
            $month_percentage = $monthContractPrice / 100;
        }
        /////////////////////////

        ////num of buildings added by admin ///
        $total_num_buildings = Building::join('users', 'buildings.added_by', '=', 'users.id')
        ->where('users.role', 'admin')
        ->count();

        /////////////////////////
        $AllBuildingSystem = Building::latest()->get()->count();
        if($AllBuildingSystem === 0)
        {
            $building_percentage = 0;
        }
        else
        {
            $building_percentage = floor((($total_num_buildings / $AllBuildingSystem) * 100));
        }



        return view('admin.index', compact('buildings','total_num_buildings','building_percentage','sellingContractPrice','rentingContractPrice','monthContractPrice','monthlyData','sakani_chart','tgari_chart','aradi_chart','estsmari_chart','rent_percentage','sell_percentage','month_percentage',));
    }

     public function AdminSwitcher()
     {
        $categories = Category::latest()->get();
        foreach($categories as $item)
        {
           $category_id = $item->id;
        }
        $buildings =  Building::where('category_id', $category_id)->latest()->get();

        return view('admin.switcher',compact('categories','buildings'));
     }


     public function fetchBuildingsByCategory($categoryId)
     {
        $buildings = Building::where('category_id', $categoryId)->latest()->get();
        return response()->json(['buildings' => $buildings]);
     }


     public function AdminLogin()
     {
         return view('admin.admin_login');
     }


    // InActivePage /////////////////////////
        public function InActivePage()
        {
            return view('admin.inactive_page');
        }
    // InActivePage///////////////////////


    public function InActiveSubscriber()
    {
        return view('admin.inactive_subscriber');
    }

     public function AdminDestroy(Request $request)
     {
         Auth::guard('web')->logout();

         $request->session()->invalidate();

         $request->session()->regenerateToken();

         return redirect('/admin/login');
     }

     public function AdminProfile()
     {
         $id = Auth::user()->id;
         $adminData = User::find($id);
         return view('admin.admin_profile_view', compact('adminData'));
     }


     public function AdminProfileStore(Request $request)
     {
         $id = Auth::user()->id;
         $data = User::find($id);

         $data->name = $request->name;
         $data->email = $request->email;
         $data->phone = $request->phone;

         if ($request->file('photo')) {
             $file = $request->file('photo');
             // Remove previous photo if it exists
             if ($data->photo && file_exists(public_path('upload/admin_images/' . $data->photo))) {
                 unlink(public_path('upload/admin_images/' . $data->photo));
             }
             $filename = date('YmdHi') . $file->getClientOriginalName();
             $file->move(public_path('upload/admin_images'), $filename);
             $data->photo = $filename;
         }

         $data->save();

         $notification = array(
             'message' => 'تم تحديث المعلومات الشخصيه بنجاح',
             'alert-type' => 'success',
         );

         return redirect()->back()->with($notification);

     }


     public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "كلمه المرور القديمه غير صحيحه");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),

        ]);

        return back()->with("status", "تم تغيير كلمه المرور بنجاح");

    }



    //////////////////// Add Subscribers /////////////////////////////////////////////////

    public function AllSubscriber()
    {
        $subscribers = User::where('role','subscriber')->latest()->get();
        return view('backend.subscribers.all_subscribers',compact('subscribers'));
    }

    public function AddSubscriber()
    {
        return view('backend.subscribers.add_subscribers');
    }

    public function storeSubscriber(Request $request)
    {

        DB::beginTransaction();

        try {

        // Validate request
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
        ], [
            // Custom messages
            'email.unique' => 'الايميل موجود من قبل',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->password = Hash::make($request->password);
        $data->subscribe_time = $request->subscribe_time;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/subscriber_images'), $filename);

            // Remove previous photo if it exists
            if ($data->photo && file_exists(public_path('upload/subscriber_images/' . $data->photo))) {
                unlink(public_path('upload/subscriber_images/' . $data->photo));
            }

            $data->photo = $filename;
        }

        $data->save();

        DB::commit();

        $notification = array(
            'message' => 'تم اضافة المشترك بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.subscriber')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء الاضافه',
                'alert-type' => 'error'
            ]);
        }

    }


    public function EditSubscriber($id)
    {
        $subscriber = User::findOrFail($id);
        return view('backend.subscribers.edit_subscribers',compact('subscriber'));
    }

    public function UpdateSubscriber(Request $request)
    {

        DB::beginTransaction();

        try {

        // Validate request
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $request->id,
        ], [
            // Custom messages
            'email.unique' => 'الايميل موجود من قبل',
        ]);


        $subscriber = User::findOrFail($request->id);

        // Update subscriber details
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->phone = $request->phone;
        $subscriber->status = $request->status;
        $subscriber->subscribe_time = $request->subscribe_time;


        // Check if a new password has been provided
        if (!empty($request->password))
        {
            $subscriber->password =  Hash::make($request->password);
        }




        // Handle photo update
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/subscriber_images'), $filename);

            // Remove previous photo if it exists
            if ($subscriber->photo && file_exists(public_path('upload/subscriber_images/' . $subscriber->photo))) {
                unlink(public_path('upload/subscriber_images/' . $subscriber->photo));
            }

            $subscriber->photo = $filename;
        }

        $subscriber->save();

        DB::commit();

        $notification = [
            'message' => 'تم تحديث بيانات المشترك بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.all.subscriber')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'message' => 'حدث خطا اثناء التحديث',
                'alert-type' => 'error'
            ]);
        }

    }


    public function DeleteSubscriber($id)
    {

        DB::beginTransaction();

        try {

        $subscriber = User::findOrFail($id);
        $img = $subscriber->photo;

        // Check if the photo exists and then delete it
        if ($img && file_exists(public_path('upload/subscriber_images/' . $img))) {
            unlink(public_path('upload/subscriber_images/' . $img));
        }

        $subscriber->delete();

        DB::commit();

        $notification = [
            'message' => 'تم حذف المشترك بنجاح',
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


    public function SubscriberInactive($id)
    {
        DB::beginTransaction();

        try {

         User::findOrFail($id)->update([
         'status' => 'inactive',
        ]);

        DB::commit();

        $notification = array(
            'message' => 'المشترك غير مفعل',
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

    }// End Method


    public function SubscriberActive($id)
    {
        DB::beginTransaction();

        try {

        User::findOrFail($id)->update([
        'status' => 'active',
        ]);


        DB::commit();

        $notification = array(
            'message' => 'المشترك مفعل',
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

    }// End Method



////////////////////////////////////////////////////////////////////////////////////


     ///////////// Add Admin Method //////////////


     public function AllAdmin(){
        $alladminuser = User::where('role','admin')->latest()->get();
        return view('backend.admin.all_admin',compact('alladminuser'));
    }// End Mehtod

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));
    }// End Mehtod


    public function AdminUserStore(Request $request){


        // Validate request
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
        ], [
            // Custom messages
            'email.unique' => 'الايميل موجود من قبل',
            'roles.required' => 'اختر الدور',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            // Fetch role name using its ID
            $roleName = Role::find($request->roles)->name;

            // Assign role by its name
            $user->assignRole($roleName);
        }

         $notification = array(
            'message' => 'تم اضافه مشرف جديد بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod


    public function EditAdminRole($id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.edit_admin',compact('user','roles'));
    }// End Mehtod


    public function AdminUserUpdate(Request $request,$id){

        // Validate request
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required',
        ], [
            // Custom messages
            'email.unique' => 'الايميل موجود من قبل',
            'roles.required' => 'اختر الدور',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        // $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        // Detach all roles and then assign the new one
        if ($request->roles) {
            // Fetch role name using its ID
            $roleName = Role::find($request->roles)->name;

            // Detach all roles and then assign the new one
            $user->syncRoles($roleName);
        }

         $notification = array(
            'message' => 'تم تحديث المشرف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod


    public function DeleteAdminRole($id){

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'تم حذف المشرف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod


    public function AdminInactive($id)
    {

         User::findOrFail($id)->update([
         'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'المشرف غير مفعل',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method




    public function AdminActive($id)
    {
        User::findOrFail($id)->update([
        'status' => 'active',
        ]);

        $notification = array(
            'message' => 'المشرف مفعل',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method


    //////////////////////////////////////////////////////////

    //settings

    public function AllSettings()
    {
        $settings = Setting::latest()->get();
        return view('backend.setting.all_setting',compact('settings'));
    }


    public function EditSettings($id)
    {
        $setting = Setting::findOrFail($id);
        return view('backend.setting.edit_setting',compact('setting'));
    }



    public function SettingsUpdate(Request $request)
    {

        $setting = Setting::findOrFail($request->id);

        // Update setting details
        $setting->name = $request->name;
        $setting->location = $request->location;
        $setting->email = $request->email;
        $setting->phone = $request->phone;



        // Handle logo update
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $request->validate([
                'logo' => 'required',
            ], [
                // Custom messages
                'logo.required' => 'الشعار مطلوب',
            ]);

            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/settings/logo'), $filename);

            // Remove previous logo if it exists
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            $setting->logo = 'upload/settings/logo/' . $filename;
        }


        // Handle favicon update
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');

            $request->validate([
                'favicon' => 'required',
            ], [
                // Custom messages
                'favicon.required' => 'الفيف ايقون مطلوب',
            ]);

            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/settings/favicon'), $filename);

            // Remove previous favicon if it exists
            if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                unlink(public_path($setting->favicon));
            }

            $setting->favicon = 'upload/settings/favicon/' . $filename;

        }





        $setting->save();

        $notification = [
            'message' => 'تم تحديث الاعدادات بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.settings')->with($notification);
    }


    ////////////////////////////////////////////////////////

    // Notifications method

    public function markAsRead(Request $request)
    {
        $notification = auth()->user()->notifications->find($request->id);

        if($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }


    //switcher ///////////
    public function markswitcherAsRead(Request $request)
    {
        $notification = auth()->user()->notifications->find($request->id);

        if($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markswitcherAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }


    ////////////////////////////////////////////////////////////////////////

    // export buildings to pdf

    public function viewPdf()
    {
        $data = Building::all();

        $pdf = PDF::loadView('backend.exports.pdf.building_pdf', ['data' => $data]);

        return $pdf->stream('العقارات.pdf');
    }


    public function subscribersPdf()
    {
        $data = User::where('role','subscriber')->get();

        $pdf = PDF::loadView('backend.exports.pdf.subscribers_pdf', ['data' => $data]);

        return $pdf->stream('المشتركين.pdf');
    }



        ///// export buildings to excel

        public function viewExcel()
        {
            return Excel::download(new BuildingExport(), 'العقارات.xlsx' );
        }

}
