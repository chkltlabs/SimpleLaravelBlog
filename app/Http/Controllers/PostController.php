<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    /**
     * PostController constructor.
     *
     * Sets authorization protection on the Create Edit and Delete routes to protect content from being edited or removed by users who did not create it, or created by users who are not registered
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'delete']);
    }

    /**
     * Used to return all posts by a particular user_id passed into the url
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allPosts($id){
        $posts = BlogPost::all();
        $users = User::all();
        $output = array();
        foreach ($posts as $post){
            if($post->user_id == $id){
                array_push($output, $post);
            }
        }

        if(count($output) > 0) {
            return view('blog')
                ->with('blog_posts', $output)
                ->with('users', $users);
        } else {
            return redirect()->route('posts.index');
        }
    }

    /**
     * Returns posts with truncated body text if the body text exceeds a certain length
     * @return BlogPost[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fixedPosts(){
        $posts = BlogPost::all();
        foreach ($posts as $post){
            if(strlen($post->body) > 500){
                $post->body = substr($post->body, 0, 490) . '...';
            }
        }
        return $posts;
    }

    /**
     * Homepage for viewing all posts in creation order.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        $posts = $this->fixedPosts();
        return view('blog')
            ->with('blog_posts', $posts)
            ->with('users', $users);
    }

    /**
     * Blog Creation Page, Auth required in __construct()
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Logic for creation and storage of a new Post object, receives the Request object automatically
     *
     * @param Request $request
     * @return mixed
     */
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

    /**
     * Shows a single post and all its details
     *
     * @param $post_id
     * @return mixed
     */
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

    /**
     * Post edit page, Auth required in __construct()
     *
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Logic for editing and storage of an existing Post object, receives the Request object automatically
     *
     * @param Request $request
     * @param $post_id
     * @return mixed
     */
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

    /**
     * Post deletion logic, protected by an alert in js/app.js, and Auth match required in __construct()
     *
     * @param $post_id
     * @return mixed
     */
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
