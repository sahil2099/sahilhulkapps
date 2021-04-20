<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postsQry = Post::query()->with('user');
        $search = $request->input('search');
        if (!empty($search)){
            $postsQry->where('title', 'LIKE', '%'.$search.'%');
        }
        if($request->has(['sort','order'] ) && in_array($request->input('order'),['asc','desc']))
        {
            $postsQry->orderBy($request->input('sort'),$request->input('order'));
        }
        $postsQry->latest();
        $posts = $postsQry->paginate(3);
        return view('post.Index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.CreatePost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
        ]);

        if ($validator->fails()) {

            return redirect('posts')
                ->withErrors($validator)
                ->withInput();
        }

        $posts=Post::create([
            'uid'=>Auth::id(),
            'title' => $request->title,
            'slug' => \Str::slug($request->title)
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.CommentPage',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.EditPost',compact('post'));
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
        $posts=$request->validate([
            'title' => 'required',
        ]);
        Post::whereId($id)->update($posts);
        return redirect()->route('posts.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $id)
    {
        $id->delete();
        return back();
    }
}
