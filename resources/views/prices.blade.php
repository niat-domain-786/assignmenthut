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
                            <h2 class="title text-white">Prices, All prices are in USD</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="./">Home</a></li> 
                                <li class="active text-gray-silver">Prices</li>
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
                        <h2>Currency</h2>
                        <h3> AUD, GBP, EUR, CAD, USD</h3> 

                          <div class="clearfix"></div>
                                <div class="separator separator-rouned">
                                    <i class="fa fa-cog fa-spin"></i>
                                </div>

                        <h2>Types of Services</h2>
                       
<li>Academic Essay/Assignment</li>
<li>Business Report</li>
<li>Case Study</li>
<li>Dissertation/Thesis</li>
<li>Statistics/Economics Problem</li>
<li>PowerPoint Presentation</li>
<li>Reflection</li>
<li>Article Critique</li>
<li>Lab Report</li>
<li>Rewriting</li>
<li>Proofreading</li>
<li>Others (Custom Order)</li>


                          <div class="clearfix"></div>
                                <div class="separator separator-rouned">
                                    <i class="fa fa-cog fa-spin"></i>
                                </div>

<h2>Subjects</h2>
<li> Accounting</li>
<li> Business</li>
<li> Management</li>
<li> Marketing</li>
<li> Economics</li>
<li> Finance</li>


<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>


<h3><strong>Pages or words</strong> 1 page (approximately 250 words)</h3>
<p><strong>Type of Service</strong> Academic Essay/Assignment and Business Report and Article Critique</p>

{{-- <div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div> --}}

<div class="container ">
   <table class="table" style="margin:30px 0px;">
<tbody>
<tr>
<td width="110">
<p><strong>Urgency</strong></p>
</td>
<td width="95">
<p><strong>Doctoral</strong></p>
</td>
<td width="97">
<p><strong>Masters</strong></p>
</td>
<td width="104">
<p><strong>Bachelors</strong></p>
</td>
<td width="94">
<p><strong>Diploma</strong></p>
</td>
<td width="101">
<p><strong>High School</strong></p>
</td>
</tr>
<tr>
<td width="110">
<p>28 days</p>
</td>
<td width="95">
<p>$10.99</p>
</td>
<td width="97">
<p>$9.99</p>
</td>
<td width="104">
<p>$8.99</p>
</td>
<td width="94">
<p>$7.99</p>
</td>
<td width="101">
<p>$6.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>14 days</p>
</td>
<td width="95">
<p>$11.99</p>
</td>
<td width="97">
<p>$10.55</p>
</td>
<td width="104">
<p>$9.55</p>
</td>
<td width="94">
<p>$8.55</p>
</td>
<td width="101">
<p>$7.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>10 days</p>
</td>
<td width="95">
<p>$12.99</p>
</td>
<td width="97">
<p>$10.99</p>
</td>
<td width="104">
<p>$9.99</p>
</td>
<td width="94">
<p>$8.99</p>
</td>
<td width="101">
<p>$8.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>7 days</p>
</td>
<td width="95">
<p>$13.55</p>
</td>
<td width="97">
<p>$11.55</p>
</td>
<td width="104">
<p>$10.55</p>
</td>
<td width="94">
<p>$9.55</p>
</td>
<td width="101">
<p>$8.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>6 days</p>
</td>
<td width="95">
<p>$13.99</p>
</td>
<td width="97">
<p>$11.99</p>
</td>
<td width="104">
<p>$10.99</p>
</td>
<td width="94">
<p>$9.99</p>
</td>
<td width="101">
<p>$9.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>5 days</p>
</td>
<td width="95">
<p>$14.55</p>
</td>
<td width="97">
<p>$12.55</p>
</td>
<td width="104">
<p>$11.55</p>
</td>
<td width="94">
<p>$10.55</p>
</td>
<td width="101">
<p>$9.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>4 days</p>
</td>
<td width="95">
<p>$14.99</p>
</td>
<td width="97">
<p>$12.99</p>
</td>
<td width="104">
<p>$11.99</p>
</td>
<td width="94">
<p>$10.99</p>
</td>
<td width="101">
<p>$10.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>3 days</p>
</td>
<td width="95">
<p>$15.99</p>
</td>
<td width="97">
<p>$13.99</p>
</td>
<td width="104">
<p>$12.55</p>
</td>
<td width="94">
<p>$11.99</p>
</td>
<td width="101">
<p>$10.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>48 hours</p>
</td>
<td width="95">
<p>$16.99</p>
</td>
<td width="97">
<p>$14.99</p>
</td>
<td width="104">
<p>$13.99</p>
</td>
<td width="94">
<p>$12.99</p>
</td>
<td width="101">
<p>$11.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>24 hours</p>
</td>
<td width="95">
<p>$19.99</p>
</td>
<td width="97">
<p>$17.99</p>
</td>
<td width="104">
<p>$15.99</p>
</td>
<td width="94">
<p>$14.99</p>
</td>
<td width="101">
<p>$13.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>12 hours</p>
</td>
<td width="95">
<p>$22.99</p>
</td>
<td width="97">
<p>$20.99</p>
</td>
<td width="104">
<p>$18.99</p>
</td>
<td width="94">
<p>$17.99</p>
</td>
<td width="101">
<p>$15.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>8 hours</p>
</td>
<td width="95">
<p>$25.99</p>
</td>
<td width="97">
<p>$22.99</p>
</td>
<td width="104">
<p>$20.99</p>
</td>
<td width="94">
<p>$19.99</p>
</td>
<td width="101">
<p>$17.99</p>
</td>
</tr>
</tbody>
</table>
</div>


