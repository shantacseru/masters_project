@extends('layouts.general')

@section('title')
Cart
@endsection

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/shopping-cart.css') }}">
@endsection

@section('main-body')



<!--== 6. About us ==-->
<section id="about" class="about">
        <?php 
            $cartLength = count($cartItems);
        ?>
    <div class="container cart-container">
        <?php 
            $totalBill = 0;
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                         <span class="shopping-cart-label"> My Dish</span> 
                    </div>
                    <div class="col-xs-6">
                        <a href="/" class="btn btn-primary btn-sm btn-block">
                            <span></span> Continue adding
                        </a>
                    </div>

                </div>
                <hr>
                
                @if($cartLength > 0)
                @foreach($cartItems as $item)
                <!-- {{$item->id}} -->
                    <?php
                        if($item->image && strlen($item->image) > 0 ) {

                            $dbLink =  str_replace('\\','/' , $item->image);
                            
                        } else {
                                $dbLink = "http://placehold.it/100x70";
                        }
                        $totalBill += ( $item->price * $idAmount[$item->id] ) ;
                    ?>
                    <div id="{{$item->id}}">
                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive cart-item-img" src="<?php echo asset("storage/$dbLink")?>" height="70" width="100">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="product-name"><strong>{{$item->name}}</strong></h4>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6 text-right">
                                <h6><strong>{{$item->price}} <span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-xs-4">
                                <input type="number" class="form-control input-sm" min="1" oninput="preventInput()" onchange="updateCart('{{$item->id}}')" value="<?php echo $idAmount[$item->id]?>">
                            </div>
                            <div class="col-xs-2">
                                <button type="button" class="btn btn-link btn-xs delete_item" order_id="{{$item->id}}">
                                    <span class="fa fa-trash fa-2x"> </span>
                                </button>
                            </div>
                        </div>


                    </div>
                    <hr>
                </div>
                
                @endforeach
                @else
                <div class="row text-center">

                        No Items found
                </div>
                @endif
 
                <div class="row text-center">
                    <div class="col-xs-9">
                        <h4 class="text-right">Total - <strong><span id="totalAmount">{{$totalBill}}</span>Tk</strong></h4>
                    </div>
                    <div class="col-xs-3">
                        @if ( $cartLength <= 0 )

                            <a  href="#" disabled   class="btn btn-success btn-block order_confirmation">
                                Order Now
                            </a>
                        @else
                        <a  href="#" id="orderBtn"   class="btn btn-success btn-block order_confirmation">
                            Order Now
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- /#about -->

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/cart-management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            
            $(document.body).on('click', '.order_confirmation', function(event) {
                event.preventDefault();
                
                swal({
                   title: 'Are you sure?',
                   text: 'Your order will be recorded.',
                   icon: 'warning',
                   buttons: true,
                   dangerMode: false,
                 })
                 .then((willDelete) => {
                   if (willDelete) 
                   {
                       var link = '<?php echo url("/order-details") ?>';
                       window.location.assign(link);
                   }
                });

            });


            $(document.body).on('click', '.delete_item', function(event) {
                event.preventDefault();
                
                var order_id = $(this).attr('order_id');

                swal({
                   title: 'Are you sure?',
                    text: 'Item will be deleted from your order.',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                 })
                 .then((willDelete) => {
                   if (willDelete) 
                   {
                       deleteFromCart(order_id);
                   }
                 });

                
            });

        });

    </script>
@endsection