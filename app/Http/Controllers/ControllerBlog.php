<?php

namespace App\Http\Controllers;

use App\Category;
use App\CommnetUser;
use Illuminate\Http\Request;
use App\Post;
use App\PostViews;
use App\Tag;
use Illuminate\Support\Facades\DB;

class ControllerBlog extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::when($request->search, function ($query) use ($request) {
            $search = $request->search;

            return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
        })->with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->withCount('views')
                    ->published()
                    ->limit(5)->get();

        return view('frontend.list', compact('posts'));
    }

    public function blog(Request $request)
    {
        $posts = Post::when($request->search, function ($query) use ($request) {
            $search = $request->search;

            return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
        })->with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->withCount('views')
                    ->published()
                    ->simplePaginate(5);
        $article_populer = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments') 
                    ->withCount('views')
                    ->orderBy( 'views_count', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $article_terbaru = Post::with(['tags:name', 'category', 'user'] ) 
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'updated_at', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $category = Category::select('name')->withCount('posts')->get();
        $tags = Tag::select('name')->withCount('posts')->get();
        $archive = Post::select('title','slug','updated_at', DB::raw('COUNT(*) as count_row'), DB::raw('Year(updated_at) as grouptahun') )->groupBy(DB::raw('Year(updated_at)'))->orderBy(DB::raw('Year(updated_at)'),'DESC')->get();
        return view('frontend.blog', compact('posts', 'article_populer', 'article_terbaru', 'category', 'tags', 'archive'));
    }

    public function view_by_slug($slug, Request $request)
    {
        // $post = $post->load(['comments.user', 'tags', 'user', 'category']); 
        // $post = Post::where(['slug'=> $slug])->with('comments.user', 'tags', 'user', 'category');
        // dd($post);
        
        $post = Post::with('tags', 'category', 'user')
                    ->where(['slug'=> $slug])
                    ->withCount('comments')
                    ->withCount('views')
                    ->first();
        //tambah views
        $viewer = new PostViews;
        $viewer->post_id = $post->id;
        $viewer->browser = $request->header('User-Agent');
        $viewer->ip = $request->ip();
        $viewer->save();
        return view('frontend.post', compact('post'));
    }
    public function view_by_category($category, Request $request)
    {
        $posts = Post::with('tags', 'category', 'user')
                    ->whereHas('category', function($query) use ($category) {
                        $query->where('name', $category);
                     })
                    ->withCount('comments')
                    ->withCount('views')
                    ->get();
        return view('frontend.list_group', compact('posts'));
    }
    public function view_by_tag($tag, Request $request)
    {
        $posts = Post::with('tags', 'category', 'user')
                    ->whereHas('tags', function($query) use ($tag) {
                        $query->where('name', $tag);
                     })
                    ->withCount('comments')
                    ->withCount('views')
                    ->get();
        return view('frontend.list_group', compact('posts'));
    }
    public function view_by_tahun($year, Request $request)
    {
        $posts = Post::with('tags', 'category', 'user')
                    ->where(DB::raw('Year(updated_at)'), $year)
                    ->withCount('comments')
                    ->withCount('views')
                    ->get();
        return view('frontend.list_group', compact('posts'));
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        flash('Comment successfully created')->success();

        return redirect("/blog/{$post->slug}");
    }
    public function comment_user_biasa(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);
        $this->validate($request, ['nama' => 'required']);
        $this->validate($request, ['email' => 'required']);
        //cari user, jika ada ambil id nya
            $commentUser = CommnetUser::where('email', $request->email)->count();
            if($commentUser > 0){
                $commentUser = CommnetUser::where('email', $request->email)->first();
                $userComment = $commentUser->id;
                // $post->comments()->create([
                //     'body' => $request->body,
                //     'comment_user_id' => $userComment,
                // ]);
                if($request->comment_id){
                    $post->comments()->create([
                        'parent_id' => $request->comment_id,
                        'body' => $request->body,
                        'comment_user_id' => $userComment,
                    ]);
                }else{
                    $post->comments()->create([
                        'body' => $request->body,
                        'comment_user_id' => $userComment,
                    ]);
                }
                flash('Comment successfully created')->success();
                return redirect("/blog/{$post->slug}?userComment={$userComment}");
            }else{
                //buat user baru
                $userCommentCreate = new CommnetUser;
                $userCommentCreate->name = $request->nama;
                $userCommentCreate->email = $request->email;
                $userCommentCreate->website = $request->website ? $request->website : '';
                $userCommentCreate->save();
                $userComment = $userCommentCreate->id;
                // $post->comments()->create([
                //     'body' => $request->body,
                //     'comment_user_id' => $userComment,
                // ]);
                if($request->comment_id){
                    $post->comments()->create([
                        'parent_id' => $request->comment_id,
                        'body' => $request->body,
                        'comment_user_id' => $userComment,
                    ]);
                }else{
                    $post->comments()->create([
                        'body' => $request->body,
                        'comment_user_id' => $userComment,
                    ]);
                }
                flash('Comment successfully created')->success();
                return redirect("/blog/{$post->slug}?userComment={$userComment}");
            }

    }

    public function about()
    {
        return view('frontend.about');
    }
}