<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>



<p><strong>Type of Service </strong>Accounting/Finance/Law/Nursing/Lab Report</p>
<table class="table" style="margin: 30px 0px;">
<tbody>
<tr>
<td width="110">
<p><strong>Urgency</strong></p>
</td>
<td width="95">
<p><strong>Doctoral</strong></p>
</td>
<td width="97">
<p><strong>Masters</strong></p>
</td>
<td width="104">
<p><strong>Bachelors</strong></p>
</td>
<td width="94">
<p><strong>Diploma</strong></p>
</td>
<td width="101">
<p><strong>High School</strong></p>
</td>
</tr>
<tr>
<td width="110">
<p>28 days</p>
</td>
<td width="95">
<p>$11.99</p>
</td>
<td width="97">
<p>$10.99</p>
</td>
<td width="104">
<p>$9.99</p>
</td>
<td width="94">
<p>$8.99</p>
</td>
<td width="101">
<p>$7.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>14 days</p>
</td>
<td width="95">
<p>$12.99</p>
</td>
<td width="97">
<p>$11.55</p>
</td>
<td width="104">
<p>$10.55</p>
</td>
<td width="94">
<p>$9.55</p>
</td>
<td width="101">
<p>$8.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>10 days</p>
</td>
<td width="95">
<p>$13.99</p>
</td>
<td width="97">
<p>$11.99</p>
</td>
<td width="104">
<p>$10.99</p>
</td>
<td width="94">
<p>$9.99</p>
</td>
<td width="101">
<p>$8.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>7 days</p>
</td>
<td width="95">
<p>$14.55</p>
</td>
<td width="97">
<p>$12.55</p>
</td>
<td width="104">
<p>$11.55</p>
</td>
<td width="94">
<p>$10.55</p>
</td>
<td width="101">
<p>$9.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>6 days</p>
</td>
<td width="95">
<p>$14.99</p>
</td>
<td width="97">
<p>$12.99</p>
</td>
<td width="104">
<p>$11.99</p>
</td>
<td width="94">
<p>$10.99</p>
</td>
<td width="101">
<p>$9.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>5 days</p>
</td>
<td width="95">
<p>$15.55</p>
</td>
<td width="97">
<p>$13.55</p>
</td>
<td width="104">
<p>$12.55</p>
</td>
<td width="94">
<p>$11.55</p>
</td>
<td width="101">
<p>$10.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>4 days</p>
</td>
<td width="95">
<p>$15.99</p>
</td>
<td width="97">
<p>$13.99</p>
</td>
<td width="104">
<p>$12.99</p>
</td>
<td width="94">
<p>$11.99</p>
</td>
<td width="101">
<p>$10.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>3 days</p>
</td>
<td width="95">
<p>$16.99</p>
</td>
<td width="97">
<p>$14.99</p>
</td>
<td width="104">
<p>$13.99</p>
</td>
<td width="94">
<p>$12.55</p>
</td>
<td width="101">
<p>$11.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>48 hours</p>
</td>
<td width="95">
<p>$18.99</p>
</td>
<td width="97">
<p>$15.99</p>
</td>
<td width="104">
<p>$14.99</p>
</td>
<td width="94">
<p>$13.99</p>
</td>
<td width="101">
<p>$12.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>24 hours</p>
</td>
<td width="95">
<p>$20.99</p>
</td>
<td width="97">
<p>$18.99</p>
</td>
<td width="104">
<p>$17.99</p>
</td>
<td width="94">
<p>$15.99</p>
</td>
<td width="101">
<p>$14.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>12 hours</p>
</td>
<td width="95">
<p>$23.99</p>
</td>
<td width="97">
<p>$20.99</p>
</td>
<td width="104">
<p>$19.99</p>
</td>
<td width="94">
<p>$18.99</p>
</td>
<td width="101">
<p>$17.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>8 hours</p>
</td>
<td width="95">
<p>$26.99</p>
</td>
<td width="97">
<p>$23.99</p>
</td>
<td width="104">
<p>$22.99</p>
</td>
<td width="94">
<p>$20.99</p>
</td>
<td width="101">
<p>$19.99</p>
</td>
</tr>
</tbody>
</table>




