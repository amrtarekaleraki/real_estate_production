<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function AllReport()
    {
        $buildings = Building::latest()->get();
        return view('backend.report.all_report',compact('buildings'));
    }
}
