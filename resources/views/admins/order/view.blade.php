@extends('layouts.admin-layout')

@section('title')

    Admin Panel | Pocket

@endsection



@section('body')

<div id="page-wrapper">

    <input type="button" value="Back" class="btn btn-success min-btn" onclick="history.back()">

    <div class="xs tabls ">

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h2>Order Detail</h2>
            <div class="panel-ctrls"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
        </div>

        <div class="panel-body no-padding" style="display: block;">

        <table class="table table-bordered"> 
            <tr>
                <td style="width: 20%;">Wholeseller Name</td>
                <td>{{$query->username}}</td>
            </tr>
             <tr>
                 <td style="width: 20%;">Brand Name</td>
                 <td>{{$query->name}}</td>
             </tr> 
             <tr>
                 <td style="width: 20%;">Season</td>
                 <td>{{$query->season_name}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Style Number</td>
                 <td>{{$query->style_number}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Style For</td>
                 <td>{{$query->style_for}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Delivery Time</td>
                 <td>{{date('F d, Y', strtotime($query->delivery_time))}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Design Buget</td>
                 <td>{{$query->design_buget}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Style Description</td>
                 <td>{{$query->style_desc}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Additional Detail</td>
                 <td>{{$query->additional_detail}}</td>
             </tr>
             <tr>
                 <td style="width: 20%;">Process status</td>
                 <td>{{$query->status_processed_percentage.'%'}}</td>
             </tr>
            
             <tr>
                 <td style="width: 20%;">Status</td>
                 <?php $status = ['Pending','In-process','Completed']?>
                 <td>{{$status[$query->status]}}</td>
             </tr> 
             <tr>
                 <td style="width: 20%;">Order Posted Date</td>
                 <td>{{date('F d, Y', strtotime($query->created_at))}}</td>
             </tr> 

     

 </tbody> 

 </table>

    </div>

</div>

    </div>

</div>

@endsection