<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>

<p><strong>Type of Service </strong>Dissertation</p>
<table class="table" style="margin: 30px 0px;">
<tbody>
<tr>
<td width="110">
<p><strong>Urgency</strong></p>
</td>
<td width="95">
<p><strong>Doctoral</strong></p>
</td>
<td width="97">
<p><strong>Masters</strong></p>
</td>
<td width="104">
<p><strong>Bachelors</strong></p>
</td>
<td width="94">
<p><strong>Diploma</strong></p>
</td>
</tr>
<tr>
<td width="110">
<p>28 days</p>
</td>
<td width="95">
<p>$13.99</p>
</td>
<td width="97">
<p>$11.99</p>
</td>
<td width="104">
<p>$10.99</p>
</td>
<td width="94">
<p>$9.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>14 days</p>
</td>
<td width="95">
<p>$14.99</p>
</td>
<td width="97">
<p>$12.99</p>
</td>
<td width="104">
<p>$11.99</p>
</td>
<td width="94">
<p>$10.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>10 days</p>
</td>
<td width="95">
<p>$15.99</p>
</td>
<td width="97">
<p>$13.99</p>
</td>
<td width="104">
<p>$12.99</p>
</td>
<td width="94">
<p>$11.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>7 days</p>
</td>
<td width="95">
<p>$16.99</p>
</td>
<td width="97">
<p>$14.99</p>
</td>
<td width="104">
<p>$13.99</p>
</td>
<td width="94">
<p>$12.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>6 days</p>
</td>
<td width="95">
<p>$18.99</p>
</td>
<td width="97">
<p>$15.99</p>
</td>
<td width="104">
<p>$14.99</p>
</td>
<td width="94">
<p>$13.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>5 days</p>
</td>
<td width="95">
<p>$20.99</p>
</td>
<td width="97">
<p>$16.99</p>
</td>
<td width="104">
<p>$15.99</p>
</td>
<td width="94">
<p>$14.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>4 days</p>
</td>
<td width="95">
<p>$23.99</p>
</td>
<td width="97">
<p>$18.99</p>
</td>
<td width="104">
<p>$16.99</p>
</td>
<td width="94">
<p>$15.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>3 days</p>
</td>
<td width="95">
<p>$25.99</p>
</td>
<td width="97">
<p>$20.99</p>
</td>
<td width="104">
<p>$17.99</p>
</td>
<td width="94">
<p>$16.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>48 hours</p>
</td>
<td width="95">
<p>$27.99</p>
</td>
<td width="97">
<p>$22.99</p>
</td>
<td width="104">
<p>$20.99</p>
</td>
<td width="94">
<p>$18.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>24 hours</p>
</td>
<td width="95">
<p>$29.99</p>
</td>
<td width="97">
<p>$24.99</p>
</td>
<td width="104">
<p>$22.99</p>
</td>
<td width="94">
<p>$20.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>12 hours</p>
</td>
<td width="95">
<p>$32.99</p>
</td>
<td width="97">
<p>$27.99</p>
</td>
<td width="104">
<p>$24.99</p>
</td>
<td width="94">
<p>$22.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>8 hours</p>
</td>
<td width="95">
<p>$34.99</p>
</td>
<td width="97">
<p>$29.99</p>
</td>
<td width="104">
<p>$26.99</p>
</td>
<td width="94">
<p>$24.99</p>
</td>
</tr>
</tbody>
</table>


