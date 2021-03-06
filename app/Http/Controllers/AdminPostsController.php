<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;


use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all();


        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories= Category::lists('name','id')->all();

        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //

        $input=$request->all();  //oznacavamo sve unesene podatke da povuce

        $user=Auth::user();  //logovanje usera

        if($file=$request->file('photo_id')){


            $name= time() . $file->getClientOriginalName();

            $file->move('images',$name);

            $photo= Photo::create(['file'=> $name]);
            $input['photo_id']= $photo->id;
        }



        $user->posts()->create($input);  //povezivanje preko veze koju sam napravila vec za spajanje user id sa postom
        return redirect('/admin/posts');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post=Post::findOrFail($id);

        $comments=$post->comments;

        return view('admin.comments.show',compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        $post=Post::findOrFail($id);
        $categories=Category::lists('name','id')->all();
        

        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $input=$request->all();

        if($file=$request->file('photo_id')){


            $name= time() . $file->getClientOriginalName();

            $file->move('images',$name);

            $photo= Photo::create(['file'=> $name]);
            $input['photo_id']= $photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);  //da nadjemo ulogovanog usera,njegov post

        return redirect('/admin/posts');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post=Post::findOrFail($id);

        unlink(public_path() . $post->photo->file);
        $post->delete();

        return redirect('/admin/posts');
    }


    public function post($id){

        $post= Post::findOrFail($id);

//        $comments=$post->comments()->whereIsActive(1)->get();  ne kapiram sto nece?? greske vezano za sql


        $comments=$post->comments();

    return view('post',compact('post','comments'));

    }
}
