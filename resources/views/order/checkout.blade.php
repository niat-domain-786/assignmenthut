@extends('layouts.master')
@section('content')
<div class="main-content">
	<section>
		<div class="container">
			<div class="row">

				<div class="col-md-8" id="app" style="border:1px solid gray;">
            <h3 class="mt-15 mb-10 text-center text-uppercase"><strong>Edit Your <span class="text-theme-color-2">Order</strong></span></h3>
            <p  class=" mb-20 text-center" >Please Edit Your Order If Needed</p>
					 <form action="{{ route('checkout_page') }}"  id="home_appointment_form" name="home_appointment_form" class="booking-form  form-home bg-white p-30" enctype="multipart/form-data">
            @csrf
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
                   
                    {{-- /custom fields --}}
            {{-- files code --}}
                   

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
                   {{--  <input name="form_botcheck" class="form-control" type="hidden" value="">
                    <button id="btn-of-submit" type="submit" class="btn btn-colored btn-theme-color-2 text-white " data-loading-text="Please wait..." v-on:click.prevent="submit" v-html="submitButtonText" style="border-radius:25px;">Proceed To Checkout</button> --}}
                </div>

			<div class="container" v-if="totalPrice != '' ">
			<button   class="btn  btn-success mb-5" style="border-radius:24px;" > Update Order </button>
			<a href="#" onClick="window.location.reload();">Reset</a>
			</div>
			<h5 v-if="totalPrice == '' ">Please Select all the fields to update order</h5>

   </form>
            


                 <hr>

                 <div class="col-md-12">
					
					<h3><strong>Paper Details</strong></h3>
					<p>Please add the paper details</p>
					<div class="form-froup">
						<form id="real-form-to-submit" action ="{{ route('place_order_registered') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<label for="paperFormat">Select Paper Format <sup class="text-danger">*</sup></label>
							<select class="form-control" name="paper_format">
								<option value="Not Selected">Select One</option>
								<option value="AMA">AMA</option>
								<option value="APA (6th edition)">APA (6th edition)</option>
								<option value="CHICAGO (17th edition, author-date)">CHICAGO (17th edition, author-date)</option>
								<option value="HARVARD">HARVARD</option>
								<option value="IEEE">IEEE</option>
								<option value="ISO 690">ISO 690</option>
								<option value="MHRA (3rd edition)">MHRA (3rd edition)</option>
								<option value="MLA (8th edition)">MLA (8th edition)</option>
								<option value="OSCOLA">OSCOLA</option>
								<option value="TURABIAN (9th edition)">TURABIAN (9th edition)</option>
								<option value="VANCOUVER">VANCOUVER</option>
							</select>
							<label for="noOfSources">Number Of Sources <sup class="text-danger">*</sup></label>
							<input type="number" class="form-control" name="no_of_sources" min="0" value="0">
							<label for="FurtherInstructions">Further Instructions</label>
							<textarea  class="form-control" name="comments" rows="5" placeholder="optional"></textarea>

							        <div class="col-sm-12" style="margin-top:50px;margin-bottom:50px;">
                        <div class="form-group">
                            <div class="col-sm-4">
                                
                              <label>Attach Files</label>
                            </div>
                            {{-- <input name="form_attachment" class="file" type="file" multiple="" data-show-upload="false" data-show-caption="true"> --}}
                            <input
                            type="file"
                            class="file"
                            id="file"
                            ref="file"
                            name="file[]"
                            v-on:change="handleFileUpload()"
                            multiple = "multiple" >
                            <small class="text-primary">Select Upto 5 Files. Maximum upload file size: 10 MB</small>
                            <h4 class="text-danger" id="files-list" ></h4>
                            
                        </div>
                    </div>

							@if( !(Auth::check()) )
							<hr>
							<h3><strong>Your Email and Password(Required)</strong> <sup class="text-danger">*</sup></h3>
							<p>Use These Credentials To Sign In And Track Orders.</p>
							<div class="col-sm-12" style="margin-top:5px;">
								<div class="form-group mb-20">
									<div class="styled-select">
										
										<label> Your Email <sup class="text-danger">*</sup></label>
										
										<input type="email" class="form-control" name="email"  required>
										
									</div>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top:5px;">
								<div class="form-group mb-20">
									<div class="styled-select">
										
										<label>Select a Password <sup class="text-danger">*</sup></label>
										<input type="password" name="password" id="password" v-model="selectedPass" class="form-control" required>
										
									</div>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top:5px;">
								<div class="form-group mb-20">
									<div class="styled-select">
										
										<label>Confirm Password <sup class="text-danger">*</sup></label>
										<input type="password" name="password_confirmation" id="password_confirmation" v-model="c_pass" class="form-control" required>
										
									</div>
								</div>
							</div>
							@endif
							
							<div class="clearfix"></div>
							<p style="margin-top:30px;margin-bottom:30px;">
								<h4 class="text-primary">Please Accept Terms & Conditions</h4>
							<input type="checkbox" id="checkbox-terms" value="" required>&nbsp; I accept Terms and Conditions </p>
					
							@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<input type="hidden" name="service_id" value="<?php echo $services[$_GET['service'] -1]->id ?>">