<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>
<p>&nbsp;</p>
<p><strong>Type of Service </strong>Rewriting</p>
<table class="table" style="margin: 30px 0px;">
<tbody>
<tr>
<td width="110">
<p><strong>Urgency</strong></p>
</td>
<td width="88">
<p><strong>Doctoral</strong></p>
</td>
<td width="85">
<p><strong>Masters</strong></p>
</td>
<td width="104">
<p><strong>Bachelors</strong></p>
</td>
<td width="104">
<p><strong>Diploma</strong></p>
</td>
<td width="110">
<p><strong>High School</strong></p>
</td>
</tr>
<tr>
<td width="110">
<p>28 days</p>
</td>
<td width="88">
<p>$8.99</p>
</td>
<td width="85">
<p>$7.99</p>
</td>
<td width="104">
<p>$6.99</p>
</td>
<td width="104">
<p>$5.99</p>
</td>
<td width="110">
<p>$4.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>14 days</p>
</td>
<td width="88">
<p>$9.99</p>
</td>
<td width="85">
<p>$8.55</p>
</td>
<td width="104">
<p>$7.55</p>
</td>
<td width="104">
<p>$6.55</p>
</td>
<td width="110">
<p>$5.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>10 days</p>
</td>
<td width="88">
<p>$10.55</p>
</td>
<td width="85">
<p>$8.99</p>
</td>
<td width="104">
<p>$7.99</p>
</td>
<td width="104">
<p>$6.99</p>
</td>
<td width="110">
<p>$5.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>7 days</p>
</td>
<td width="88">
<p>$10.99</p>
</td>
<td width="85">
<p>$9.55</p>
</td>
<td width="104">
<p>$8.55</p>
</td>
<td width="104">
<p>$7.55</p>
</td>
<td width="110">
<p>$6.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>6 days</p>
</td>
<td width="88">
<p>$11.55</p>
</td>
<td width="85">
<p>$9.99</p>
</td>
<td width="104">
<p>$8.99</p>
</td>
<td width="104">
<p>$7.99</p>
</td>
<td width="110">
<p>$6.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>5 days</p>
</td>
<td width="88">
<p>$11.99</p>
</td>
<td width="85">
<p>$10.55</p>
</td>
<td width="104">
<p>$9.55</p>
</td>
<td width="104">
<p>$8.55</p>
</td>
<td width="110">
<p>$7.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>4 days</p>
</td>
<td width="88">
<p>$12.99</p>
</td>
<td width="85">
<p>$10.99</p>
</td>
<td width="104">
<p>$9.99</p>
</td>
<td width="104">
<p>$8.99</p>
</td>
<td width="110">
<p>$7.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>3 days</p>
</td>
<td width="88">
<p>$13.99</p>
</td>
<td width="85">
<p>$11.99</p>
</td>
<td width="104">
<p>$10.99</p>
</td>
<td width="104">
<p>$9.55</p>
</td>
<td width="110">
<p>$8.55</p>
</td>
</tr>
<tr>
<td width="110">
<p>48 hours</p>
</td>
<td width="88">
<p>$14.99</p>
</td>
<td width="85">
<p>$12.99</p>
</td>
<td width="104">
<p>$11.99</p>
</td>
<td width="104">
<p>$9.99</p>
</td>
<td width="110">
<p>$8.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>24 hours</p>
</td>
<td width="88">
<p>$16.99</p>
</td>
<td width="85">
<p>$13.99</p>
</td>
<td width="104">
<p>$12.99</p>
</td>
<td width="104">
<p>$10.99</p>
</td>
<td width="110">
<p>$9.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>12 hours</p>
</td>
<td width="88">
<p>$18.99</p>
</td>
<td width="85">
<p>$15.99</p>
</td>
<td width="104">
<p>$14.99</p>
</td>
<td width="104">
<p>$12.99</p>
</td>
<td width="110">
<p>$11.99</p>
</td>
</tr>
<tr>
<td width="110">
<p>8 hours</p>
</td>
<td width="88">
<p>$20.99</p>
</td>
<td width="85">
<p>$18.99</p>
</td>
<td width="104">
<p>$16.99</p>
</td>
<td width="104">
<p>$14.99</p>
</td>
<td width="110">
<p>$13.99</p>
</td>
</tr>
</tbody>
</table>


