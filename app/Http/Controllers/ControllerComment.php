<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class ControllerComment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('post')->paginate(10);

        return view('admin.comment.list', compact('comments'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash("You can't delete other peoples comment.")->success();

            return redirect('/admin/posts');
        }

        $comment->delete();
        flash('Comment deleted successfully.')->success();

        return redirect('/admin/comments');
    }
}
