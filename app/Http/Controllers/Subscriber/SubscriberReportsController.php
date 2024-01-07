<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class SubscriberReportsController extends Controller
{
    public function AllReport()
    {
        $buildings = Building::latest()->get();
        return view('subscriber.report.all_report',compact('buildings'));
    }
}
