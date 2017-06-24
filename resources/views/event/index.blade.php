@extends('layouts.app')
<title>Events</title>
@section('content')
    <h2 class="text-center">Events</h2>
    <div class="container">
        <div class="row">
            <a class="btn btn-primary" href="{{route('event.create')}}">Create event</a>
        </div>
        <br>
        <table class="table">
            <tr>
                <th class="col-md-3">Event name</th>
                <th class="col-md-2">Location</th>
                <th class="col-md-2">Start Date and Time</th>
                <th class="col-md-2">End Date and Time</th>
                <th class="col-md-1"></th>
                <th class="col-md-2"></th>
            </tr>

            @foreach($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->location}}</td>
                    <td>{{$event->startDateTime}}</td>
                    <td>{{$event->endDateTime}}</td>
                    <td><a class="btn btn-xs" href="{{route('event.edit',$event->id)}}">Edit</a></td>
                    <td>
                        {!! Form::model($event, ['method' => 'DELETE', 'action' => ['EventController@destroy', $event->id] ]) !!}
                        {!! Form::submit('Delete',['class' =>'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection