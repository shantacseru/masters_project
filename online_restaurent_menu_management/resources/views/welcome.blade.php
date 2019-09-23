@extends('layouts.main')
@section('title')
Home
@endsection
@section('main-body')


        <!--== 5. Header ==-->
        <section id="header-slider" class="owl-carousel">
            <div class="item">
                <div class="container">
                    <div class="header-content">
                        <h1 class="header-title">BEST FOOD</h1>
                        <p class="header-sub-title">create your own slogan</p>
                    </div> <!-- /.header-content -->
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="header-content">
                        <h1 class="header-title">BEST SNACKS</h1>
                        <p class="header-sub-title">create your own slogan</p>
                    </div> <!-- /.header-content -->
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="header-content text-right pull-right">
                        <h1 class="header-title">BEST DRINKS</h1>
                        <p class="header-sub-title">create your own slogan</p>
                    </div> <!-- /.header-content -->
                </div>
            </div>
        </section>


        <!--==  7. Afordable Pricing  ==-->
        <section id="pricing" class="pricing">
            <div id="w">
                <div class="pricing-filter">
                    <div class="pricing-filter-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="section-header">
                                        <h2 class="pricing-title">Affordable Pricing</h2>
                                        <ul id="filter-list" class="clearfix">
                                            <li class="filter" data-filter="all">All</li>
        	                                @foreach($categories as $categorie)
                                            <?php $filterName = str_replace(" ", "-", $categorie->name) ?>
                                            <li class="filter" data-filter=".{{$filterName}}">{{$categorie->name}}</li>   
                                            @endforeach

                                        </ul><!-- @end #filter-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">  
                        <div class="col-md-10 col-md-offset-1">
                            <ul id="menu-pricing" class="menu-price">
                            @foreach($categoriesItems as $item) 
                                <?php $filterName = str_replace(" ", "-", $item->category) ?>
                                
                                <li class="item {{$filterName}}">
                                <?php
                                   $dbLink =  str_replace('\\','/' , $item->image); 
                                ?>

                                    <a href="#" >
                                        <img src="<?php echo asset("storage/$dbLink")?>"  alt="Food"  width="283.5" height="230.48">
                                        <div class="menu-desc text-center">
                                            <span>
                                                <h3>{{$item->name}}</h3>
                                                <!-- Natalie &amp; Justin Cleaning by Justin Younger -->
                                                <button class="btn btn-primary ordered" item_name="{{$item->name}}" onclick="addToCart({{$item->id}}, {{$item->price}})">Add Item</button>
                                            </span>
                                            
                                        </div>
                                    </a>
                                        
                                    <h2 class="white">{{$item->price}}Tk</h2>
                                </li>
                            @endforeach

                                 
                            </ul>

                        </div>   
                    </div>
                </div>

            </div> 
        </section>
        
 

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/cart-management.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            
            $(document.body).on('click', '.ordered', function(event) {
                event.preventDefault();

                var item_name = $(this).attr('item_name');
                
                toastr.options = {"positionClass": 'toast-bottom-right'}
                toastr.info(item_name + " has added to your cart.")

                console.log('something');
            });
        });
        


    </script>
@endsection 