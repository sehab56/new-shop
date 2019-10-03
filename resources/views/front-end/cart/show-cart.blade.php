@extends('front-end.master')

@section('body')

    <div class="banner1">
        <div class="container">
            <h3><a href="index.html">Home</a> / <span>Add To Card</span></h3>
        </div>
    </div>
    <!--banner-->

    <!--content-->
    <div class="content">
        <!--single-->
        <div class="single-wl3">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <h3 class="text-center text-success">My Shopping Card</h3>
                        <table class="table table-bordered" >
                            <hr/>
                            <tr class="bg-primary">
                                <th>SL No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price TK.</th>
                                <th>Quantity</th>
                                <th>Total Price TK.</th>
                                <th>Action</th>
                             </tr>
                            @php($i = 1)
                            @php($sum = 0)
                            @foreach($cartProducts as $cartProduct)
                            <tr class="bg-primary">
                                <td>{{ $i++ }}</td>
                                <td>{{ $cartProduct->name }}</td>
                                <td><img src="{{ asset($cartProduct->attributes->image) }}" alt="" height="80" width="90" /></td>
                                <td>{{ $cartProduct->price }}</td>
                                <td>
                                    <form action="{{ route('update-cart') }}" method="post">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $cartProduct->quantity }}" min="1"/>
                                        <input type="hidden" name="id" value="{{ $cartProduct->id }}"/>
                                        <input type="submit" name="btn" value="Update"/>

                                    </form>
                                </td>
                                <td>{{ $total = $cartProduct->price*$cartProduct->quantity  }}</td>
                                <td>
                                    <a href="{{route('delete-card-item',['id'=>$cartProduct->id])}}" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                             <?php $sum = $sum+$total; ?>
                             @endforeach
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <th>Item Total (TK. )</th>
                                <td>{{ $sum }}</td>
                            </tr>
                            <tr>
                                <th>Vat Total (TK. )</th>
                                <td>{{ $vat=0 }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total (TK. )</th>
                                <td>{{ $orderTotal = $sum+$vat }}</td>
                                <?php Session::put('orderTotal',$orderTotal)?>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">

                        @if( Session::get('customerId') && Session::get('shippingId') )
                            <a href="{{ route('shipping-payment') }}" class="btn btn-success pull-right">Checkout</a>
                        @elseif(Session::get('customerId'))
                            <a href="{{ route('checkout-shipping') }}" class="btn btn-success pull-right">Checkout</a>
                        @else
                            <a href="{{ route('checkout') }}" class="btn btn-success pull-right">Checkout</a>
                        @endif

                        <a href="" class="btn btn-success ">Contiune Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        <!--single-->

        <!--new-arrivals-->
    </div>

@endsection