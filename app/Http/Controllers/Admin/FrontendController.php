<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessagesModel;
use App\Models\Orders;
use App\Models\VisitorsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $time=Carbon::now()->subDay();
        $data['countvisitors']=VisitorsModel::where('created_at','>=',$time)->count();
        $data['countmessages']=MessagesModel::where('serviced','pending')->count();
        $data['countorders']=Orders::where('order_status','PROCESSING')->count();

        return view('admin.dashboard.index',compact('data'));
    }
}