<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>
<p><strong>&nbsp;</strong></p>
<p><strong>Type of Service </strong>Proofreading</p>
<table class="table" style="margin: 30px 0px;">
<tbody>
<tr>
<td width="117">
<p><strong>Urgency</strong></p>
</td>
<td width="109">
<p><strong>Doctoral</strong></p>
</td>
<td width="95">
<p><strong>Masters</strong></p>
</td>
<td width="94">
<p><strong>Bachelors</strong></p>
</td>
<td width="85">
<p><strong>Diploma</strong></p>
</td>
<td width="100">
<p><strong>High School</strong></p>
</td>
</tr>
<tr>
<td width="117">
<p>28 days</p>
</td>
<td width="109">
<p>$6.99</p>
</td>
<td width="95">
<p>$4.99</p>
</td>
<td width="94">
<p>$3.99</p>
</td>
<td width="85">
<p>$2.99</p>
</td>
<td width="100">
<p>$1.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>14 days</p>
</td>
<td width="109">
<p>$7.55</p>
</td>
<td width="95">
<p>$5.55</p>
</td>
<td width="94">
<p>$4.55</p>
</td>
<td width="85">
<p>$3.55</p>
</td>
<td width="100">
<p>$2.55</p>
</td>
</tr>
<tr>
<td width="117">
<p>10 days</p>
</td>
<td width="109">
<p>$7.99</p>
</td>
<td width="95">
<p>$5.99</p>
</td>
<td width="94">
<p>$4.99</p>
</td>
<td width="85">
<p>$3.99</p>
</td>
<td width="100">
<p>$2.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>7 days</p>
</td>
<td width="109">
<p>$8.55</p>
</td>
<td width="95">
<p>$6.55</p>
</td>
<td width="94">
<p>$5.55</p>
</td>
<td width="85">
<p>$4.55</p>
</td>
<td width="100">
<p>$3.55</p>
</td>
</tr>
<tr>
<td width="117">
<p>6 days</p>
</td>
<td width="109">
<p>$8.99</p>
</td>
<td width="95">
<p>$6.99</p>
</td>
<td width="94">
<p>$5.99</p>
</td>
<td width="85">
<p>$4.99</p>
</td>
<td width="100">
<p>$3.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>5 days</p>
</td>
<td width="109">
<p>$9.99</p>
</td>
<td width="95">
<p>$7.99</p>
</td>
<td width="94">
<p>$6.55</p>
</td>
<td width="85">
<p>$5.55</p>
</td>
<td width="100">
<p>$4.55</p>
</td>
</tr>
<tr>
<td width="117">
<p>4 days</p>
</td>
<td width="109">
<p>$10.99</p>
</td>
<td width="95">
<p>$8.99</p>
</td>
<td width="94">
<p>$6.99</p>
</td>
<td width="85">
<p>$5.99</p>
</td>
<td width="100">
<p>$4.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>3 days</p>
</td>
<td width="109">
<p>$11.99</p>
</td>
<td width="95">
<p>$9.99</p>
</td>
<td width="94">
<p>$7.99</p>
</td>
<td width="85">
<p>$6.55</p>
</td>
<td width="100">
<p>$5.55</p>
</td>
</tr>
<tr>
<td width="117">
<p>48 hours</p>
</td>
<td width="109">
<p>$12.99</p>
</td>
<td width="95">
<p>$10.99</p>
</td>
<td width="94">
<p>$8.99</p>
</td>
<td width="85">
<p>$6.99</p>
</td>
<td width="100">
<p>$5.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>24 hours</p>
</td>
<td width="109">
<p>$14.99</p>
</td>
<td width="95">
<p>$11.99</p>
</td>
<td width="94">
<p>$10.99</p>
</td>
<td width="85">
<p>$8.99</p>
</td>
<td width="100">
<p>$6.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>12 hours</p>
</td>
<td width="109">
<p>$16.99</p>
</td>
<td width="95">
<p>$13.99</p>
</td>
<td width="94">
<p>$11.99</p>
</td>
<td width="85">
<p>$10.99</p>
</td>
<td width="100">
<p>$8.99</p>
</td>
</tr>
<tr>
<td width="117">
<p>8 hours</p>
</td>
<td width="109">
<p>$19.99</p>
</td>
<td width="95">
<p>$15.99</p>
</td>
<td width="94">
<p>$13.99</p>
</td>
<td width="85">
<p>$12.99</p>
</td>
<td width="100">
<p>$10.99</p>
</td>
</tr>
</tbody>
</table>


<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>Type of Service </strong>PowerPoint Slides</p>
<table class="table" style="margin: 30px 0px;">
<tbody>
<tr>
<td width="101">
<p><strong>Urgency</strong></p>
</td>
<td width="97">
<p><strong>Doctoral</strong></p>
</td>
<td width="95">
<p><strong>Masters</strong></p>
</td>
<td width="105">
<p><strong>Bachelors</strong></p>
</td>
<td width="105">
<p><strong>Diploma</strong></p>
</td>
<td width="99">
<p><strong>High School</strong></p>
</td>
</tr>
<tr>
<td width="101">
<p>28 days</p>
</td>
<td width="97">
<p>$1.99/slide</p>
</td>
<td width="95">
<p>$1.55/slide</p>
</td>
<td width="105">
<p>$1.55/slide</p>
</td>
<td width="105">
<p>$0.99/slide</p>
</td>
<td width="99">
<p>$0.99/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>14 days</p>
</td>
<td width="97">
<p>$2.55/slide</p>
</td>
<td width="95">
<p>$1.99/slide</p>
</td>
<td width="105">
<p>$1.99/slide</p>
</td>
<td width="105">
<p>$1.55/slide</p>
</td>
<td width="99">
<p>$1.55/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>10 days</p>
</td>
<td width="97">
<p>$2.99/slide</p>
</td>
<td width="95">
<p>$2.55/slide</p>
</td>
<td width="105">
<p>$2.55/slide</p>
</td>
<td width="105">
<p>$1.99/slide</p>
</td>
<td width="99">
<p>$1.99/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>7 days</p>
</td>
<td width="97">
<p>$3.99/slide</p>
</td>
<td width="95">
<p>$2.99/slide</p>
</td>
<td width="105">
<p>$2.99/slide</p>
</td>
<td width="105">
<p>$2.55/slide</p>
</td>
<td width="99">
<p>$2.55/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>6 days</p>
</td>
<td width="97">
<p>$4.99/slide</p>
</td>
<td width="95">
<p>$3.55/slide</p>
</td>
<td width="105">
<p>$3.55/slide</p>
</td>
<td width="105">
<p>$2.99/slide</p>
</td>
<td width="99">
<p>$2.99/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>5 days</p>
</td>
<td width="97">
<p>$5.99/slide</p>
</td>
<td width="95">
<p>$3.99/slide</p>
</td>
<td width="105">
<p>$3.99/slide</p>
</td>
<td width="105">
<p>$3.55/slide</p>
</td>
<td width="99">
<p>$3.55/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>4 days</p>
</td>
<td width="97">
<p>$6.99/slide</p>
</td>
<td width="95">
<p>$4.99/slide</p>
</td>
<td width="105">
<p>$4.55/slide</p>
</td>
<td width="105">
<p>$3.99/slide</p>
</td>
<td width="99">
<p>$3.99/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>3 days</p>
</td>
<td width="97">
<p>$7.99/slide</p>
</td>
<td width="95">
<p>$5.99/slide</p>
</td>
<td width="105">
<p>$4.99/slide</p>
</td>
<td width="105">
<p>$4.55/slide</p>
</td>
<td width="99">
<p>$4.55/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>48 hours</p>
</td>
<td width="97">
<p>$8.99/slide</p>
</td>
<td width="95">
<p>$6.99/slide</p>
</td>
<td width="105">
<p>$5.99/slide</p>
</td>
<td width="105">
<p>$4.99/slide</p>
</td>
<td width="99">
<p>$4.99/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>24 hours</p>
</td>
<td width="97">
<p>$9.99/slide</p>
</td>
<td width="95">
<p>$7.99/slide</p>
</td>
<td width="105">
<p>$6.99/slide</p>
</td>
<td width="105">
<p>$5.99/slide</p>
</td>
<td width="99">
<p>$5.55/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>12 hours</p>
</td>
<td width="97">
<p>$10.99/slide</p>
</td>
<td width="95">
<p>$8.99/slide</p>
</td>
<td width="105">
<p>$7.99/slide</p>
</td>
<td width="105">
<p>$6.99/slide</p>
</td>
<td width="99">
<p>$5.99/slide</p>
</td>
</tr>
<tr>
<td width="101">
<p>8 hours</p>
</td>
<td width="97">
<p>$11.99/slide</p>
</td>
<td width="95">
<p>$9.99/slide</p>
</td>
<td width="105">
<p>$8.99/slide</p>
</td>
<td width="105">
<p>$7.99/slide</p>
</td>
<td width="99">
<p>$6.99/slide</p>
</td>
</tr>
</tbody>
</table>

