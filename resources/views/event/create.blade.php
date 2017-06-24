@extends('layouts.app')
<title>Create Event</title>

@section('content')
    <div class="container">
        <h3>Create Event</h3>

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


        {!! Form::model($event, ['action' => 'EventController@store','class' => 'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::text('name', '', ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('location', 'Location', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::text('location', '', ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('startDateTime', 'Start Date Time', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::input('date', 'startDate', Carbon\Carbon::now(+3)->toDateString(), ['class' => 'form-control']) !!}
                {!! Form::input('time', 'startTime', Carbon\Carbon::now(+3)->toTimeString(), ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('endDateTime', 'End Date Time', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-6">
                {!! Form::input('date', 'endDate', Carbon\Carbon::now(+3)->toDateString(), ['class' => 'form-control']) !!}
                {!! Form::input('time', 'endTime', Carbon\Carbon::now(+3)->toTimeString(), ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Create',['class' =>'btn btn-success']) !!}
            <button class="btn"><a href="{{route('event.index')}}">Cancel</a></button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection