@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<!-- Content start -->
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        @if(!empty($user))
                    {!! Form::model($user, ['url' => url('/users/'.$user->id), 'method' => 'PUT']) !!}
                @else
                    {!! Form::open(['url' => url('/users/add'), 'method' => 'POST']) !!}
                @endif
            <div class="row">
                
                <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                    
                        <fieldset class="form-group">
                            {!! Form::label('Name', []) !!}*
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </fieldset>
                        <fieldset class="form-group">
                            {!! Form::label('Email', []) !!}*
                            {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                        </fieldset>
                        <fieldset class="form-group">
                            {!! Form::label('Mobile ', []) !!}*
                            {!! Form::tel('mobile', null, ['class' => 'form-control', 'required']) !!}
                        </fieldset>
                        <fieldset class="form-group">
                            {!! Form::label('Password', []) !!}*
                            {!! Form::password('password', null, ['class' => 'form-control', 'required','type' => 'password']) !!}
                        </fieldset>
                        <fieldset class="form-group">
                            {!! Form::label('Confirm Password', []) !!}*
                            {!! Form::password('password_confirmation', null, ['class' => 'form-control', 'required','type' => 'password']) !!}
                        </fieldset>
                        {!! Html::link(url('/users'), 'Cancel', ['class' => 'btn btn-primary right']) !!}
                        <button type="submit" class="btn btn-primary left">Submit</button>
                    
                </div>
                
            </div><!-- end row -->
            {!! Form::close() !!}
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
@endsection