<div class="clearfix"></div>
         <div class="separator separator-rouned">
       <i class="fa fa-cog fa-spin"></i>
</div>
<p><strong>&nbsp;</strong></p>
<p>&nbsp;</p>
<p><strong>Type of Service </strong>Statistics/Economics Problem</p>
<table class="table" style="margin: 30px 0px;">
<tbody>
<tr>
<td width="85">
<p><strong>Urgency</strong></p>
</td>
<td width="104">
<p><strong>Doctoral</strong></p>
</td>
<td width="113">
<p><strong>Masters</strong></p>
</td>
<td width="101">
<p><strong>Bachelors</strong></p>
</td>
<td width="102">
<p><strong>Diploma</strong></p>
</td>
<td width="97">
<p><strong>High School</strong></p>
</td>
</tr>
<tr>
<td width="85">
<p>28 days</p>
</td>
<td width="104">
<p>$21.99/prob</p>
</td>
<td width="113">
<p>$19.99/prob</p>
</td>
<td width="101">
<p>$15.99/prob</p>
</td>
<td width="102">
<p>$12.99/prob</p>
</td>
<td width="97">
<p>$10.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>14 days</p>
</td>
<td width="104">
<p>$23.99/prob</p>
</td>
<td width="113">
<p>$21.99/prob</p>
</td>
<td width="101">
<p>$17.99/prob</p>
</td>
<td width="102">
<p>$13.99/prob</p>
</td>
<td width="97">
<p>$11.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>10 days</p>
</td>
<td width="104">
<p>$25.99/prob</p>
</td>
<td width="113">
<p>$23.99/prob</p>
</td>
<td width="101">
<p>$19.99/prob</p>
</td>
<td width="102">
<p>$14.99/prob</p>
</td>
<td width="97">
<p>$12.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>7 days</p>
</td>
<td width="104">
<p>$27.99/prob</p>
</td>
<td width="113">
<p>$25.99/prob</p>
</td>
<td width="101">
<p>$21.99/prob</p>
</td>
<td width="102">
<p>$15.99/prob</p>
</td>
<td width="97">
<p>$13.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>6 days</p>
</td>
<td width="104">
<p>$29.99/prob</p>
</td>
<td width="113">
<p>$27.99/prob</p>
</td>
<td width="101">
<p>$23.99/prob</p>
</td>
<td width="102">
<p>$16.99/prob</p>
</td>
<td width="97">
<p>$14.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>5 days</p>
</td>
<td width="104">
<p>$31.99/prob</p>
</td>
<td width="113">
<p>$29.99/prob</p>
</td>
<td width="101">
<p>$25.99/prob</p>
</td>
<td width="102">
<p>$17.99/prob</p>
</td>
<td width="97">
<p>$15.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>4 days</p>
</td>
<td width="104">
<p>$33.99/prob</p>
</td>
<td width="113">
<p>$31.99/prob</p>
</td>
<td width="101">
<p>$27.99/prob</p>
</td>
<td width="102">
<p>$19.99/prob</p>
</td>
<td width="97">
<p>$16.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>3 days</p>
</td>
<td width="104">
<p>$36.99/prob</p>
</td>
<td width="113">
<p>$33.99/prob</p>
</td>
<td width="101">
<p>$29.99/prob</p>
</td>
<td width="102">
<p>$21.99/prob</p>
</td>
<td width="97">
<p>$17.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>48 hours</p>
</td>
<td width="104">
<p>$39.99/prob</p>
</td>
<td width="113">
<p>$36.99/prob</p>
</td>
<td width="101">
<p>$31.99/prob</p>
</td>
<td width="102">
<p>$23.99/prob</p>
</td>
<td width="97">
<p>$19.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>24 hours</p>
</td>
<td width="104">
<p>$42.99/prob</p>
</td>
<td width="113">
<p>$39.99/prob</p>
</td>
<td width="101">
<p>$33.99/prob</p>
</td>
<td width="102">
<p>$25.99/prob</p>
</td>
<td width="97">
<p>$21.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>12 hours</p>
</td>
<td width="104">
<p>$45.99/prob</p>
</td>
<td width="113">
<p>$42.99/prob</p>
</td>
<td width="101">
<p>$36.99/prob</p>
</td>
<td width="102">
<p>$27.99/prob</p>
</td>
<td width="97">
<p>$23.99/prob</p>
</td>
</tr>
<tr>
<td width="85">
<p>8 hours</p>
</td>
<td width="104">
<p>$49.99/prob</p>
</td>
<td width="113">
<p>$45.99/prob</p>
</td>
<td width="101">
<p>$39.99/prob</p>
</td>
<td width="102">
<p>$29.99/prob</p>
</td>
<td width="97">
<p>$25.99/prob</p>
</td>
</tr>
</tbody>
</table>



{{-- <p>Total Price $ab.cd Proceed to Order</p> --}}
<p>The final price for your order is calculated based on the following factors: -</p>
<p>&nbsp;</p>

<li>Urgency of the paper</li>
<li>Number of pages or words</li>
<li>Level of education</li>





                     
                    </div> 
                </div>
            </div>
        </section>

    </div>

@endsection   