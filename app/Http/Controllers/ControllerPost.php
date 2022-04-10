<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Cache;
class ControllerPost extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags', 'comments'])->paginate(10);
        return view('admin.post.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::pluck('name', 'name')->all();
        return view('admin.post.add', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'title'       => $request->title,
            'slug'       => Str::slug($request->title, '-'),
            'file_path'       => $request->file('image') ? $request->file('image')->store('images') : 'null',
            'preview' => $request->preview,
            'body'        => $request->body ? $request->body : 'kosong',
            'category_id' => $request->category,
            'is_published' => $request->status ? $request->status : '0',
        ]);
        if($request->tags){
            $tagList = explode(",", $request->tags);
            // $tagsId = collect($tagList)->each(function ($tag) {
            //   return   Tag::firstOrCreate(['name' => $tag])->id;
            // });
            // $post->tags()->attach($idTags);
            // $idTags = array();
            foreach($tagList as $tag)
            {
                Tag::firstOrCreate(['name' => $tag]);
                $idTags = Tag::where('name', $tag)->pluck('id')->all();
                $post->tags()->attach($idTags);
            }
        }
        flash('Post created successfully.')->success();

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = $post->load(['user', 'category', 'tags', 'comments']);
        
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) 
    {
        if ($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash("You can't edit other peoples post.")->success();

            return redirect('/admin/posts');
        }

        $categories = Category::all();
        // $tags = Tag::pluck('name', 'name')->all();
        $tags = Tag::pluck('name')->all();
        $tags = implode(',',$tags);
        // dd($post);
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        Cache::forget($post->etag);

        $post->update([
            'title'       => $request->title,
            'slug'       => Str::slug($request->title, '-'),
            'file_path'       => $request->file('image') ? $request->file('image')->store('images') : $post->file_path,
            'preview' => $request->preview,
            'body'        => $request->body,
            'category_id' => $request->category,
            'is_published' => $request->status ? $request->status : '0',
        ]);

        // $tagsId = collect($request->tags)->map(function ($tag) {
        //     return Tag::firstOrCreate(['name' => $tag])->id;
        // });

        // $post->tags()->sync($tagsId);
        if($request->tags){
            $tagList = explode(",", $request->tags);
            foreach($tagList as $tag)
            {
                Tag::firstOrCreate(['name' => $tag]);
                $idTags = Tag::where('name', $tag)->pluck('id')->all();
                $post->tags()->sync($idTags);
            }
        }
        flash('Post updated successfully.')->success();

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(Post $post)
    {
        $post->is_published = ! $post->is_published;
        $post->save();
        flash('Post changed successfully.')->success();

        return redirect('/admin/posts');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash("You can't delete other peoples post.")->success();

            return redirect('/admin/posts');
        }

        $post->delete();
        flash('Post deleted successfully.')->success();

        return redirect('/admin/posts');
    }
}
