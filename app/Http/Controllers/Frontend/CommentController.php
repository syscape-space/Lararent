<?php

namespace Corp\Http\Controllers\Frontend;

use Corp\Comment;
use Corp\Post;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Validator;
use Auth;
use App;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

	    $data = $request->except('_token','comment_post_ID','comment_parent');


	    $data['post_id'] = $request->input('comment_post_ID');
	    $data['parent_id'] = $request->input('comment_parent');

	    $validator = Validator::make($data,[

		    'post_id' => 'integer|required',
		    'parent_id' => 'integer|required',
		    'text' => 'string|required'

	    ]);


	    $validator->sometimes(['name','email'],'required|max:255',function($input) {

		    return !Auth::check();

	    });
	    $data['text'] = strip_tags($data['text']);

	    if($validator->fails()) {
		    return \Response::json(['error'=>$validator->errors()->all()]);
	    }

	    $user = Auth::user();
	    $data['email'] = (!empty($data['email'])) ? $data['email'] : $user->email;
	    $data['name'] = (!empty($data['name'])) ? $data['name'] : $user->name;
	    $data['site'] = (!empty($data['site'])) ? $data['site'] : '';

	    if($user && $user->isSuperAdmin()){
		    $data['status'] = 'published';
	    } else {
		    $data['status'] = 'pending';
	    }
	    $data['locale'] = App::getLocale();
	    $comment = new Comment($data);

	    if($user) {
		    $comment->user_id = $user->id;
	    }

	    $post = Post::find($data['post_id']);

	    $post->comments()->save($comment);

	    $comment->load('user');
	    $data['id'] = $comment->id;



	    $data['hash'] = md5($data['email']);

	  //  $view_comment = view(config('settings.theme').'.content_one_comment')->with('data',$data)->render();
	    $view_comment = '';
	    return \Response::json(['success' => TRUE,'comment'=>$view_comment,'data' => $data]);

	    exit();
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
    }
}
