<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostsResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request -> validated($request -> all());
        
        $post = Post::create([
            'user_id' => Auth::user() -> id,
            'name' => $request -> name,
            'headline' => $request -> headline,
            'text' => $request -> text,
            'location' => $request -> location,
            'picture' => $request -> picture
        ]);

        return new PostsResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostsResource($post); 
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
        if(!($this -> isNotAuthorised($post))){
            $post -> update($request -> all());
            return new PostsResource($post);
        }
        return $this -> isNotAuthorised($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $this -> isNotAuthorised($post) ? $this -> isNotAuthorised($post) : $post -> delete();
    }

    private function isNotAuthorised(Post $post){
        if(Auth::user() -> id !== $post -> user_id){
            return $this -> error('', 'Nemáte dostatečná práva provést tento request', 403);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myPosts()
    {
        return PostsResource::collection(
            Post::where( 'user_id', Auth::user() -> id ) -> get()
        );
    }
}
