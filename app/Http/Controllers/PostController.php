<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit']);
    }

    public function all($id){
        $posts = BlogPost::all();
        $users = User::all();
        $output = array();
        foreach ($posts as $post){
            if($post->user_id == $id){
                array_push($output, $post);
            }
        }


        return view('blog')
            ->with('blog_posts', $output)
            ->with('users', $users);
    }

    public function fixedPosts(){
        $posts = BlogPost::all();
        foreach ($posts as $post){
            if(strlen($post->body) > 500){
                $post->body = substr($post->body, 0, 490) . '...';
            }
        }
        return $posts;
    }

    public function index()
    {
        $users = User::all();

        $posts = $this->fixedPosts();
        return view('blog')
            ->with('blog_posts', $posts)
            ->with('users', $users);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'body'  => 'required'
        );

        $request->validate($rules);

        $post  = new BlogPost();
        $title = $request->get('title');
        $body  = $request->get('body');
        $post->title = $title;
        $post->user_id = $request->user()->id;
        $post->body = $body;
        $post->save();
        return redirect('/')->withMessage('Post Successful!');
    }

    public function show($post_id)
    {
        $post = BlogPost::findOrFail($post_id);
        $user = User::findOrFail($post->user_id);

        $origCreateDate = date("F d, Y", strtotime(substr($post->created_at, 0, 10)));
        $origUpdateDate = date("F d, Y", strtotime(substr($post->updated_at, 0, 10)));

        return view('show')
            ->with('post', $post)
            ->with('createdate', $origCreateDate)
            ->with('updatedate', $origUpdateDate)
            ->with('user', $user);
    }

    public function edit($post_id)
    {
        $post = BlogPost::findOrFail($post_id);
        if(Auth::id() == $post->user_id) {

            return view('edit')
                ->with('post', $post);
        }else{

            return redirect()->route('posts.index')->withWarning("Thats not your post, mate.");
        }

    }

    public function update(Request $request, $post_id)
    {
        $post = BlogPost::findOrFail($post_id);
        if(Auth::id() == $post->user_id) {
            $rules = array(
                'title' => 'required',
                'body'  => 'required'
            );
            $request->validate($rules);
            $title = $request->get('title');
            $body  = $request->get('body');
            $post->title = $title;
            $post->user_id = 1;
            $post->body = $body;
            $post->update();
            return redirect('/')->withMessage('Update Successful!');
        }else{
            return redirect('/')->withWarning("Thats not your post, mate.");
        }

    }

    public function destroy($post_id)
    {
        $post = BlogPost::findOrFail($post_id);
        if(Auth::id() == $post->user_id) {
            $post->delete();
            return redirect()->route('posts.index')->withMessage('...and we shall never see it\'s like again. And now, it\'s watch has ended.');
        }else{
            return redirect('/')->withWarning("Thats not your post, mate.");
        }



    }


}
