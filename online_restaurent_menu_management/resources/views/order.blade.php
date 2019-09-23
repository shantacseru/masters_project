@extends('layouts.general')

@section('title')
Order Confirmation
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/shopping-cart.css') }}">
@endsection

@section('main-body')

 <!--== 6. About us ==-->
 <section id="about" class="about"> 
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-6 col-md-offset-3 col-sm-offset-2">  
                                          
                            <div class="panel panel-info" >
                                    <div class="panel-heading">
                                        <div class="panel-title">Order Confirmation</div>
                                        <div style="float:right; font-size: 80%; position: relative; top:-10px">Not sure ? <a href="#" onclick="showCart()">Have a look</a></div>
                                    </div>     
                
                                    <div style="padding-top:30px" class="panel-body" >
                
                                        <div id="orderMessage"  class="col-sm-12"></div>
                                        <input type="hidden" value="not" id="order_ajax_response">

                                        @auth
                                        <form id="orderForm" class="form-horizontal" method="POST" action="#" role="form" onsubmit="confirmOrder()">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                                    
                                                    <div style="margin-bottom: 25px" class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-spoon"></i></span>
                                                                <input id="tableId" type="text" class="form-control" name="tableId" placeholder="Table no (keep empty if online order)">
                                                    </div>

                                                    <div class="input-group">
                                                            <div class="radio">
                                                            <label>
                                                                <input required id="payment" type="radio" name="method" value="hand"> Cash on spot
                                                            </label>
                                                            &nbsp;
                                                            <label>
                                                                    <input required id="payment" type="radio" name="method" value="delivery"> Cash on delivery
                                                            </label>
                                                            </div>
                                                    </div>
                    
                                                <div style="margin-top:10px" class="form-group">
                                                    <!-- Button -->
                
                                                    <div class="col-sm-12 controls">

                                                    <button id="confirm-order" type="button" class="btn btn-success">Confirm Order</button> 
                                                    <button id="confirm-order_final" type="submit" class="btn btn-success" style="display: none;">Confirm Order</button> 
                
                                                    </div>
                                                </div>
                                   
                                            </form>  
                                        @else
                                        <form id="orderForm" class="form-horizontal" method="POST" action="#" role="form" onsubmit="confirmOrder()">
                                            {{ csrf_field() }}
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input id="name" type="text" class="form-control" name="name" value="" placeholder="Name" required>                                        
                                                    </div>
                                                
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-spoon"></i></span>
                                                        <input id="tableId" type="text" class="form-control" name="tableId" placeholder="Table no" required>
                                            </div>
                                                    
                                                
                                                    <div class="input-group">
                                                            <div class="radio">
                                                            <label>
                                                                <input id="payment" type="radio" name="method" value="hand" required> Cash on spot
                                                            </label>
                                                            &nbsp;
                                                            <label>
                                                                    <input id="payment" type="radio" name="method" value="delivery" required> Cash on delivery
                                                            </label>
                                                            </div>
                                                    </div>
                    
                                                <div style="margin-top:10px" class="form-group">
                                                    <!-- Button -->
                
                                                    <div class="col-sm-12 controls">

                                                    <button id="confirm-order" type="button" class="btn btn-success">Confirm Order</button> 
                                                    <button id="confirm-order_final" type="submit" class="btn btn-success" style="display: none;">Confirm Order</button> 
                
                                                    </div>
                                                </div>
                                                
                
                                                <div class="form-group">
                                                    <div class="col-md-12 control">
                                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                            Wnat to order online ? 
                                                        <a href="/login">
                                                            Log in 
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </form>  
                                        @endauth
                                           
                                        </div>                     
                                    </div>  
                        </div>
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.wrapper -->
</section> <!-- /#about -->

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/cart-management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/order-management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            
            $(document.body).on('click', '#confirm-order', function(event) {
                //this.event.preventDefault();
                
                swal({
                   title: 'Are you sure?',
                   text: 'Do you really want to confirm your order?.',
                   icon: 'warning',
                   buttons: true,
                   dangerMode: false,
                 })
                 .then((willDelete) => {
                   if (willDelete) 
                   {
                      $("#confirm-order_final").click();

                       

                          if ($("#order_ajax_response").val() == 'success') {

                                swal("Good job!", "Your order is confirmed.", "success");
                                
                                var link = '<?php echo url("") ?>';

                                $('#number-of-item').html('0');
                                $('#orderMessage').addClass('alert alert-success');
                                $('#orderMessage').html('Order successful ! To do more order : <a target="_BLANK" class="info" href ="'+ link +'">Click here</a>');
                                $('#confirm-order').attr("disabled", true);
                                $('#orderForm').trigger("reset");

                          } else if ($("#order_ajax_response").val() == 'error') {

                                swal("Error!", "Something went wrong.", "error");

                                $('#orderMessage').addClass('alert alert-danger');
                                $('#orderMessage').html('Something wrong , try again !');
                          }
                    
                   }
                });

            });

        });

    </script>
@endsection