@extends('layouts.admin')



@section('content')


    <h1>Edit User</h1>


    <div class="row">

    <div class="col-sm-3">

        <img src="{{asset($user->photo ? $user->photo->file : 'http://placehold.it/400x400')}}" alt="" class="img-responsive img-rounded">



    </div>


    <div class="col-sm-9">

            {!! Form::model($user,['method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}

            <div class="form-group">

                {!! Form::label('name','Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}


            </div>

            <div class="form-group">

                {!! Form::label('email','email:') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}


            </div>

            <div class="form-group">

                {!! Form::label('role_id','Role:') !!}
                {!! Form::select('role_id',[''=>'Choose Options']+ $roles , null, ['class'=>'form-control']) !!}


            </div>

            <div class="form-group">

                {!! Form::label('is_active','Status:') !!}
                {!! Form::select('is_active', array(1=>'Active',0=>'Not active'),null, ['class'=>'form-control']) !!}


            </div>

            <div class="form-group">

                {!! Form::label('photo_id','Photo:') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}


            </div>


            <div class="form-group">

                {!! Form::label('password','Password:') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}


            </div>

            <div class="form-group">

                {!! Form::submit('Edit User',['class'=>'btn btn-primary']) !!}

            </div>

            {!! Form::close() !!}

        </div>

         </div>

    <div class="row">
    @include('includes.form_error')  <!-- fajl za greske ubacujemo-bolja varijanta da odvojino sve i samo zovemo po potrebi -->
        </div>




@endsection