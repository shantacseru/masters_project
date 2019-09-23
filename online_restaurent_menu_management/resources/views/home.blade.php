@extends('adminlte::page')

@section('title', 'Mamma\'s Kitchen' )

@section('content_header')
    <h1>Order history</h1>
@stop

@section('content')
<table id="order-history" class="display table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Order Type</th>
            <th>Items</th>
            <th>Discount</th>
            <th>Total Amount</th> 
            <th>Status</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ($returnRes as $order)
            <tr>
            <td>{{$order['order_id']}}</td>
            <td>{{$order['order_type']}}</td>
            {{-- {{$order['items'][0]['name']}} --}}
            <td>
                    <ol>
                @foreach ($order['items'] as $item)
                    
                        <li>{{ $item['name'].' - '.$item['amount'].' - '.$item['unit_price']}}</li>
                    
                @endforeach
                </ol>
            </td>
            <td>{{$order['discount']}}</td>
            <td>{{$order['total_amount']}}/-</td> 



            <?php if(strtolower($order['status']) == 'pending'): ?>
                <td><span class="badge badge-warning">Pending</span></td>
            <?php elseif(strtolower($order['status']) == 'processing'): ?>
                <td><span class="badge badge-info">Processing</span></td>
            <?php elseif(strtolower($order['status']) == 'delivered'): ?>
                <td><span class="badge badge-success">Delivered</span></td>
            <?php endif; ?>

                <!-- <td>{{$order['status']}}</td>  -->
            </tr> 
        @endforeach
    </tbody>
</table>
@stop