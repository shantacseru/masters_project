@extends('adminlte::page')

@section('title', 'Mamma\'s Kitchen')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}">
@endsection

@section('content_header')
    <h1>My Profile</h1>
@stop

@section('content')
 <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
    
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">My Infos</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" action="{{ url("/update-user-info") }}">

                        {{ csrf_field() }}

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="box-body" style="padding: 35px;">
                            <div class="form-group">
                              <label for="email">Email Address</label>
                              <input type="email" class="form-control" id="email" value="{{$user->email}}" disabled>
                            </div>

                        
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                            </div>

                        
                            <div class="form-group">
                              <label for="contact_no">Contact Number</label>
                              <input type="text" class="form-control" id="contact_no" placeholder="Contact Number" value="{{ $user_extra->contact_no }}" name="contact_no">
                            </div>

                        
                            <div class="form-group">
                              <label for="home_address">Home Address</label>
                              <input type="text" class="form-control" id="home_address" placeholder="Home Address" value="{{ $user_extra->home_address }}" name="home_address">
                            </div>

                        
                            <div class="form-group">
                              <label for="delivery_address">Delivery Address</label>
                              <input type="text" class="form-control" id="delivery_address" placeholder="Delivery Address" value="{{ $user_extra->delivery_address }}" name="delivery_address">
                            </div>

                    
                        
                        
                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                </div>

                <div class="card hovercard">
                    <!-- <div class="cardheader">
    
                    </div> -->

                    <?php
                                   $avatarLink =  str_replace('\\','/' , $user->avatar); 
                    ?>
                    <div class="avatar">
                        <img alt="" src="<?php echo asset("storage/$avatarLink")?>">
                    </div>


                    <div class="info">
                        <div class="title">
                        <a target="_blank" href="#">{{$user->name}}</a>
                        </div>

                        <div class="desc">{{$user->email}}</div>

                        <div class="desc">Member Since - {{$user->created_at}}</div> 
                    </div>


                    <div class="bottom">
                        <a class="btn btn-primary btn-twitter btn-sm social_app" href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a class="btn btn-danger btn-sm social_app" rel="publisher"
                           href="#">
                            <i class="fa fa-google-plus"></i>
                        </a>
                        <a class="btn btn-primary btn-sm social_app" rel="publisher"
                           href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a class="btn btn-warning btn-sm social_app" rel="publisher" href="#">
                            <i class="fa fa-behance"></i>
                        </a>
                    </div>
                </div>
    
            </div>
    
        </div>
    </div>

@stop