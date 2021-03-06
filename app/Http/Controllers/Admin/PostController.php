<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Gate;
use Auth;
class PostController extends Controller
{
    // assign roles
    public function __construct()
    {
        $this->middleware('can:view_post',     ['only' => ['index', 'show','view']]);
        $this->middleware('can:create_post',   ['only' => ['create', 'store']]);
        // $this->middleware('can:edit_post',     ['only' => ['edit', 'update']]);
        // $this->middleware('can:delete_post',   ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy('id','desc')->get();
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('post.post',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.post_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:posts,name',
            ]);
            $post = Post::create([
                'name'=> $request['name'],
                'content'=> $request['content'],
                'created_by'=> $request['created_by'],
            ]);
            session()->flash('success',__('Post successfully Created'));
            return redirect()->route('admin.post.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            return view('post.post_show',compact('post'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        if (isset($post)) {   
            $user = User::where('id',$post->created_by)->first();

            if (! $user->canany(['update', 'edit_post'], $post)) {
                abort(403,"THIS ACTION IS UNAUTHORIZED.");
            }

            return view('post.post_edit',compact('post'));    

                    
        }else{
            session()->flash('failed',__('Data not Found!!!'));
            return redirect()->route('admin.post.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $post=Post::findOrFail($id);
            if(isset($post)){
                $user = User::where('id',$post->created_by)->first();
                //If Unauthorized User 
                if (!$user->canany(['update', 'edit_post'], $post)){
                    abort(403,"THIS ACTION IS UNAUTHORIZED.");
                }
    
                $request->validate([
                    'name' => 'required|unique:posts,name,'.$id,
                ]);
                $post->update([
                    'name'=>$request['name'],
                    'content'=>$request['content'],
    
                ]);
                session()->flash('success',__('Post successfully Updated !!'));
                return redirect()->back();
            }
            
        } catch (\Throwable $th) {
           throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            
            if(isset($post)){
                $user = User::where('id',$post->created_by)->first();
                if (!$user->canany(['delete', 'delete_post'], $post)){
                    abort(403,"THIS ACTION IS UNAUTHORIZED.");
                }
                $post->delete();
                session()->flash('success',__('Data deleted successfully'));
                return redirect()->route('admin.post.index');
            }

        } catch (\Throwable $th) {
            session()->flash('failed',__('Something Went wrong !!!'));
            return redirect()->route('admin.post.index');
        }
        
    }
}
