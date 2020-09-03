<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use App\Revision;
use App\assignmentOrder;
use Illuminate\Http\Request;
use Redirect;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $orders = assignmentOrder::where('status', "In Progress")->where('completed', 1)->orderBy('id', 'desc')->paginate(50);

        return view('admins.orders.index', compact('orders'));
    }

    public function completed_orders()
    {
        $orders = assignmentOrder::where('status', 'completed')->where('completed', 1)->orderBy('id', 'desc')->paginate(50);

        return view('admins.orders.completed_orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:orders,name',
        ]);

        $order = new Order;
        $order->name = $request->name;
        $order->save();

        return redirect()->route('admin.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)

    {
        $file_delivered = File::where('file_delivered', '!=', NULL)->Where('file_delivered', '!=', "")->where('assignment_order_id', $order)->count();
       
        $order = assignmentOrder::Find($order);
        return view('admins.orders.show', compact('order','file_delivered'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admins.orders.edit ', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        if ($subject->name == $request->name) {
            return redirect()->route('admin.order.index');
        }

        $this->validate($request, [
            'name' => 'required|string|unique:orders,name',
        ]);

        $order->name = $request->name;
        $order->save();

        return redirect()->route('admin.order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.order.index');
    }

        public function revisions() {

            $revisions = Revision::where('solved', 0)->orderBy('created_at', 'ASC')->distinct()->get();

        return view('admins.orders.revisions')->with('revisions', $revisions);
    }

        public function deliver_revisions($id) {
         

        $revisions = Revision::find($id);
        $filecount = File::where('assignment_order_id', $revisions->assignment_order_id)->where('revision_file', '!=' , NULL)->count();
       
       // dd($revisions->order);
        return view('admins.orders.deliver_revision')->with('revisions', $revisions)->with('filecount', $filecount);
    }

        #deliver revision by admin
        public function submit_revision(Request $request) {
      

           $revision = Revision::Find($request->revisionID);
           // return $request->revisionID."--". $request->orderID;

         

           $revision->solved = 1;

           $submit = $revision->save();

           if($submit) {

            return response()->json( 'Assignment delivered', 200);
           }else {
            return response()->json('Assignment not submited!', 500);
           }
    }

        public function completed_revisions(Request $request) {

           $revisions = Revision::where('solved', 1)->get();

           return view('admins.orders.completed_revisions')->with('revisions',$revisions);

    }
}
