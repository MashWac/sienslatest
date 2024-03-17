@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header text-center">
        <h2> Pending Messages</h2>
    </div>
</div>
<div class="card">
    @foreach($data['newmessages'] as $item)
    <div class="card text-center" style="margin: 3%;">
        <div class="card-header">
            <h5 class=""><b>Client Name:</b> {{$item->firstname}} {{$item->surname}}</h5>
            <h5 class=""><b>Client Email:</b>  {{$item->email}}</h5>
            <h5 class=""><b>Client Phone:</b>  {{$item->telephone}}</h5>

        </div>
        <div class="card-body  text-center">
            <p class="card-text">" {{$item->question}} "</p>
            <form method="POST" action="{{url('sendingquery')}}">
                @csrf
                <input type="hidden" value="{{$item->message_id}}" name="messageid">
                <button type="submit" class="btn btn-primary show_confirm_two" data-toggle="tooltip" title='Delete'>Confirm Solved</button>
            </form>
        </div>
        <div class="card-footer text-muted text-center">
         <h6>{{$item->created_at}}</h6>
        </div>
    </div>
    @endforeach
    <div class="text-center d-flex justify-content-center">
        {{ $data['newmessages']->links('pagination::bootstrap-4') }}
    </div>
</div>
<div class="card">
    <div class="card-header text-center">
        <h2> Serviced Messages</h2>
    </div>
</div>
<div class="card">
    @foreach($data['oldmessages'] as $item)
    <div class="card text-center" style="margin: 3%;">
        <div class="card-header">
            <h5 class=""><b>Client Name:</b> {{$item->firstname}} {{$item->surname}}</h5>
            <h5 class=""><b>Client Email:</b>  {{$item->email}}</h5>
            <h5 class=""><b>Client Phone:</b>  {{$item->telephone}}</h5>

        </div>
        <div class="card-body  text-center">
            <p class="card-text">" {{$item->question}} "</p>
        </div>
        <div class="card-footer text-muted text-center">
         <h6>{{$item->created_at}}</h6>
        </div>
    </div>
    @endforeach
    <div class="text-center d-flex justify-content-center">
        {{ $data['oldmessages']->links('pagination::bootstrap-4') }}
    </div>
</div>


@endsection