<input type="hidden" name="academic_level" value="<?php echo $academics[$_GET['academiclevel'] -1]->id ?>">
<input type="hidden" name="urgency" value="<?php echo $_GET['urgency'] ?>">
<input type="hidden" name="no_of_pages" value="<?php echo $_GET['no_of_pages'] ?>">
<input type="hidden" name="currency_id" value="<?php echo $_GET['currency'] ?>">
<input type="hidden" name="paper" value="<?php echo $_GET['paper'] ?> ">
		<p>
								
								<a href="{{ url('/') }}">
									<button class="btn  btn-warning mb-5" style="border-radius:24px;" > &nbsp; <i class="fa fa-arrow-left"></i> &nbsp; Cancel </button>
								</a>
								
								
								
								<button type="submit" for="real-form-to-submit" id="btn-of-submit"  class="btn  btn-success mb-5" style="border-radius:24px;" > Confirm &nbsp; <i class="fa fa-arrow-right"></i> &nbsp;</button>
							</p>
						</form>
					</div>

		
					
					
				</div>



            </form>
				</div>

				<div class="col-md-4">
					{{-- 	<img src="{{asset('assets/images/homepage/home-pic-1.png')}}" alt=""> --}}
					<h2><i class="fa fa-shopping-cart"></i>&nbsp;<strong>Order Details</strong></h2>
					<p>Your current order details</p>
					{{-- @foreach($order as $checkout) --}}
					<ul>
						{{-- 	<li  style="padding:10px; list-style:none;">
						<strong>id:</strong> {{ $checkout->id }}</li> --}}
						<li  style="padding:10px; list-style:none;">
							<strong>Service:</strong> &nbsp;<?php echo $services[$_GET['service'] -1]->name ?></li>
						<li  style="padding:10px; list-style:none;"><strong>Paper Type:</strong>&nbsp; <?php echo $papers[$_GET['paper'] -1]->name ?> </li>
						
						<li  style="padding:10px; list-style:none;"><strong>Academic level:</strong>&nbsp;<?php echo $academics[$_GET['academiclevel'] -1]->name ?> </li>
						<li  style="padding:10px; list-style:none;"><strong>No of Pages:</strong> <?php echo $_GET['no_of_pages'] ?> </li>
						
						<li  style="padding:10px; list-style:none;"><strong>Duration:</strong>&nbsp; <?php echo $all_prices[$_GET['urgency'] -1]->urgency_value." ".$all_prices[$_GET['urgency'] -1]->urgency_hour_or_day ?> </li>
						<li  style="padding:10px; list-style:none;"><strong>Price:</strong>  &nbsp; <?php echo $_GET['price'] ?> </li>
						<li style="padding:10px; list-style:none;">
					{{-- 	<strong>Files: </strong></li>
						@if($checkout->order_files)
						@foreach($checkout->order_files as $file)
						<span class="btn btn-link" style=" border-radius:24px;"><i class="fa fa-download"></i>&nbsp; {{ substr($file, 39)}}</span>
						@endforeach
						@else
						{{'No files Selected'}}
						@endif --}}
					</ul>
					{{-- @endforeach --}}
				{{-- 	<h3>Why Us?</h3>
					<p>Our team of writers consists of renowned PhD experts having in-depth knowledge in their respective area of studies. Assignment Hut tutors have been providing guidance to students in various areas such as assignment help, essay writing, thesis help, dissertation help, homework help, capstone projects, online tutoring and many more.
					We have been recognised as best assignment help worldwide, available and accessible to the students from different parts of the world. The innovative solutions provided by our assignment experts have earned everlasting faith among the students looking for assignment help in their respective areas of study. The success rate of students achieving excellent grades in their academics is indicative of consistent and relentless efforts of the team at Assignment hut.</p> --}}
					
				</div>

				
			</div>
		</div>
	</section>
</div>
@endsection
@push('checkout-scripts')
<script src="{{asset('assets/vue/vue.js')}}"></script>
<script src="{{asset('assets/vue/axios.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}

<script src="{{asset('assets/vue/vue-dev.js')}}"></script>
{{--   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  --}}

<script>

