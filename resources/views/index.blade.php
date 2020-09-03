@extends('layouts.master')
@section('content')
<div class="main-content" id="app">
    <!-- Section: home -->
    <section id="home" class="divider parallax layer-overlay overlay-dark-4" data-bg-img="{{asset('assets/images/bg/bg3.jpg')}}">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container pt-40 pb-40">
                    <div class="row">
                        <div class="col-md-5 pt-50 " style="margin-bottom:0px; padding-bottom:0px !important;">
                              <img src="{{asset('assets/images/homepage/home-pic-1.png')}}" alt="" width="100%" >
        
                        </div>
                        <div class="col-md-7 mt-sm-30">
                            {{-- form --}}
                            <!-- Appointment Form Starts -->
                            <form id="home_appointment_form" action="{{ route('checkout_page') }}" name="home_appointment_form" class="booking-form  form-home bg-white p-30" enctype="multipart/form-data">
                                {{-- @csrf --}}
 <h3 class="mt-0 mb-20 text-center text-uppercase"><strong>Place An <span class="text-theme-color-2">Order</strong></span></h3> 
  <p  class=" mb-20 text-center" >Place your order and get amazing assignments</p>                            
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <p> Select currency</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group mb-10">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    
                                                    
                                                    <template v-for="(currency,index) in currencies">
                                                    <label :class="{'btn btn-secondary':true,'active':selectedCurrency == currency.id}" @click="
                                                        selectedCurrency = currency.id,
                                                        currencyName = currency.name,
                                                        calculate_price(),
                                                        calculate = 1 ">
                                                        <input type="radio" autocomplete="off" :checked="selectedCurrency == index" :value="currency.id" name="currency"> @{{ currency.name }} </label>
                                                        </template>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                      
                                        </div>
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                                {{-- <input name="form_name" class="form-control" type="text" required="" placeholder="Enter Subject 1" aria-required="true"> --}}
                                                <div class="col-sm-3"> <p style="margin-top:10px;">Type of Service</p></div>
                                                <div class="col-sm-9">
                                                    <select v-on:change="find_papers"  class="form-control" v-model="selectedService" name="service">
                                                        <option value="">Select Service</option>
                                                        <option  v-for="(service,index) in services" v-bind:value="service.id" :key="service.name" > @{{service.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                                {{-- <input name="form_name" class="form-control" type="text" required="" placeholder="Enter Subject 1" aria-required="true"> --}}
                                                <div class="col-sm-3"> <p style="margin-top:10px;">Type of Paper</p></div>
                                                <div class="col-sm-9">
                                                    <select  class="form-control" v-model="selectedPaper" name="paper">
                                                        <option value="" id="paper-type">Select Paper Type</option>
                       

                                                        <option  v-for="paper in papers" v-bind:key="paper.name" v-bind:value="paper.id" > @{{ paper.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        {{-- custom fields --}}
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-20">
                                                <div class="styled-select">
                                                    <div class="col-sm-3">
                                                          <p style="margin-top:10px;">Academic level</p></div>
                                                    <div class="col-sm-9">
                                                        <select  class="form-control"  v-model="academic_level"  v-on:change="find_days()" name="academiclevel">
                                                            
                                                            <option value="">Select Level</option>
                                                            <option  v-for="(academic,index) in academics" :key="academic.name" v-bind:value="academic.id">@{{academic.name}}</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-20">
                                                <div class="styled-select">
                                                    <div class="col-sm-12"><p style="margin-top:10px;">Number of Pages <em class="text-primary">(approx 250 words/page)</em></p></div>
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9">
                                                        <input min="1" v-model="no_of_pages" type="number"  class="form-control" name="no_of_pages"  v-on:change="calculate_price()" onKeyUp="app.calculate_price()" >
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-20">
                                                <div class="styled-select">
                                                    <div class="col-sm-3">
                                                        
                                                        <p style="margin-top:10px;">Urgency</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        
                                                        <select name="urgency"  v-model="urgency"
                                                          class="form-control" 
                                                          v-on:change="
                                                          days_field_selected = 1,
                                                          calculate_price()" >
                                                            <option value="" selected>Select Time</option>

                                                            <option v-for="(day) in all_days" v-bind:value="day.id">@{{ day.urgency_value}} @{{ day.urgency_hour_or_day }}</option>

                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       {{--  @if( !(Auth::check()) )
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-20">
                                                <div class="styled-select">
                                                    <div class="col-sm-3">
                                                        
                                                        <p style="margin-top:10px;">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" name="email" v-model="email" required>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-20">
                                                <div class="styled-select">
                                                    <div class="col-sm-3">
                                                        
                                                        <p style="margin-top:10px;">Select a Password</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        
                                                        <input type="password" name="password" v-model="selectedPass" class="form-control" required>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif --}}
                                        {{-- /custom fields --}}
                           {{--              <div class="col-sm-12" style="margin-top:10px;">
                                            <div class="form-group mb-10">
                                                <div class="col-sm-4">
                                                    
                                                    <p>Attach A File</p>
                                                </div>
                                             
                                                <input
                                                type="file"
                                                class="file"
                                                id="file"
                                                ref="file"
                                                name="orderFiles[]"
                                                v-on:change="handleFileUpload()"
                                               multiple = "multiple" >
                                                <small class="text-primary">Select Upto 5 Files. Maximum upload file size: 10 MB</small>
                                               <h4 class="text-danger" id="files-list" ></h4>
                                               
                                            </div>
                                        </div> --}}
                                    </div>
                                    
                                    <div class="form-group mb-0 mt-20">
                                        <h3 style="margin-top:10px;" id="total-price">Total Price: @{{ totalPrice }}</h3>
                                        <input type="hidden" name="price" :value="totalPrice">
                                        
                                           <div class="row" v-if="error">
                                    <div class="col-sm-12" v-for="err in error" :key="err">
                                        <div class="form-group mb-0">
                                            <div style="color:red"> @{{ err[0] }}</div>
                                        </div>
                                    </div>
                                </div>
                                        <input name="form_botcheck" class="form-control" type="hidden" value="">
                                        {{-- <button id="btn-of-submit" type="submit" class="btn btn-colored btn-theme-color-2 text-white " data-loading-text="Please wait..." v-on:click.prevent="submit" v-html="submitButtonText" style="border-radius:25px;">Proceed To Checkout</button> --}}
                                        <button  type="submit" class="btn btn-colored btn-theme-color-2 text-white "  style="border-radius:25px;">Proceed To Checkout</button>
                                    </div>
                                </form>
                                
                                
                                {{-- /form --}}
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <section class="">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="line-height-1 font-weight-600 mt-0 font-28 line-bottom">World Best Assignment Help</h2>
                            <h4 class="text-theme-colored">Assignment Hut is among the most preferred online assignment help company and has evolved over the years offering affordable services to students across the globe.
                            </h4>
                            <p>
                                Formed in 2015, Assignment Hut has helped thousands of students achieve success in their academic career. Our experienced assignment experts have helped students from different academic backgrounds to get excellent grades in their assignments.
                            Our team of writers consists of renowned PhD experts having in-depth knowledge in their respective area of studies. Assignment Hut tutors have been providing guidance to students in various areas such as assignment help, essay writing, thesis help, dissertation help, homework help, capstone projects, online tutoring and many more.</p>
                            <a href="{{url('/about')}}" class="btn btn-theme-colored btn-flat btn-lg mt-15 mr-15" style="margin-bottom:10px;">Read more</a>
                            <a href="{{url('/contact')}}" class="btn btn-default btn-flat btn-lg mt-15" style="margin-bottom:10px;">Contact Us</a>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="video-popup">
                               {{--  <a href="https://www.youtube.com/watch?v=pW1uVUg5wXM" data-lightbox-gallery="youtube-video" title="Video"> --}}
                                    <img alt="" src="{{asset('assets/images/homepage/bg7.jpg')}}" class="img-responsive img-fullwidth">
                                {{-- </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End: About Section -->
        <!-- Start: Services Section -->
        <section class="bg-lighter">
            <div class="container">
                <div class="section-title mb-10">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">Services</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel-4col" data-dots="true">
                            <div class="item ">
                                <div class="service-block bg-white">
                                    <div class="thumb">
                                        <img alt="featured project" src="{{asset('assets/images/project/4.jpg')}}" class="img-fullwidth">
                                        <!-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4> -->
                                    </div>
                                    <div class="content text-left flip p-15 pt-0">
                                        <h4 class="line-bottom mb-10">Accounting Technologies</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.</p>
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="#">view details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="service-block mb-md-30 bg-white">
                                    <div class="thumb">
                                        <img alt="featured project" src="{{asset('assets/images/project/5.jpg')}}" class="img-responsive img-fullwidth">
                                        <!-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4> -->
                                    </div>
                                    <div class="content text-left flip p-15 pt-0">
                                        <h4 class="line-bottom mb-10">Computer Technologies</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.</p>
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="#">view details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="service-block mb-md-30 bg-white">
                                    <div class="thumb">
                                        <img alt="featured project" src="{{asset('assets/images/project/6.jpg')}}" class="img-responsive img-fullwidth">
                                        <!-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4> -->
                                    </div>
                                    <div class="content text-left flip p-15 pt-0">
                                        <h4 class="line-bottom mb-10">Development Studies</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.</p>
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="#">view details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="service-block mb-md-30 bg-white">
                                    <div class="thumb">
                                        <img alt="featured project" src="{{asset('assets/images/project/7.jpg')}}" class="img-responsive img-fullwidth">
                                        <!-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4> -->
                                    </div>
                                    <div class="content text-left flip p-15 pt-0">
                                        <h4 class="line-bottom mb-10">Electrical & Electronic</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.</p>
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="#">view details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="service-block mb-md-30 bg-white">
                                    <div class="thumb">
                                        <img alt="featured project" src="{{asset('assets/images/project/8.jpg')}}" class="img-responsive img-fullwidth">
                                        <!-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4> -->
                                    </div>
                                    <div class="content text-left flip p-15 pt-0">
                                        <h4 class="line-bottom mb-10">Chemical Engineering</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.</p>
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="#">view details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End: Services Section  -->
        <!-- Start: Client Say Section -->
        <section class="divider parallax layer-overlay overlay-theme-colored-9" data-background-ratio="0.5" data-bg-img="{{asset('assets/images/bg/bg3.jpg')}}">
            <div class="container pt-60 pb-60">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="line-bottom-center text-gray-lightgray text-center mt-0 mb-30">Our Happy Students say</h2>
                        <div class="owl-carousel-1col" data-dots="true">
                            <div class="item">
                                <div class="testimonial-wrapper text-center">
                                    <div class="thumb"><img class="img-circle" alt="" src="{{asset('assets/images/testimonials/3.jpg')}}"></div>
                                    <div class="content pt-10">
                                        <p class="font-15 text-white"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque est quasi, quas ipsam, expedita placeat facilis odio illo ex accusantium eaque itaque officiis et sit. Vero quo, impedit neque.</em></p>
                                        <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                                        <h4 class="author text-theme-color-2 mb-0">Catherine Grace</h4>
                                        <h6 class="title text-white mt-0 mb-15">Designer</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapper text-center">
                                    <div class="thumb"><img class="img-circle" alt="" src="{{asset('assets/images/testimonials/3.jpg')}}"></div>
                                    <div class="content pt-10">
                                        <p class="font-15 text-white"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque est quasi, quas ipsam, expedita placeat facilis odio illo ex accusantium eaque itaque officiis et sit. Vero quo, impedit neque.</em></p>
                                        <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                                        <h4 class="author text-theme-color-2 mb-0">Catherine Grace</h4>
                                        <h6 class="title text-white mt-0 mb-15">Designer</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-wrapper text-center">
                                    <div class="thumb"><img class="img-circle" alt="" src="{{asset('assets/images/testimonials/3.jpg')}}"></div>
                                    <div class="content pt-10">
                                        <p class="font-15 text-white"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque est quasi, quas ipsam, expedita placeat facilis odio illo ex accusantium eaque itaque officiis et sit. Vero quo, impedit neque.</em></p>
                                        <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                                        <h4 class="author text-theme-color-2 mb-0">Catherine Grace</h4>
                                        <h6 class="title text-white mt-0 mb-15">Designer</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End: Client Say Section -->
        <!-- Section: Why Choose Us -->
        <section id="event" class="">
            <div class="container pb-50">
                     <div class="section-title mb-10">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Why <span class="text-theme-color-2 font-weight-400">Choose  Us?</span></h2>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row">
  <div class="col-sm-6 col-md-4">
    <h3 class="text-center mt-3">Best Writers</h3>
    <div class="text-center"  style="font-size:40px; color:#ff853f;">
       <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        {{-- <i class="fa fa-users"></i> --}}
      <div class="caption">
        <h5>All our writers are native English speakers with a PhD in their field of writing.</h5>
        
        
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <h3 class="text-center mt-3">Top Quality Guaranteed</h3>
    <div class="text-center"  style="font-size:40px; color:#ff853f;">
       <span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span>
        
      <div class="caption">
        <h5>Best quality work every time you place order and always on time.</h5>
        
        
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <h3 class="text-center mt-3">Confidential and Secure</h3>
    <div class="text-center" style="font-size:40px; color:#ff853f;">
       <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
      <div class="caption">
        <h5>100% confidentiality and pay with confidence using secure PayPal payment gateway.</h5>
        
        
      </div>
    </div>
  </div>
</div>
                </div>
            </div>
        </section>
        <hr>
        <!-- Start: Funfact Section  -->
        <!-- Start: Teacher Section  -->
        <section>
            <div class="container">
                <div class="section-title mb-10">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">Teachers</span></h2>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row multi-row-clearfix">
                        <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="{{asset('assets/images/team/sm-1.jpg')}}" alt=""></div>
                                <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix">
                                    <h4 class="name text-theme-color-2 mt-0">Andre Smith - <small>Teacher</small></h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing elit.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="{{asset('assets/images/team/sm-2.jpg')}}" alt=""></div>
                                <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix">
                                    <h4 class="name mt-0 text-theme-color-2">Sakib Smith - <small>Teacher</small></h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing elit.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="{{asset('assets/images/team/sm-3.jpg')}}" alt=""></div>
                                <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix">
                                    <h4 class="name mt-0 text-theme-color-2">David Zakaria - <small>Teacher</small></h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing elit.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 sm-text-center">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="{{asset('assets/images/team/sm-4.jpg')}}" alt=""></div>
                                <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix">
                                    <h4 class="name mt-0 text-theme-color-2">Ismail Jon - <small>Teacher</small></h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing elit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

     
    </div>
    @endsection

@section('scripts')


    <script src="{{asset('assets/vue/vue.js')}}"></script>
    <script src="{{asset('assets/vue/axios.min.js')}}"></script> 

    {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
     
      {{-- <script src="{{asset('assets/vue/vue-dev.js')}}"></script>  --}}

  {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  --}}
   


    <script>
       
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!',
                email:'',
                selectedCurrency:1,
                currencies:{!! $currencies !!},
                subjects:"",
                academics:'',
                 {{-- academics:{!! $academics !!},  --}}
                services:{!! $services !!},
                papers:'',
                 {{-- papers:{!! $papers !!},  --}}
                allprices:{!! $all_prices !!},
                urgencies:'',
                  {{-- urgencies:{!! $urgencies !!}, --}}
                selectedService:"",
                selectedCategory:"",
                selectedProduct:"",
                submitting:false,
                details:"",
                error:"",
                file:[],
                submitButtonText:"Proceed To Checkout",
                // my code
                totalPrice:"",
                urgency:"",
                academic_level:"",
                no_of_pages:1,
                selectedPaper:"",
                currencyName:"",

                paperlist:'',
                get_academics:"",
                all_days:"",
                // calculate price
                calculate:false,

                urgency_value:28,
                urgency_hour_or_day:'days',
                days_field_selected:false,

                //auth
                selectedPass:'',
                servicelist:"",
                orderFiles:"",
            },

            computed:{

                price()
                {
                    return;    
                    this.submitButtonText = "Proceed To Checkout";
                    return "";
                },

            },

            methods: {

                find_days(event) {
                    this.daysList = this.allprices.filter(s=> (s.service_id == this.selectedService) && (s.academic_level_id ==  this.academic_level));
                    var dayIDs = new Set();

                    for(var i = 0; i< this.daysList.length; i++)
                    {             
                        dayIDs.add(this.daysList[i].id);             
                    }

                axios.get("{{ url('/get_urgency/') }}<?php echo "/?ids=" ?>"+[...dayIDs])
                .then( function(response){
                        this.all_days = response.data;
                        this.totalPrice = "-";          
                                   
                    }.bind(this) ).catch();
                },

            find_papers(event) {
            this.servicelist = this.allprices.filter(s=> s.service_id == this.selectedService);
         
                // Create Sets
                var items = new Set();
                var academicLevel = new Set();
                var urgencyIDs = new Set();


                for(var i = 0; i< this.servicelist.length; i++){             
                    items.add(this.servicelist[i].paper_id);
                    academicLevel.add(this.servicelist[i].academic_level_id);
                    urgencyIDs.add(this.servicelist[i].id);
                    
                }


            axios.get("{{ url('/get_paper_list/') }}<?php echo "/?ids=" ?>"+[...items])
                    .then( function(response){              
                        this.paperlist = response.data;
                        this.papers = response.data;
                    }.bind(this) ).catch();

    

            axios.get("{{ url('/get_academics/') }}<?php echo "/?ids=" ?>"+[...academicLevel])
                    .then( function(response) {
                        this.get_academics = response.data;
                        this.academics = response.data;            

                    }.bind(this) ).catch();
                    
                    this.find_days();
                 
                },

                submit() {
                    if(this.submitting) 
                    {
                        return;
                    }

                    var self = this;
                    @auth
                        if(1){
                    @else
                        if(1){
                    @endauth


                        // console.log(this.academic_level);
                        // console.log( this.urgency);
                        // console.log( this.selectedService);
                        // console.log( this.selectedCurrency);
                        // console.log( this.no_of_pages);
                        // console.log(this.selectedPaper);
                        // console.log( this.selectedPass);
                        // return;
                        this.submitButtonText = 'Processing &nbsp; &nbsp; <i class="fa fa-spinner fa-spin"></i>';

                        let formData = new FormData();

                         for (let i = 0; i < this.file.length; i++) {
                            // data.append('input_name[]', files[i])
                            formData.append("file[]", this.file[i]);
                            console.log(this.file[i]);
                          }

                        // formData.append("file", this.file);

                        formData.append("email", this.email);
                        formData.append("academic_level", this.academic_level);
                        formData.append("urgency", this.urgency);
                        formData.append("service_id", this.selectedService);
                        formData.append("currency_id", this.selectedCurrency);
                        formData.append("no_of_pages", this.no_of_pages);
                        formData.append("paper", this.selectedPaper);
                        formData.append("pass", this.selectedPass);

                        axios({
                            method: 'POST',
                            url: '{{url('user/place-order-registered')}}',
                             headers: {'content-type': 'multipart/form-data' },
                            data: formData,
                          
                            })
                            .then(function (response) {
                            // console.log(response.data); return;
                                                     
                            self.submitting = false;
                            //console.log(response.data);
                            if(response.data)
                            {
                                // console.log(response.data); return;
                                window.location.href = response.data;
                                return;
                            }
                            self.error = response.errors;
                            self.submitButtonText = 'Proceed To Checkout';

                        })
                        .catch(function (error) {
                            // console.log('error');
                            // console.log(error.response.data.errors);
                            self.submitting = false;
                            self.error = error.response.data.errors;
                            self.submitButtonText = 'Falied! please try again'

                        });

                    } else{
                        this.error = {error:['Fill all the fields to proceed!']}
                        this.submitButtonText = 'Proceed To Checkout'

                        return;
                    }
                    
                },

            handleFileUpload() {  

                    if(this.$refs.file.files.length>5)
                    {
                            // alert('Too many files, Please select upto 5 files')
                        document.getElementById('files-list').innerHTML = "Error! Files Limit Exceed. Upto 5 Files Allowed.";

                        document.getElementById('btn-of-submit').setAttribute("disabled", "disabled");
                            return;
                    } 
                    
                    else
                    { 
                   
                        this.file = this.$refs.file.files; 
                        document.getElementById('files-list').innerHTML = " ";
                        document.getElementById('btn-of-submit').removeAttribute("disabled", "disabled");
                        console.log(this.file);
                    }

                    // // Prevent submission if limit is exceeded.
  
                        if(this.$refs.file.files.length>5)
                        {
                            return false;
                        }                        

                },

       

            calculate_price(event){
               

                if( (this.days_field_selected == false))
                {
                    return;
                } 

                var currencyName = this.currencies.filter(currency => currency.id == this.selectedCurrency);                  


                 var p = this.allprices.filter(rs=>( (rs.service_id == this.selectedService) &&  (rs.academic_level_id == this.academic_level) &&  (rs.id == this.urgency)));


                  var j = JSON.stringify(p);
                  var k = p[0].price;
                  this.totalPrice = ( (k * this.no_of_pages) * currencyName[0].value ).toFixed(2) +'  '+ currencyName[0].name; 
            },

            }
        })
        
    </script>
@endsection