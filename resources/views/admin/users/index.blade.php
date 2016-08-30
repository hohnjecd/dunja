@extends('layouts.admin')



@section('content')


    @if(Session::has('deleted_user'))

        <p class="bg-danger">{{session('deleted_user')}}</p>

        @endif

    @if(Session::has('created_user'))
        <p>{{session('created_user')}}</p>
        @endif

    <h1>Users</h1>

    <table class="table">
        <thead>
          <tr>
              <th>Id</th>
              <th>Photo</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Created</th>
              <th>Updated</th>

          </tr>
        </thead>

        <tbody>

        @if($users)
            @foreach($users as $user)

          <tr>
              <td>{{$user->id}}</td>
              <td><img height="50" src="{{asset($user->photo ? $user->photo->file : 'http://placehold.it/400x400')}}"   alt=""></td> <!-- obavezno sa asset i zatim komanda za izvlacenje iz baze!! -->
              <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->role->name}}</td>
              <td>{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td> <!-- da proverimo da li je aktivan -->
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>

          </tr>

          @endforeach

            @endif


        </tbody>
      </table>




    @endsection