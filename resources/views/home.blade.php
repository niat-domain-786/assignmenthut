@extends('layouts.master')
@section('content')
<div class="main-content">
    <!-- Section: home -->
    <section class="">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
          @include('order.user_sidebar')
                </div>
                <div class="col-md-9 ">   
                <div class="col-md-12">
                       
                               <h3>Welcome</h3>
                               <hr>
                          
             
                            <p>Assignment Hut is among the most preferred online assignment help company and has evolved over the years offering affordable services to students across the globe.</p>
                        
                     
                        </div>            
                    <div class="profile-content ">
                 
                     @if(session('message'))
                        <span role="alert" class="alert alert-success">{{ session('message') }}</span>
                        @endif 

                        @if(session('error'))
                        <span role="alert" class="alert alert-danger">{{ session('error') }}</span>
                        @endif

                                   {{-- new change row 1 --}}

                       <div class="col-md-12 d-flex flex-column  justify-content-around mb-4">

                        <a href="{{url('order/create')}}"><div class="col-md-5 shadow-md " style=" padding:10px; margin:12px;  background-color: #f5f5f5;">
                          <div class="col-md-2">
                            {{-- image --}}
                         <h2 style="color:orange;"><i class="glyphicon glyphicon-plus"></i> </h2>
                          </div>
                          <div class="col-md-10">
                            {{-- desc --}}
                            <h4>Order New Assignment</h4>
                            <p>Buy New Assignments from Our Service.</p>
                          </div>
                        </div></a>

                     <a href="{{url('order')}}">   <div class="col-md-5 shadow-md " style="padding:10px; margin:12px;  background-color: #f5f5f5;">
                          <div class="col-md-2">
                         <h2 style="color:orange;"><i class="glyphicon glyphicon-list"></i> </h2>
                          </div>
                          <div class="col-md-10">
                            {{-- desc --}}
                            <h4>Your Assignments</h4>
                            <p>Track, Request a Revision and Download Files.</p>
                          </div>
                        </div>                        
                         
                       </div></a>
                       {{-- end new change row 1 --}}



                                      {{-- new change row 2 --}}

                     <div class="col-md-12 d-flex">
                      <a href="{{url('revisions')}}"><div class="col-md-5 shadow-md " style=" padding:10px; margin:12px;  background-color: #f5f5f5;">
                          <div class="col-md-2">
                        <h2 style="color:orange;"><i class="glyphicon glyphicon-book"></i> </h2>
                          </div>
                          <div class="col-md-10">
                            {{-- desc --}}
                            <h4>Your Revisions</h4>
                            <p>Track Revision and get Updated Files.</p>
                          </div>
                        </div></a>

                          <a href="{{url('profile')}}">
                            <div class="col-md-5 shadow-md " style="padding:10px; margin:12px;  background-color: #f5f5f5;">
                          <div class="col-md-2">
                          <h2 style="color:orange;"><i class="glyphicon glyphicon-user"></i> </h2>
                          </div>
                          <div class="col-md-10">
                            {{-- desc --}}
                            <h4>Profile</h4>
                            <p>Name, Email, Password and Profile Image</p>
                          </div>
                        </div> 
                       </div></a>
                       {{-- end new change row 2 --}}







                  {{--      <div class="card">
                           <div class="card-header">
                               <h2>Welcome</h2>
                               <hr>
                           </div>
                           <div class="card-body">
                            <p>Assignment Hut is among the most preferred online assignment help company and has evolved over the years offering affordable services to students across the globe.</p>
                            <hr> --}}
                      {{--       <div class="col-md-6">
                                <h2>My Assignment</h2>
                             <p>Keep track of your all assignments and orders</p>
                            <a href="{{ url('/order')}}"> <button class ="btn btn-sm btn-success m-y2" style="border-radius:25px;" >Get Started</button></a>

                             </div> --}}

                    {{--         <div class="col-md-6">
                                <h2>Revisions</h2>
                             <p>All revisions associated with your assignments</p>
                            <a href="{{url('/revisions')}}">  <button class ="btn btn-sm btn-success my-2" style="border-radius:25px;">Get Started</button></a>

                             </div> --}}



{{-- 

                           </div>
                        
                       </div>
                 
               
                  
                    </div> --}}


                </div>
            </div>
        </div>
    </section>
</div>
@endsection