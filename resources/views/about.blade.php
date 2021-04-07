@extends('layouts.frontend.app')

@section('title','Home')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

	<link href="{{ asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/home/iblog.css')}}" rel="stylesheet">
	
	<style>
		.card-body{width:280px;height:auto;background:rgba(0,0,0,0.2);border-radius:0px;float:left;}
    .card-body>h4{color:black;}
    .card-deck{margin-top:30px;margin-bottom:30px;}
    .card-img-top{height:250px;width:200px;}
	</style>
@endpush

@section('content')
    <div class="container">
        <h2 style="text-align:center;margin-top:20px;">About iBlog</h2><br><br>

      <div class="card"><h4>This is a blogging platform where passionate authors can write about the things that they love and post seekers can read articles on their favorite topics. This platform will connect these two types of people and they can fulfill each other demands. Readers have the ability to like their favorite posts and browse through the liked posts whenever they want. <br>
        And FInally, subscribe the site to stay tune get notification via email.
    </h4>
      </div>
      <br><br>

       <h3 style="text-align:center;margin-top:20px;"> Contact</h3><br><br>
  <div class="card-deck">
  <div class="card-body">
  <img class="card-img-top" src="{{ Storage::url('site/muhaimin.jpg')}}" alt="Card image">
  
    <h4 class="card-title">MD Muhaiminul Islam</h4>
    <h5>Email: labibmuhaimin@gmail.com</h5>
    <a href=""></a>
  </div>
<div class="card-body">
  <img class="card-img-top" src="{{ Storage::url('site/rahel.jpg')}}" alt="Card image">
  
    <h4 class="card-title">Md Fahedur Rahman</h4>
    <h5>Email: ahmedrahel72@gmail.com</h5>
    <a href=""></a>
  
</div></div>
   </div>
@endsection

@push('js')

@endpush