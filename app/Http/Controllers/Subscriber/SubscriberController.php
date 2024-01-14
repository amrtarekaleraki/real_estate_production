<?php

namespace App\Http\Controllers\Subscriber;

use App\Exports\SubscriberBuildingExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Category;
use App\Models\History;
use App\Models\Owner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberController extends Controller
{
    public function SubscriberDashboard()
    {
        $buildings = Building::where('added_by',Auth::user()->id)->latest()->get();

        $userId = Auth::id();

        // Update the logic to retrieve data related to the authenticated user
        $sellingContractPrice = History::join('buildings', 'histories.building_id', '=', 'buildings.id')
            ->join('owners', 'buildings.owner_id', '=', 'owners.id')
            ->join('users', 'owners.added_by', '=', 'users.id')
            ->where('buildings.building_selling_status', 'sell')
            ->whereNotNull('histories.contract_price')
            ->where('users.id', $userId) // Filter based on the authenticated user's ID
            ->sum('histories.contract_price');

        // Cast the sum to an integer to remove the decimal part
        $sellingContractPrice = (int) $sellingContractPrice;

        $rentingContractPrice = History::join('buildings', 'histories.building_id', '=', 'buildings.id')
        ->join('owners', 'buildings.owner_id', '=', 'owners.id')
        ->join('users', 'owners.added_by', '=', 'users.id')
        ->where('buildings.building_selling_status', 'rent')
        ->whereNotNull('histories.contract_price')
        ->where('users.id', $userId) // Filter based on the authenticated user's ID
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
            ->where('users.id', $userId)
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
                    ->where('added_by', $userId)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count();

                // Query to count rows for 'sell' status within the current month
                $sellData = Building::where('building_selling_status', 'sell')
                    ->where('added_by', $userId)
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
            $sakani_chart = Building::where('category_id',1)->where('added_by',Auth::user()->id)->count();
            $tgari_chart = Building::where('category_id',2)->where('added_by',Auth::user()->id)->count();
            $aradi_chart = Building::where('category_id',3)->where('added_by',Auth::user()->id)->count();
            $estsmari_chart = Building::where('category_id',4)->where('added_by',Auth::user()->id)->count();


            ///////////////////////////////////////////////////
            $rent_buildings = Building::where('added_by',Auth::user()->id)->where('building_selling_status','rent')->count();
            $sell_buildings = Building::where('added_by',Auth::user()->id)->where('building_selling_status','sell')->count();

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

            $all_buildings = Building::where('added_by',Auth::user()->id)->latest()->count();
            /////////////////////////
            $AllBuildingSystem = Building::latest()->get()->count();
            if($AllBuildingSystem === 0)
            {
            $building_percentage = 0;
            }
            else
            {
                $building_percentage = floor((($all_buildings / $AllBuildingSystem) * 100));
            }



        return view('subscriber.index',compact('buildings','all_buildings','building_percentage','sellingContractPrice','rentingContractPrice','monthContractPrice','monthlyData','sakani_chart','tgari_chart','aradi_chart','estsmari_chart','rent_percentage','sell_percentage','month_percentage'));
    }










    public function SubscriberSwitcher()
    {
        $categories = Category::latest()->get();
        foreach($categories as $item)
        {
           $category_id = $item->id;
        }

        $buildings =  Building::where('category_id', $category_id)->where('added_by',Auth::user()->id)->latest()->get();

        return view('subscriber.switcher',compact('categories','buildings'));

    }


    public function fetchBuildingsByCategory($categoryId)
    {
       $buildings = Building::where('category_id', $categoryId)->where('added_by',Auth::user()->id)->latest()->get();
       return response()->json(['buildings' => $buildings]);
    }


    public function SubscriberLogin(){
        return view('subscriber.subscriber_login');
    } // End Mehtod


    public function SubscriberDestroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/subscriber/login');
    } // End Mehtod


    public function SubscriberProfile()
    {
        $id = Auth::user()->id;
        $SubscriberData = User::find($id);
        return view('subscriber.subscriber_profile_view', compact('SubscriberData'));
    }


    public function SubscriberProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        // $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            // Remove previous photo if it exists
            if ($data->photo && file_exists(public_path('upload/subscriber_images/' . $data->photo))) {
                unlink(public_path('upload/subscriber_images/' . $data->photo));
            }
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/subscriber_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'تم تحديث المعلومات الشخصيه بنجاح',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }


    public function SubscriberChangePassword()
    {
        return view('subscriber.subscriber_change_password');
    }

    public function SubscriberUpdatePassword(Request $request)
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




    ////////////////////////////////////////

    // export buildings to pdf
    public function subscriberBuildingsPdf()
    {
        $user_id   = Auth::user()->id;

        $data = Building::where('added_by',$user_id)->get();

        $pdf = PDF::loadView('subscriber.exports.pdf.building_pdf', ['data' => $data]);

        return $pdf->stream('العقارات.pdf');
    }


    // export owners to pdf
    public function subscriberOwnerPdf()
    {
        $user_id   = Auth::user()->id;
        $data = Owner::where('added_by',$user_id)->get();

        $pdf = PDF::loadView('subscriber.exports.pdf.owners_pdf', ['data' => $data]);

        return $pdf->stream('المستأجرين والملاك.pdf');
    }


    ///// export buildings to excel

    public function viewExcel()
    {
        return Excel::download(new SubscriberBuildingExport(), 'العقارات.xlsx' );
    }


}
