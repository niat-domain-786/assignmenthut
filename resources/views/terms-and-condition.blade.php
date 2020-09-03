@extends('layouts.master')
@section('content')
<div class="main-content">
    <!-- Section: home -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('assets/images/bg/bg3.jpg')}}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">Terms and Conditions</h2>
                        <ol class="breadcrumb text-left text-black mt-10">
                            <li><a href="./">Home</a></li>
                            <li class="active text-gray-silver">Terms and Conditions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Terms and Conditions</h2>
                    <p>Welcome to assignmenthut.com. Assignment Hut provides various services when you visit us at assignmenthut.com such as placing order for a new assignment, using online chat services with support staff, and other services, collectively called “Assignment Hut Services”.
                        By using Assignment Hut Services, you agree to these conditions. Please read them carefully before using Assignment Hut Services.
                    </p>
                    <div class="clearfix"></div>
                    <h2>Intellectual Property</h2>
                    <p>Assignment Hut is the sole owner of all the intellectual property contained in the website assignmenthut.com including the software, system design, all text contained anywhere within the website, images, graphics, applications and files. As a customer and visitor of this website, you are not allowed to copy, modify, distribute, reproduce or publish any of the content or software available on this website without our prior permission. All the graphics, company logo, design and icons are the intellectual property rights of Assignment Hut and may not be used by anyone to provide similar services.
                        The assignment papers provided by Assignment Hut Services are the copyright of Assignment Hut. These papers are provided to you for your personal non-commercial use only.
                    </p>
                    <div class="clearfix"></div>
                    <h2>Disclaimer</h2>
                    <p>The assignment papers provided by Assignment Hut Services are for reference purpose only and students are advised not to submit the work as it is. These papers are intended to be used for guidance, research and reference purposes only. You provide your consent that assignment papers provided to you by Assignment Hut Services are for your reference purpose only and you will not submit these papers as your own original work. 
                    </p>
                    <div class="clearfix"></div>
                    <h2>Privacy</h2>
                    <p>Please refer to our <a class="text-primary" href="{{ url('/privacy-policy') }}">Privacy Policy.</a>
                    </p>
                    <div class="clearfix"></div>
                    <h2>Revisions</h2>
                    <p>Please refer to our <a class="text-primary" href="{{ url('/revision-policy') }}">Revision Policy.</a>
                    </p>
                    <div class="clearfix"></div>
                    <h2>Refunds</h2>
                    <p>Please refer to our <a class="text-primary" href="{{ url('/refund-policy') }}">Refund Policy.</a>
                    </p>
                    <div class="clearfix"></div>
                    <h2>Subscription</h2>
                    <p>By agreeing to our Terms and Conditions, you provide your consent to receive essential Assignment Hut Services updates and other promotional offers.
                    </p>
                    <div class="clearfix"></div>
                    <h2>Termination</h2>
                    <p>Assignment Hut reserves the sole right to terminate part of whole of the service agreement any time without prior notice.
                    </p>
                    <div class="clearfix"></div>
                    <h2>Warranties and Limitation of Liability</h2>
                    <p>Assignment Hut Services and all its content, material, products (including software) and other services made available to you through Assignment Hut Services are provided by Assignment Hut on “as is” and “as available” basis. You provide your consent that you use Assignment Hut Services at your own risk. 

By using Assignment Hut Services, you agree that in case of any mismatch between your expectations and work delivered by us, you will provide us sufficient and reasonable time to meet your expectations. Assignment Hut is not responsible for failure in any course arising as a result of using Assignment Hut Services.

Assignment Hut Services does not accept any responsibility for any damage or loss occurred due to delays in accessing the website either due to technical reasons or scheduled maintenance updates.

                    </p>
                    <div class="clearfix"></div>
                    <h2>Changes to Terms and Conditions</h2>
                    <p>Assignment Hut reserves the right to make changes to its terms and conditions at any time. It is requested that you visit this page often to keep yourself updated with our terms and conditions.

                    </p>
                    
                </div>
            </div>
        </div>
    </section>
</div>
@endsection