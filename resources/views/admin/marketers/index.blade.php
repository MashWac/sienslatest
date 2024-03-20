@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Marketers Page</h2>
        </div>
    </div>
    <div class="card" >
        <div class="card-body">
            <h5>Quick Nav</h5>
            <div class="col-md-8">
                <div style="float: left;">
                <a href="{{url('add_receipt')}}" class="btn btn-primary">Add Receipt</a><br>
                <a href="{{url('view_receipts')}}"class="btn btn-warning" style="margin-top:10px">View Receipt</a>

                </div>

                <div style="float:left; margin-left:30px;">                
                <a href="{{url('add_invoice')}}" class="btn btn-success">Add Invoices</a><br>

                <a href="{{url('view_invoices')}}" class="btn btn-danger"  style="margin-top:10px">View Invoices</a>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Marketers</h3>
                <div class="card">
                    <h5>Filters</h5><br>
                    <div class="card-body">
                    <form action="{{url('insert-user')}}" method="POST">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_date" class="col-md-4 col-form-label text-md-end">{{ __('Start Date:') }}</label>

                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" autocomplete="start_date" autofocus>
                                <span class="invalid-feedback" role="alert">
                                @error('start_date')<strong>{{ $message }}</strong>@enderror
                                </span>
                                    
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="col-md-4 col-form-label text-md-end">{{ __('End Date:') }}</label>

                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" autocomplete="end_date" autofocus>
                                <span class="invalid-feedback" role="alert">
                                @error('end_date')<strong>{{ $message }}</strong>@enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="marketer_name" class="col-md-4 col-form-label text-md-end">{{ __('Marketer:') }}</label>
                                <input id="marketer_name" type="text" class="form-control @error('marketer_name') is-invalid @enderror" name="marketer_name" value="{{ old('marketer_name') }}" placeholder="Enter marketer name, email,phone to search" autocomplete="marketer_name">
                                <span class="invalid-feedback" role="alert">
                                @error('marketer_name')  <strong>{{ $message }}</strong>@enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="marketer_type" class="col-md-4 col-form-label text-md-end">{{ __('Marketer Type:') }}</label>
                                <input id="marketer_type" type="text" class="form-control @error('marketer_type') is-invalid @enderror" name="marketer_type" value="{{ old('marketer_type') }}" autocomplete="marketer_type" placeholder="Enter Markerter Type">
                                <span class="invalid-feedback" role="alert">
                                @error('marketer_type')  <strong>{{ $message }}</strong>@enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Marketer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Worth of Products Given</th>
                        <th>Total Worth Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['marketers'] as $item)
                    <tr>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->firstname}}</td>
                        <td>{{$item->surname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->telephone}}</td>
                        <td>{{$item->invoice_total_value}} KES</td>
                        <td>{{$item->receipt_total_value}} KES</td>
                        <td>
                            <a href="{{url('view_receipts/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-primary">View Receipts</button>
                            </a>
                            <a href="{{url('view_invoices/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-warning">View Invoices</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
          
        </div>
        <div class="text-center d-flex justify-content-center">
        {{ $data['marketers']->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection