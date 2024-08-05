<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('comment');
    }
    public function index(request $request): view{
      

        return $this->postsView($request->search ? ['search'=>$request->search]:[]);
    }


    public function postsByCategory(Category $category):View{
        // $posts = $tag->post()->latest()->paginate(10);
        return $this->postsView(['category'=> $category]);
    }
    public function postsByTag(Tag $tag):View{
        // $posts = $category->post()->latest()->paginate(10);

        return $this->postsView(['tag' => $tag]);
    }

    protected function postsView(array $filters):View{
         $posts = Post::filters($filters)->latest()->paginate(10);
        return view('posts.index',compact('posts'));
    }
    public function show(Post $post):View{
        return view('posts.show', compact('post'));
    }

    public function comment(Post $post, Request $request):RedirectResponse{
        $validated = $request->validate([
            'comment'=>['required','string','between:2,255'],
        ]);

        Comment::create([
            'content'=>$validated['comment'],
            'post_id'=>$post->id,
            'user_id'=>Auth::id(),
        ]);

        // $comment = new Comment();
        // $comment->content = $validated['comment'];
        // $comment->post_id = $post->id;
        // $comment->user_id = Auth::id();

        // $comment->save();
        // return back()->withStatus('Commentaire Publier');

        return back()->withStatus('Commentaire Publier');
    }

}
