@extends('admin.master')

@section('title')
    Manage Order
@endsection

@section('body')

    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="text-center text-success" >{{ Session('message') }}</h3>
                    <table class="table table-bordered">
                        <tr class="bg-primary">
                            <th>Sl No</th>
                            <th>Customer Name</th>
                            <th>Order Total</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $order->first_name.' '.$order->last_name }}</td>
                                <td>{{ $order->order_total }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <a href="{{route('view-order-detail',['id'=>$order->id])}}" class="btn btn-info btn-xs" title="view order details">
                                        <span class="glyphicon glyphicon-zoom-in"></span>
                                    </a>

                                    <a href="{{route('view-order-invoice',['id'=>$order->id])}}" class="btn btn-warning btn-xs" title="view order invoice">
                                        <span class="glyphicon glyphicon-zoom-out"></span>
                                    </a>
                                    <a href="{{route('download-order-invoice',['id'=>$order->id])}}" class="btn btn-primary btn-xs" title="download order invoice">
                                        <span class="glyphicon glyphicon-download"></span>
                                    </a>

                                    <a href="{{route('edit-category',['id'=>$order->id])}}" class="btn btn-success btn-xs" title="edit order">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="{{ route('delete-category',['id'=>$order->id]) }}" class="btn btn-danger btn-xs" title="delete order">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