var app = new Vue({
el: '#app',
data: {
message: 'Hello Vue!',
email:'',
selectedCurrency:<?php echo $_GET['currency'] ?>,
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
no_of_pages:<?php echo $_GET['no_of_pages'] ?>,
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
c_pass:'',
servicelist:"",
orderFiles:"",
},
computed: {
  price() {
   return;
   this.submitButtonText = "Proceed To Checkout";
   return "";
  },
 },
 methods: {
  find_days(event) {
   this.daysList = this.allprices.filter(s => (s.service_id == this.selectedService) && (s.academic_level_id == this.academic_level));
   var dayIDs = new Set();
   for (var i = 0; i < this.daysList.length; i++) {
    dayIDs.add(this.daysList[i].id);
   }
   axios.get("{{ url('/get_urgency/') }}<?php echo "/?ids=" ?>" + [...dayIDs])
    .then(function(response) {
     this.all_days = response.data;
     this.totalPrice = '';

    }.bind(this)).catch();
  },

  validate(e) {
	let terms = document.getElementById('checkbox-terms');
		if(terms.checked == true){
		return true;
		{{-- // window.location.href= "{{ $checkout->paypal_link }}"; --}}
	}else{
		alert('Please Accept Terms & Condations.');
	}

	if (this.selectedPass == this.c_pass) {
		alert('passwords equal');
	}else{
		alert('wrong passwords');
	}
  	e.preventDefault();


  },

  find_papers(event) {
   this.servicelist = this.allprices.filter(s => s.service_id == this.selectedService);

   // Create Sets
   var items = new Set();
   var academicLevel = new Set();
   var urgencyIDs = new Set();
   for (var i = 0; i < this.servicelist.length; i++) {
    items.add(this.servicelist[i].paper_id);
    academicLevel.add(this.servicelist[i].academic_level_id);
    urgencyIDs.add(this.servicelist[i].id);

   }
   axios.get("{{ url('/get_paper_list/') }}<?php echo "/?ids=" ?>" + [...items])
    .then(function(response) {
     this.paperlist = response.data;
     this.papers = response.data;
    }.bind(this)).catch();

   axios.get("{{ url('/get_academics/') }}<?php echo "/?ids=" ?>" + [...academicLevel])
    .then(function(response) {
     this.get_academics = response.data;
     this.academics = response.data;
    }.bind(this)).catch();

   this.find_days();

  },
  submit() {
   if (this.submitting) {
    return;
   }
   var self = this;
   @auth
   if (1) {
    @else
    if (1) {
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
       url: '{{url('user/place-order-registered ')}}',
       headers: {
        'content-type': 'multipart/form-data'
       },
       data: formData,

      })
      .then(function(response) {
       // console.log(response.data); return;

       self.submitting = false;
       //console.log(response.data);
       if (response.data) {
        // console.log(response.data); return;
        window.location.href = response.data;
        return;
       }
       self.error = response.errors;
       self.submitButtonText = 'Proceed To Checkout';
      })
      .catch(function(error) {
       // console.log('error');
       // console.log(error.response.data.errors);
       self.submitting = false;
       self.error = error.response.data.errors;
       self.submitButtonText = 'Falied! please try again'
      });
    } else {
     this.error = {
      error: ['Fill all the fields to proceed!']
     }
     this.submitButtonText = 'Proceed To Checkout'
     return;
    }

   },
   handleFileUpload() {
     if (this.$refs.file.files.length > 5) {
      // alert('Too many files, Please select upto 5 files')
      document.getElementById('files-list').innerHTML = "Error! Files Limit Exceed. Upto 5 Files Allowed.";
      document.getElementById('btn-of-submit').setAttribute("disabled", "disabled");
      return;
     } else {

      this.file = this.$refs.file.files;
      document.getElementById('files-list').innerHTML = " ";
      document.getElementById('btn-of-submit').removeAttribute("disabled", "disabled");
      console.log(this.file);
     }
     // // Prevent submission if limit is exceeded.

     if (this.$refs.file.files.length > 5) {
      return false;
     }
    },

    calculate_price(event) {

     if ((this.days_field_selected == false)) {
      return;
     }
     var currencyName = this.currencies.filter(currency => currency.id == this.selectedCurrency);
     var p = this.allprices.filter(rs => ((rs.service_id == this.selectedService) && (rs.academic_level_id == this.academic_level) && (rs.id == this.urgency)));
     var j = JSON.stringify(p);
     var k = p[0].price;
     this.totalPrice = ((k * this.no_of_pages) * currencyName[0].value).toFixed(2) + '  ' + currencyName[0].name;
    },
  }
 })

</script>
@endpush
