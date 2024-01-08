<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberReportsController extends Controller
{
    public function AllReport()
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

        /////////////////////////////////////////////////////

        ////num of buildings added by auth subscriber ///
        $total_num_buildings = Building::where('added_by',Auth::user()->id)->count();


        ////////////charts start //////////////
        $rent_buildings = Building::where('added_by',Auth::user()->id)->where('building_selling_status','rent')->count();
        $sell_buildings = Building::where('added_by',Auth::user()->id)->where('building_selling_status','sell')->count();
        $all_buildings = Building::where('added_by',Auth::user()->id)->latest()->count();
        $active_buildings = Building::where('added_by',Auth::user()->id)->where('buildings.status','active')->count();


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
            $month_percentage = (($monthContractPrice / 100) * 100);
        }
        /////////////////////////
        $AllBuildingSystem = Building::latest()->get()->count();
        if($AllBuildingSystem === 0)
        {
           $building_percentage = 0;
        }
        else
        {
            $building_percentage = (($all_buildings / $AllBuildingSystem) * 100);
        }




        return view('subscriber.report.all_report',compact('buildings','sellingContractPrice','rentingContractPrice','monthContractPrice','total_num_buildings','rent_buildings','sell_buildings','all_buildings','active_buildings','rent_percentage','sell_percentage','month_percentage','building_percentage'));
    }
}
