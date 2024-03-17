@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> Invoices Page</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Invoices</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Invoice Date</th>
                        <th>Promoter Name</th>
                        <th>Invoice Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['invoices'] as $item)
                    <tr>
                        <td>{{$item->invoice_number}}</td>
                        <td>{{$item->invoice_date}}</td>
                        <td>{{$item->firstname}} {{$item->surname}}</td>
                        <td>
                            <table class="">
                                <thead style="background-color: black;">
                                    <th style="color: whitesmoke;">Product</th>
                                    <th style="color: whitesmoke;">Quantity</th>
                                </thead>
                                <tbody>
                                    @foreach($item->combined_array as $things=>$values)
                                    <tr>
                                        <td>{{$values['product_name']}}</td>
                                        <td>{{$values['invoice_quantity']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <a href="{{url('edit_invoice/'.$item->invoice_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <form method="GET" action="{{url('delete_invoice/'.$item->invoice_id)}}">
                                @csrf
                                <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
          
        </div>
        <div class="text-center d-flex justify-content-center">

        {{ $data['diseases']->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection