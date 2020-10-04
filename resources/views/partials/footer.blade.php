<div class="clearfix"></div>
    <!-- Start: Footer Section -->
    <footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="{{asset('assets/images/bg/bg2.jpg')}}">
        <div class="container">
            <div class="row border-bottom">
                <div class="col-sm-6 col-md-3">
                    <div class="widget dark">
                        {{-- <img class="mt-5 mb-20" alt="" src="{{asset('assets/wide-logo.png')}}" width="80%"> --}}
                        {{-- <p>203, Street Colony, New Delhi, India.</p> --}}
                             <h4 class="widget-title mb-10">Contact</h4>

                        <ul class="mt-5">
                            <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-white mr-5"></i> <a class="text-gray" href="#">+61-2-8005-6085</a> </li>
                            <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-white mr-5"></i> <a class="text-gray" href="mailto:help@assignmenthut.com">help@assignmenthut.com</a> </li>
                            <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-white mr-5"></i> <a class="text-gray" href="https://www.assignmenthut.com">www.assignmenthut.com</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="widget dark">
                 

                             <h4 class="widget-title mb-10">Get To Know Us</h4>
                  <ul class="list angle-double-right list-border">
                        <li><a href="{{url('/about')}}">About Us</a></li>
                        <li><a href="{{url('/careers')}}">Careers</a></li>
                        <li><a href="{{url('/faq')}}">FAQ</a></li>
                      
                    </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
           
                    
                          <div class="widget dark">
                                   <h4 class="widget-title">Conditions of Use</h4>
                        <ul class="list angle-double-right list-border">
                            <li><a href="{{url('/terms-and-conditions')}}">Terms & Conditions</a></li>
                           
                            <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
                            <li><a href="{{url('/refund-policy')}}">Refund Policy</a></li>
                            <li><a href="{{url('/revision-policy')}}">Revision Policy</a></li>
                        </ul>
               
                    </div>
                    
                </div>

                      <div class="col-md-5 col-md-3">
                    <div class="widget dark">

                     
                        <h4 class="widget-title mb-10">Stay Connected</h4>
                        <ul class="styled-icons icon-bordered icon-sm">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        
                        <h4 class="widget-title mb-10 mt-10">Secure Payment</h4>
                        <p>We accept</p>

                        <img src="{{asset('assets/images/payment-logo.png')}}" alt="">
               


                
                    </div>
                </div>

            </div>
            <!--<div class="row mt-30">-->
            <!--    <div class="col-md-2">-->
            <!--        <div class="widget dark">-->
            <!--            <h5 class="widget-title mb-10">Call Us Now</h5>-->
            <!--            <div class="text-gray">-->
            <!--                +61-2-8005-6085-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
                <!--<div class="col-md-3">-->
                <!--    <div class="widget dark">-->
                <!--        <h5 class="widget-title mb-10">Connect With Us</h5>-->
                <!--        <ul class="styled-icons icon-bordered icon-sm">-->
                <!--            <li><a href="#"><i class="fa fa-facebook"></i></a></li>-->
                <!--            <li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
                <!--            <li><a href="#"><i class="fa fa-skype"></i></a></li>-->
                <!--            <li><a href="#"><i class="fa fa-youtube"></i></a></li>-->
                <!--            <li><a href="#"><i class="fa fa-instagram"></i></a></li>-->
                <!--            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>-->
                <!--        </ul>-->
                <!--    </div>-->
                <!--</div>-->
          
            </div>
        </div>
        <div class="footer-bottom bg-black-333">
            <div class="container pt-20 pb-20">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="font-12 text-black-777 m-0">Copyright &copy;<span id="display-year"></span>, <b>AssignmentHut</b>. All Rights Reserved. Designed by <a href="https://bytedesign.ca/">Byte design</a> </p>
                        <script typr="text/javascript">
                            var y = new Date();
                            var year = document.getElementById('display-year').innerHTML = y.getFullYear();
                            
                            
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End: Footer Section -->
    {{-- live chat code --}}
{{--     <div class="btn-chat" id="livechat-compact-container" style="visibility: visible; opacity: 1;">
    <div class="btn-holder">
        <a  href="{{ url('/messenger/chat') }}" class="link" target="_blank">Live Chat</a>
    </div>
</div> --}}
{{-- live chat code ends --}}

    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

<!-- end wrapper -->
