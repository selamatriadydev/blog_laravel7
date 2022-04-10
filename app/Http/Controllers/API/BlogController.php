<?php

namespace App\Http\Controllers\API;

use App\Banner;
use App\Category;
use App\Comment;
use App\CommnetUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogDetailResource;
use App\PostViews;
use App\Project;
use App\ProjectCategory;
use App\Skill;
use App\Tag;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts['article'] = Post::when($request->search, function ($query) use ($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
        })->with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->withCount('views')
                    ->published()
                    ->paginate(5);
        $posts['article_populer'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'views_count', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['article_terbaru'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'updated_at', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['category'] = Category::select('name')->withCount('posts')->get();
        $posts['tags'] = Tag::select('name')->withCount('posts')->get();
        $posts['archive'] = Post::select('title','slug','updated_at', DB::raw('COUNT(*) as count_row'), DB::raw('Year(updated_at) as grouptahun') )->groupBy(DB::raw('Year(updated_at)'))->orderBy(DB::raw('Year(updated_at)'),'DESC')->get();
        
        return response()->json($posts);
    } 
    public function portofolio()
    {
        $data['banner'] = Banner::select('title','body', 'file_path')->published()->get();
        $data['skill']  = Skill::with('skillDetail')->published()->get();
        $data['project']= Project::published()->get();
        $data['project_categori'] = ProjectCategory::get();
        return response()->json($data);
    }
    public function view_by_slug($slug, Request $request)
    {
        $post = Post::with('tags', 'category', 'user', 'comments')
                    ->where(['slug'=> $slug])
                    ->withCount('comments')
                    ->withCount('views')
                    ->first();
        if($post){
            //tambah views
            $viewer = new PostViews;
            $viewer->post_id = $post->id;
            $viewer->browser = $request->header('User-Agent');
            $viewer->ip = $request->ip();
            $viewer->save();
        }
        return response()->json($post);
    }
    public function view_by_category($category, Request $request)
    {
        $posts['article'] = Post::with('tags', 'category', 'user')
                    ->whereHas('category', function($query) use ($category) {
                        $query->where('name', $category);
                     })
                    ->withCount('comments')
                    ->withCount('views')
                    ->paginate(5);
        $posts['article_populer'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'views_count', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['article_terbaru'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'updated_at', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['category'] = Category::select('name')->withCount('posts')->get();
        $posts['tags'] = Tag::select('name')->withCount('posts')->get();
        $posts['archive'] = Post::select('title','slug','updated_at', DB::raw('COUNT(*) as count_row'), DB::raw('Year(updated_at) as grouptahun') )->groupBy(DB::raw('Year(updated_at)'))->orderBy(DB::raw('Year(updated_at)'),'DESC')->get();
        return response()->json($posts);
    }
    public function view_by_tag($tag, Request $request)
    {
        $posts['article'] = Post::with('tags', 'category', 'user')
                    ->whereHas('tags', function($query) use ($tag) {
                        $query->where('name', $tag);
                     })
                    ->withCount('comments')
                    ->withCount('views')
                    ->paginate(5);
        $posts['article_populer'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'views_count', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['article_terbaru'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'updated_at', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['category'] = Category::select('name')->withCount('posts')->get();
        $posts['tags'] = Tag::select('name')->withCount('posts')->get();
        $posts['archive'] = Post::select('title','slug','updated_at', DB::raw('COUNT(*) as count_row'), DB::raw('Year(updated_at) as grouptahun') )->groupBy(DB::raw('Year(updated_at)'))->orderBy(DB::raw('Year(updated_at)'),'DESC')->get();
        return response()->json($posts);
    }
    public function view_by_tahun($year, Request $request)
    {
        $posts['article'] = Post::with('tags', 'category', 'user')
                    ->where(DB::raw('Year(updated_at)'), $year)
                    ->withCount('comments')
                    ->withCount('views')
                    ->paginate(5);
        $posts['article_populer'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'views_count', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['article_terbaru'] = Post::with(['tags:name', 'category', 'user'] )
                    ->withCount('comments')
                    ->withCount('views')
                    ->orderBy( 'updated_at', 'DESC')
                    ->published()
                    ->limit(5)->get();
        $posts['category'] = Category::select('name')->withCount('posts')->get();
        $posts['tags'] = Tag::select('name')->withCount('posts')->get();
        $posts['archive'] = Post::select('title','slug','updated_at', DB::raw('COUNT(*) as count_row'), DB::raw('Year(updated_at) as grouptahun') )->groupBy(DB::raw('Year(updated_at)'))->orderBy(DB::raw('Year(updated_at)'),'DESC')->get();
        
        return response()->json($posts);
    }

    public function list_comment($post)
    {
        $posts = Comment::whereHas('post', function($query) use ($post) {
                        $query->where('id', $post);
                     })
                    ->get();
        
        return response()->json($posts);
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        return ['succes', 'Comment successfully created'];
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
                $post->comments()->create([
                    'body' => $request->body,
                    'comment_user_id' => $userComment,
                ]);
                return ['succes' => 'true','slug'=>$post->slug,'message'=> 'Comment successfully created'];
            }else{
                //buat user baru
                $userCommentCreate = new CommnetUser;
                $userCommentCreate->name = $request->nama;
                $userCommentCreate->email = $request->email;
                $userCommentCreate->website = $request->website ? $request->website : '';
                $userCommentCreate->save();
                $userComment = $userCommentCreate->id;
                $post->comments()->create([
                    'body' => $request->body,
                    'comment_user_id' => $userComment,
                ]);
                return ['succes' => 'true','slug'=>$post->slug,'message'=> 'Comment successfully created'];
            }

    }
}
