<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use App\assignmentOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = assignmentOrder::where('completed', 1)->where('status',"completed")->orderBy('id', 'desc')->paginate(10);
        
        $users = User::count();
        $email_request_count = User::where('change_email_request', '!=', '0')->count();
        
        //$totalCategories = Category::count();
        $services = Service::count();
        $new_orders = assignmentOrder::where('completed', 1)->where('status',"In Progress")->count();
        $completed_orders = assignmentOrder::where('completed',1)->where('status', 'completed')->count();

        return view('admins.dashboards.index', compact('orders', 'completed_orders', 'users', 'new_orders', 'services', 'email_request_count'));
    }
    
    public function trans(){
        $payments = assignmentOrder::all();
        return view('admins.currencies.trans', compact('payments'));


    }
}
