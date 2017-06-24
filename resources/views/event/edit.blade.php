@extends('layouts.app')
<title>Edit Event</title>

@section('content')
    <div class="container">
        <h3>Edit Event</h3>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <br>


        {!! Form::model($event, ['method' => 'PATCH', 'action' =>[ 'EventController@update',$event->id],'class' => 'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name',['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::text('name', $event->name, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('location', 'Location',['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::text('location', $event->location, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('startDateTime', 'Start Date Time', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::input('date', 'startDate', Carbon\Carbon::instance(new DateTime($event->startDateTime))->toDateString(),
                ['class' => 'form-control']) !!}
                {!! Form::input('time', 'startTime', Carbon\Carbon::instance(new DateTime($event->startDateTime))->toTimeString(),
                ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('endDateTime', 'End Date Time', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::input('date', 'endDate', Carbon\Carbon::instance(new DateTime($event->endDateTime))->toDateString(),
                     ['class' => 'form-control']) !!}
                {!! Form::input('time', 'endTime', Carbon\Carbon::instance(new DateTime($event->endDateTime))->toTimeString(),
                 ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::submit('Save',['class' =>'btn btn-success']) !!}

            <button><a href="{{route('event.index')}}">Cancel</a></button>
        </div>

        {!! Form::close() !!}


        {!! Form::model($event, ['method' => 'DELETE', 'action' => ['EventController@destroy', $event->id], 'class' => 'form-group']) !!}

        {!! Form::submit('Delete',['class' =>'btn btn-danger']) !!}

        {!! Form::close() !!}
    </div>
@endsection