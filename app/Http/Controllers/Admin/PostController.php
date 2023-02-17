<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Category;
use App\User;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //$this->middleware('role:post_manager|super_admin');
        $this->middleware('permission:edit_articles', ['only' => ['create','store','update','index'] ]);
        $this->middleware('permission:delete_articles', ['only' => ['delete'] ]);
        $this->middleware('permission:publish_articles', ['only' => ['publish'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles->contains(['super_admin'])){
            $posts = Post::orderBy('id', 'desc')->paginate(5);
        }else{
            $posts = Post::where('initiator_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
        }
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'         => 'required|string|min:2|max:50',
            'content'       => 'required|string|min:2',
            'picture'       => 'required|mimes:jpg,jpeg,png,JPG,PNG,JPEG|max:1024',
            'category_id'   => 'required',
        ]);

        $image = $this->saveImage($request);
        $slug = Str::slug($request->title);

        Post::create([
            'ref'           => uniqid(),
            'title'         => $request->title,
            'content'       => $request->content,
            'slug'          => $slug,
            'banner'        => $image,
            'category_id'   => $request->category_id,
            'initiator_id'  => Auth::user()->id,
        ]);

        return redirect()->route('post.index')->with('success', 'post created successfully');
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
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.posts.edit', compact('post','categories'));
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
        $this->validate($request,[
            'title'         => 'required|string|min:2|max:50',
            'content'       => 'required|string|min:2',
            'picture'       => 'nullable|mimes:jpg,jpeg,png,JPG,PNG,JPEG|max:1024',
            'category_id'   => 'required',
        ]);

        $post = Post::findOrFail($id);

        $image = $this->updateImage($post->banner, $request);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->banner = $image;
        //$post->status = $request->status == 'true' ? true : false;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('post.index')->with('success', 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('post.index')->with('success', 'post deleted successfully');
    }


    public function publish($id)
    {
        $post = Post::findOrFail($id);
        $post->validator_id = Auth::user()->id;
        $post->status ? $post->status = false : $post->status = true;
        $post->save();
        return redirect()->route('post.index')->with('success', 'post published successfully');
    }




    public function saveImage($request){

        $picture = "";
        if($request->hasfile('picture')){
            $image = $request->file('picture');
            $currentDate = Carbon::now()->toDateString();
            $picture = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads')){
                mkdir('uploads',0777,true);       
            }
            $image->move('uploads',$picture);
        }

        return $picture;
    }

    public function updateImage($previous_image, $request){

        $picture = $previous_image;
        $new_picture = "";
        if($request->hasfile('picture')){
            $image = $request->file('picture');
            $currentDate = Carbon::now()->toDateString();
            $new_picture = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads')){
                mkdir('uploads',0777,true);       
            }
            $image->move('uploads',$new_picture);
        }
        if($new_picture != ""){
            $picture = $new_picture;
        }

        return $picture;
    }
}
