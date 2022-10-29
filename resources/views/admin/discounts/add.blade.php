@extends('layouts.admin')

@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add Discount</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-discount')}}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="row">
                    <div class="col-md-6">
                        <label for="discountcode">Discount Code:</label>
                        
                        <input id="discountcode" type="text" class="form-control @error('discountcode') is-invalid @enderror" name="discountcode" value="{{ old('discountcode')}}" autocomplete="discountcode" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('discountcode')<strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="discountpercentage">Discount Percentage:</label>
                        <input type="number" class="form-control @error('discountpercentage') is-invalid @enderror" name="discountpercentage" id="descript"autocomplete="discountpercentage" autofocus value="{{ old('discountpercentage')}}"> 
                        <span class="invalid-feedback" role="alert">
                        @error('discountpercentage')<strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
            @else
            <div class="card">
                <div class="card-header">
                    <h4>Edit Discount</h4>
                </div>
                <div class="card-body">
            
                <form action="{{url('update-discount/'.$data['discount']->discount_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                <div class="col-md-6">
                        <label for="discountcode">Discount Code:</label> 
                        <input id="discountcode" type="text" class="form-control @error('discountcode') is-invalid @enderror" name="discountcode" value="{{ $data['discount']->discount_code }}" autocomplete="discountcode" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('discountcode')<strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="discountpercentage">Discount Percentage:</label>
                        <input id="discountpercentage" type="number" class="form-control @error('discountpercentage') is-invalid @enderror" name="discountpercentage" value="{{ $data['discount']->discount_percentage}}" autocomplete="discountpercentage" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('discountpercentage')<strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            @endif

        </div>
    </div>
@endsection