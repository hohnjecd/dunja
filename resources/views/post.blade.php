@extends('layouts.blog-post')



@section('content')





    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{asset($post->photo->file)}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->body}}</p>

    <hr>

    @if(Session::has('comment message'))

        {{session('comment message')}}

        @endif

    <!-- Blog Comments -->



    @if(Auth::check())

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentController@store']) !!}


        <input type="hidden" name="post_id" value="{{$post->id}}">


        <div class="form-group">

            {!! Form::label('body','Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control' , 'rows'=>3]) !!}


        </div>

        <div class="form-group">

        {!! Form::submit('Submit comment',['class'=>'btn btn-primary']) !!}

        </div>

        {!! Form::close() !!}

    </div>

    @endif


    <hr>

    <!-- Posted Comments -->

    @if(count($comments)>0)

        @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at}}</small>
            </h4>
            <p>{{$comment->body}}</p>


        @if(count($comment->replies)>0)

            @foreach($comment->replies as $reply)

            <!-- Nested Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{$reply->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$reply->author}}
                        <small>{{$reply->created_at}}</small>
                    </h4>
                   <p>{{$reply->body}}</p>
                </div>

                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                <div class="form-group">

                    <input type="hidden" name="comment_id" value="{{$comment->id}}">

                    {!! Form::label('body','Body:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}


                </div>

                <div class="form-group">

                {!! Form::submit('Reply',['class'=>'btn btn-primary']) !!}

                </div>


                {!! Form::close() !!}



            </div>
            <!-- End Nested Comment -->
@endforeach
            @endif
        </div>
    </div>

        @endforeach
    @endif

@endsection

    {{--<!-- Comment -->--}}
    {{--<div class="media">--}}
        {{--<a class="pull-left" href="#">--}}
            {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
        {{--</a>--}}
        {{--<div class="media-body">--}}
            {{--<h4 class="media-heading">Start Bootstrap--}}
                {{--<small>August 25, 2014 at 9:30 PM</small>--}}
            {{--</h4>--}}
            {{--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}

        {{--</div>--}}
    {{--</div>--}}


