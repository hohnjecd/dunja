@extends('layouts.admin')


@section('content')

    @if($comment)

        <h1>Comments</h1>


        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author:</th>
                <th>Email</th>
                <th>Comment:</th>
            </tr>
            </thead>
            <tbody>



                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post' ,$comment->post->id)}}">View Post</a></td>

                    <td>

                        @if($comment->is_active==1)

                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentController@update',$comment->id]]) !!}


                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">

                            {!! Form::submit('Un-approve',['class'=>'btn btn-success']) !!}  <!-- Da se ne odobri u zavisnosti od aktivnpsti (probaj nacin 2 ako ne prodje ovo!!-->

                            </div>

                            {!! Form::close() !!}

                        @else

                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentController@update',$comment->id]]) !!}


                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">

                                {!! Form::submit('Approve',['class'=>'btn btn-info']) !!}

                            </div>

                            {!! Form::close() !!}


                        @endif

                    </td>

                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentController@destroy',$comment->id]]) !!}



                        <div class="form-group">

                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}

                        </div>

                        {!! Form::close() !!}



                    </td>

                </tr>



            </tbody>
        </table>

@endif

        <h1 class="text-center">No Comments</h1>

@else

@endsection