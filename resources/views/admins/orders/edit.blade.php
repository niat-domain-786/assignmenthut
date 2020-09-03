@extends('admins.layouts.master')

@section('content')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>    
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'image code link textcolor',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | link | forecolor backcolor',
            // textcolor_cols: "5",
            
            // without images_upload_url set, Upload tab won't show up
            images_upload_url: '/admin/upload',
            
            // override default upload handler to simulate successful upload
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
              
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/admin/upload');
              
                xhr.onload = function() {
                    var json;
                
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                
                    json = JSON.parse(xhr.responseText);
                
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                
                    success(json.location);
                };
              
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
              
                xhr.send(formData);
            },
        });
    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit review</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage review</a></li>
                    <li class="active">Edit review</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-12">

            {!! Form::open(array('url'=>'admin/review/'.$review->id,'class'=>'form-horizontal','id'=>'newUser','method'=> 'PUT','files' => true)) !!}
            
                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic Info</h3>
                    </div>
                    <div class="panel-body">
                        
                    {{-- <form class="form-horizontal" role="form"> --}}

                        @if($errors->any())

                            <ul class="alert">

                                @foreach($errors->all() as $error)

                                <li style="color:red;"><b>{{ $error }}</b></li>

                                @endforeach

                            </ul>

                        @endif

                        @if (Session::has('message'))
                           <div class="alert alert-success">
                               {{ Session::get('message') }}
                           </div>
                        @endif



                        <div class="row">
                            <div class="col-md-12">                           

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control"  name="name" required value="{{ old('name') ?? $review->name }}">                                    
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Website Link</label>
                                        <input type="text" class="form-control"  name="website_url" value="{{ old('website_url') ?? $review->website_url }}">                                    
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Starting Price</label>
                                        <input type="text" class="form-control"  name="starting_price" value="{{ old('starting_price') ?? $review->starting_price }}">                                   
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Company</label>
                                        <input type="text" class="form-control"  name="company" value="{{ old('company') ?? $review->company }}">                                   
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Founded</label>
                                        <input type="text" class="form-control" name="founded" value="{{ old('founded') ?? $review->founded }}">                                   
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Services</label>
                                        <input type="text" class="form-control"  name="services" value="{{ old('services') ?? $review->services }}">                                   
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Our Rating</label>
                                        <input type="number" class="form-control"  name="our_rating" value="{{ old('our_rating') ?? $review->our_rating }}">                                   
                                    </div>
                                </div>
                                                                                 

                            </div>

                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Images</h3>
                    </div>
                    <div class="panel-body">              
                        <div class="row">
                            <div class="col-md-12">                           

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">Website Images</label>
                                        <input type="file" name="images[]" class="form-control" multiple>
                                    </div>
                                </div>                                                                             
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Review in a nutshell</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="nutshell_content" id="" cols="30" rows="10">{{ old('nutshell_content')?? $review->nutshell_content }}</textarea>
                                    </div>
                                </div>                                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Review in depth</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Main Content</label>
                                        <textarea name="depth_content" id="" cols="30" rows="10">{{ old('depth_content')?? $review->depth_content }}</textarea>
                                    </div>
                                </div>                                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Service Plan Content</label>
                                        <textarea name="depth_service_plan_content" id="" cols="30" rows="10">{{ old('depth_service_plan_content')?? $review->depth_service_plan_content }}</textarea>
                                    </div>
                                </div>                                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 1</label>
                                        <input type="text" class="form-control"  name="depth_service_plan_type1" value="{{ old('depth_service_plan_type1') ?? $review->depth_service_plan_type1 }}">                                   
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 1 Price</label>
                                        <input type="number" class="form-control" name="depth_service_plan_price1" value="{{ old('depth_service_plan_price1') ?? $review->depth_service_plan_price1 }}">                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 2</label>
                                        <input type="text" class="form-control"  name="depth_service_plan_type2" value="{{ old('depth_service_plan_type2') ?? $review->depth_service_plan_type2 }}">                                   
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 2 Price</label>
                                        <input type="number" class="form-control" name="depth_service_plan_price2" value="{{ old('depth_service_plan_price2') ?? $review->depth_service_plan_price2 }}">                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 3</label>
                                        <input type="text" class="form-control"  name="depth_service_plan_type3" value="{{ old('depth_service_plan_type3') ?? $review->depth_service_plan_type3 }}">                                   
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 3 Price</label>
                                        <input type="number" class="form-control" name="depth_service_plan_price3" value="{{ old('depth_service_plan_price3') ?? $review->depth_service_plan_price3 }}">                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 4</label>
                                        <input type="text" class="form-control"  name="depth_service_plan_type4" value="{{ old('depth_service_plan_type4') ?? $review->depth_service_plan_type4 }}">                                   
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 4 Price</label>
                                        <input type="number" class="form-control" name="depth_service_plan_price4" value="{{ old('depth_service_plan_price4') ?? $review->depth_service_plan_price4 }}">                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 5</label>
                                        <input type="text" class="form-control"  name="depth_service_plan_type5" value="{{ old('depth_service_plan_type5') ?? $review->depth_service_plan_type5 }}">                                   
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 5 Price</label>
                                        <input type="number" class="form-control" name="depth_service_plan_price5" value="{{ old('depth_service_plan_price5') ?? $review->depth_service_plan_price5 }}">                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 6</label>
                                        <input type="text" class="form-control"  name="depth_service_plan_type6" value="{{ old('depth_service_plan_type6') ?? $review->depth_service_plan_type6 }}">                                   
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Plan - 6 Price</label>
                                        <input type="number" class="form-control" name="depth_service_plan_price6" value="{{ old('depth_service_plan_price6') ?? $review->depth_service_plan_price6 }}">                                   
                                    </div>
                                </div>                                                
                            </div>
                        </div>                        
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Terms and Guarantees</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Terms and Conditions</label>
                                        <input type="text" class="form-control"  name="terms_tnc" value="{{ old('terms_tnc') ?? $review->terms_tnc }}">                                    
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Privacy Policy</label>
                                        <input type="text" class="form-control"  name="terms_privacy" value="{{ old('terms_privacy') ?? $review->terms_privacy }}">                                    
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Refund Policy</label>
                                        <input type="text" class="form-control"  name="terms_refund" value="{{ old('terms_refund') ?? $review->terms_refund }}">                                    
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Retention Policy</label>
                                        <input type="text" class="form-control"  name="terms_retention" value="{{ old('terms_retention') ?? $review->terms_retention }}">                                    
                                    </div>
                                </div>                                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Customer Support</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="customer_support_content" id="" cols="30" rows="10">{{ old('customer_support_content')?? $review->customer_support_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Rating</label>
                                        <input type="number" class="form-control"  name="customer_support_rating" value="{{ old('customer_support_rating') ?? $review->customer_support_rating }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Average Response Time</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_avg_response_time" value="{{ old('customer_support_quality_avg_response_time') ?? $review->customer_support_quality_avg_response_time }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Friendly Response?</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_friendly" value="{{ old('customer_support_quality_friendly') ?? $review->customer_support_quality_friendly }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Informative Response?</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_informative" value="{{ old('customer_support_quality_informative') ?? $review->customer_support_quality_informative }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer all questions?</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_all" value="{{ old('customer_support_quality_all') ?? $review->customer_support_quality_all }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answers already on website?</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_already" value="{{ old('customer_support_quality_already') ?? $review->customer_support_quality_already }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">On Page Contact Form</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_contact_on_page" value="{{ old('customer_support_quality_contact_on_page') ?? $review->customer_support_quality_contact_on_page }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Live Chat</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_contact_live_chat" value="{{ old('customer_support_quality_contact_live_chat') ?? $review->customer_support_quality_contact_live_chat }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Email Address</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_contact_email" value="{{ old('customer_support_quality_contact_email') ?? $review->customer_support_quality_contact_email }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Phone Number</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_contact_phone" value="{{ old('customer_support_quality_contact_phone') ?? $review->customer_support_quality_contact_phone }}">                                  
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Mailing Address</label>
                                        <input type="text" class="form-control"  name="customer_support_quality_contact_mail" value="{{ old('customer_support_quality_contact_mail') ?? $review->customer_support_quality_contact_mail }}">                                  
                                    </div>                                    
                                </div>                                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pre Order Questions and Responses</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="pre_order_questions_content" id="" cols="30" rows="10">{{ old('pre_order_questions_content')?? $review->pre_order_questions_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Response Image</label>
                                        <input type="file" name="pre_order_questions_response" class="form-control">
                                                                          
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Response Time</label>
                                        <input type="text" class="form-control"  name="pre_order_questions_response_time" value="{{ old('pre_order_questions_response_time') ?? $review->pre_order_questions_response_time }}">                                  
                                    </div>                                                                       
                                </div> 
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Question 1</label>
                                        <input type="text" class="form-control"  name="pre_order_questions1" value="{{ old('pre_order_questions1') ?? $review->pre_order_questions1 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 1</label>
                                        <input type="text" class="form-control"  name="pre_order_questions1_answer" value="{{ old('pre_order_questions1_answer') ?? $review->pre_order_questions1_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 2</label>
                                        <input type="text" class="form-control"  name="pre_order_questions2" value="{{ old('pre_order_questions2') ?? $review->pre_order_questions2 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 2</label>
                                        <input type="text" class="form-control"  name="pre_order_questions2_answer" value="{{ old('pre_order_questions2_answer') ?? $review->pre_order_questions2_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 3</label>
                                        <input type="text" class="form-control"  name="pre_order_questions3" value="{{ old('pre_order_questions3') ?? $review->pre_order_questions3 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 3</label>
                                        <input type="text" class="form-control"  name="pre_order_questions3_answer" value="{{ old('pre_order_questions3_answer') ?? $review->pre_order_questions3_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 4</label>
                                        <input type="text" class="form-control"  name="pre_order_questions4" value="{{ old('pre_order_questions4') ?? $review->pre_order_questions4 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 4</label>
                                        <input type="text" class="form-control"  name="pre_order_questions4_answer" value="{{ old('pre_order_questions4_answer') ?? $review->pre_order_questions4_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 5</label>
                                        <input type="text" class="form-control"  name="pre_order_questions5" value="{{ old('pre_order_questions5') ?? $review->pre_order_questions5 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 5</label>
                                        <input type="text" class="form-control"  name="pre_order_questions5_answer" value="{{ old('pre_order_questions5_answer') ?? $review->pre_order_questions5_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 6</label>
                                        <input type="text" class="form-control"  name="pre_order_questions6" value="{{ old('pre_order_questions6') ?? $review->pre_order_questions6 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 6</label>
                                        <input type="text" class="form-control"  name="pre_order_questions6_answer" value="{{ old('pre_order_questions6_answer') ?? $review->pre_order_questions6_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 7</label>
                                        <input type="text" class="form-control"  name="pre_order_questions7" value="{{ old('pre_order_questions7') ?? $review->pre_order_questions7 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 7</label>
                                        <input type="text" class="form-control"  name="pre_order_questions7_answer" value="{{ old('pre_order_questions7_answer') ?? $review->pre_order_questions7_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 8</label>
                                        <input type="text" class="form-control"  name="pre_order_questions8" value="{{ old('pre_order_questions8') ?? $review->pre_order_questions8 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 8</label>
                                        <input type="text" class="form-control"  name="pre_order_questions8_answer" value="{{ old('pre_order_questions8_answer') ?? $review->pre_order_questions8_answer }}">                                  
                                    </div>                                                                       
                                </div>                                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Post Order Questions and Responses</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="post_order_questions_content" id="" cols="30" rows="10">{{ old('post_order_questions_content')?? $review->post_order_questions_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Response Image</label>
                                        <input type="file" name="post_order_questions_response" class="form-control">
                                                                          
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Response Time</label>
                                        <input type="text" class="form-control"  name="post_order_questions_response_time" value="{{ old('post_order_questions_response_time') ?? $review->post_order_questions_response_time }}">                                  
                                    </div>                                                                       
                                </div> 
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Question 1</label>
                                        <input type="text" class="form-control"  name="post_order_questions1" value="{{ old('post_order_questions1') ?? $review->post_order_questions1 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 1</label>
                                        <input type="text" class="form-control"  name="post_order_questions1_answer" value="{{ old('post_order_questions1_answer') ?? $review->post_order_questions1_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 2</label>
                                        <input type="text" class="form-control"  name="post_order_questions2" value="{{ old('post_order_questions2') ?? $review->post_order_questions2 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 2</label>
                                        <input type="text" class="form-control"  name="post_order_questions2_answer" value="{{ old('post_order_questions2_answer') ?? $review->post_order_questions2_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 3</label>
                                        <input type="text" class="form-control"  name="post_order_questions3" value="{{ old('post_order_questions3') ?? $review->post_order_questions3 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 3</label>
                                        <input type="text" class="form-control"  name="post_order_questions3_answer" value="{{ old('post_order_questions3_answer') ?? $review->post_order_questions3_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 4</label>
                                        <input type="text" class="form-control"  name="post_order_questions4" value="{{ old('post_order_questions4') ?? $review->post_order_questions4 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 4</label>
                                        <input type="text" class="form-control"  name="post_order_questions4_answer" value="{{ old('post_order_questions4_answer') ?? $review->post_order_questions4_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 5</label>
                                        <input type="text" class="form-control"  name="post_order_questions5" value="{{ old('post_order_questions5') ?? $review->post_order_questions5 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 5</label>
                                        <input type="text" class="form-control"  name="post_order_questions5_answer" value="{{ old('post_order_questions5_answer') ?? $review->post_order_questions5_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 6</label>
                                        <input type="text" class="form-control"  name="post_order_questions6" value="{{ old('post_order_questions6') ?? $review->post_order_questions6 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 6</label>
                                        <input type="text" class="form-control"  name="post_order_questions6_answer" value="{{ old('post_order_questions6_answer') ?? $review->post_order_questions6_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 7</label>
                                        <input type="text" class="form-control"  name="post_order_questions7" value="{{ old('post_order_questions7') ?? $review->post_order_questions7 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 7</label>
                                        <input type="text" class="form-control"  name="post_order_questions7_answer" value="{{ old('post_order_questions7_answer') ?? $review->post_order_questions7_answer }}">                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 8</label>
                                        <input type="text" class="form-control"  name="post_order_questions8" value="{{ old('post_order_questions8') ?? $review->post_order_questions8 }}">                           
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 8</label>
                                        <input type="text" class="form-control"  name="post_order_questions8_answer" value="{{ old('post_order_questions8_answer') ?? $review->post_order_questions8_answer }}">                                  
                                    </div>                                                                       
                                </div>                                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Our Recommendations</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="recommendation_content" id="" cols="30" rows="10">{{ old('recommendation_content')?? $review->recommendation_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">LOOK MORE POPULAR</label>                                  
                                        <select name="recommendation_type1" class="form-control">
                                            <option value="yes" @if($review->recommendation_type1 == 'yes') selected @endif >Yes</option>
                                            <option value="no"  @if($review->recommendation_type1 == 'no') selected @endif>No</option>
                                        </select>                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">ATTRACT MORE ATTENTION</label>                                  
                                        <select name="recommendation_type2" class="form-control">
                                            <option value="yes"  @if($review->recommendation_type2 == 'yes') selected @endif>Yes</option>
                                            <option value="no"  @if($review->recommendation_type2 == 'no') selected @endif>No</option>
                                        </select>                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">PROVIDES REAL FOLLOWERS</label>                                  
                                        <select name="recommendation_type3" class="form-control">
                                            <option value="yes"  @if($review->recommendation_type3 == 'yes') selected @endif>Yes</option>
                                            <option value="no"  @if($review->recommendation_type3 == 'no') selected @endif>No</option>
                                        </select>                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">GO VIRAL</label>                                  
                                        <select name="recommendation_type4" class="form-control">
                                            <option value="yes"  @if($review->recommendation_type4 == 'yes') selected @endif>Yes</option>
                                            <option value="no"  @if($review->recommendation_type4 == 'no') selected @endif>No</option>
                                        </select>                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">INCREASE REPUTATION</label>                                  
                                        <select name="recommendation_type5" class="form-control">
                                            <option value="yes"  @if($review->recommendation_type5 == 'yes') selected @endif>Yes</option>
                                            <option value="no"  @if($review->recommendation_type5 == 'no') selected @endif>No</option>
                                        </select>                                  
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">GET MORE ORGANIC FOLLOWERS</label>                                  
                                        <select name="recommendation_type6" class="form-control">
                                            <option value="yes"  @if($review->recommendation_type6 == 'yes') selected @endif>Yes</option>
                                            <option value="no"  @if($review->recommendation_type6 == 'no') selected @endif>No</option>
                                        </select>                                  
                                    </div>
                                                                        
                                </div>                                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daily Turnaround Time</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="daily_turnaround_time_content" id="" cols="30" rows="10">{{ old('daily_turnaround_time_content')?? $review->daily_turnaround_time_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 1 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[0] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 2 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[1] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 7 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[2] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 14 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[3] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 30 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[4] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 60 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[5] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Graph Day 90 Value</label>                                  
                                        <input type="number" class="form-control"  name="graph[]" value="{{ $review->graph[6] }}">
                                    </div>                              
                                                                        
                                </div>                                                 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Quality</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="quality_content" id="" cols="30" rows="10">{{ old('quality_content')?? $review->quality_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Question 1</label>                                  
                                        <input type="text" class="form-control"  name="quality_questions1" value="{{ old('quality_questions1') ?? $review->quality_questions1 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 1</label>                                  
                                        {{-- <input type="text" class="form-control"  name="quality_questions1_answer" value="{{ old('quality_questions1_answer') ?? $review->quality_questions1_answer }}"> --}}
                                        <select name="quality_questions1_answer" class="form-control">
                                            <option value="yes" @if($review->quality_questions1_answer == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($review->quality_questions1_answer == 'no') selected @endif>No</option>
                                        </select>                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Question 2</label>                                  
                                        <input type="text" class="form-control"  name="quality_questions2" value="{{ old('quality_questions2') ?? $review->quality_questions2 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 2</label>                                  
                                        {{-- <input type="text" class="form-control"  name="quality_questions2_answer" value="{{ old('quality_questions2_answer') ?? $review->quality_questions2_answer }}">                                     --}}
                                        <select name="quality_questions2_answer" class="form-control">
                                            <option value="yes" @if($review->quality_questions2_answer == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($review->quality_questions2_answer == 'no') selected @endif>No</option>
                                        </select> 
                                                                     
                                    </div>  
                                    <div class="col-md-6">
                                        <label class="control-label">Question 3</label>                                  
                                        <input type="text" class="form-control"  name="quality_questions3" value="{{ old('quality_questions3') ?? $review->quality_questions3 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 3</label>                                  
                                        {{-- <input type="text" class="form-control"  name="quality_questions3_answer" value="{{ old('quality_questions3_answer') ?? $review->quality_questions3_answer }}"> --}}
                                        <select name="quality_questions3_answer" class="form-control">
                                            <option value="yes" @if($review->quality_questions3_answer == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($review->quality_questions3_answer == 'no') selected @endif>No</option>
                                        </select>                                     
                                                                     
                                    </div>  
                                    <div class="col-md-6">
                                        <label class="control-label">Question 4</label>                                  
                                        <input type="text" class="form-control"  name="quality_questions4" value="{{ old('quality_questions4') ?? $review->quality_questions4 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 4</label>                                  
                                        {{-- <input type="text" class="form-control"  name="quality_questions4_answer" value="{{ old('quality_questions4_answer') ?? $review->quality_questions4_answer }}">                                     --}}
                                        <select name="quality_questions4_answer" class="form-control">
                                            <option value="yes" @if($review->quality_questions4_answer == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($review->quality_questions4_answer == 'no') selected @endif>No</option>
                                        </select> 
                                                                     
                                    </div>  
                                    <div class="col-md-6">
                                        <label class="control-label">Question 5</label>                                  
                                        <input type="text" class="form-control"  name="quality_questions5" value="{{ old('quality_questions5') ?? $review->quality_questions5 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 5</label>                                  
                                        {{-- <input type="text" class="form-control"  name="quality_questions5_answer" value="{{ old('quality_questions5_answer') ?? $review->quality_questions5_answer }}">                                     --}}
                                        <select name="quality_questions5_answer" class="form-control">
                                            <option value="yes" @if($review->quality_questions5_answer == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($review->quality_questions5_answer == 'no') selected @endif>No</option>
                                        </select> 
                                                                     
                                    </div>  
                                    <div class="col-md-6">
                                        <label class="control-label">Question 6</label>                                  
                                        <input type="text" class="form-control"  name="quality_questions6" value="{{ old('quality_questions6') ?? $review->quality_questions6 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Answer 6</label>                                  
                                        {{-- <input type="text" class="form-control"  name="quality_questions6_answer" value="{{ old('quality_questions6_answer') ?? $review->quality_questions6_answer }}">                                     --}}
                                        <select name="quality_questions6_answer" class="form-control">
                                            <option value="yes" @if($review->quality_questions6_answer == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($review->quality_questions6_answer == 'no') selected @endif>No</option>
                                        </select> 
                                                                     
                                    </div>                                  
                                                                        
                                </div>                                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Retention Rate</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="retention_rate_content" id="" cols="30" rows="10">{{ old('retention_rate_content')?? $review->retention_rate_content }}</textarea>                                    
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 1</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate1" value="{{ old('retention_rate1') ?? $review->retention_rate1 }}">                                    
                                                                     
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 2</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate2" value="{{ old('retention_rate2') ?? $review->retention_rate2 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 3</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate3" value="{{ old('retention_rate3') ?? $review->retention_rate3 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 4</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate4" value="{{ old('retention_rate4') ?? $review->retention_rate4 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 5</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate5" value="{{ old('retention_rate5') ?? $review->retention_rate5 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 6</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate6" value="{{ old('retention_rate6') ?? $review->retention_rate6 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 7</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate7" value="{{ old('retention_rate7') ?? $review->retention_rate7 }}">                                    
                                                                     
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Strip 8</label>                                  
                                        <input type="text" class="form-control"  name="retention_rate8" value="{{ old('retention_rate8') ?? $review->retention_rate8 }}">                                    
                                                                     
                                    </div>                                
                                                                        
                                </div>                                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Conclusion</h3>
                    </div>
                    <div class="panel-body">                
                        <div class="row">
                            <div class="col-md-12">                         
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Content</label>
                                        <textarea name="conclusion_content" id="" cols="30" rows="10">{{ old('conclusion_content')?? $review->conclusion_content }}</textarea>                                    
                                    </div>                                    
                                </div>                                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center m-b-0">
                    <div class="col-md-12">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Update Review</button>
                        {{-- <button type="reset" class="btn btn-default waves-effect m-l-5">Cancel</button> --}}
                    </div>
                </div>

            </form>


        </div>
    </div>

@stop

@section('styles')

@stop

@section('scripts')

    <script src="{{ url('public/assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{ url('public/assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/raphael/raphael-min.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{ url('public/assets/pages/jquery.dashboard.js')}}"></script>

@stop



