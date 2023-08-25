<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogs = Blog::all();

        return view('blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            return view('blogs.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'subTitle' => 'required|string|min:10',
            'image' => 'required|file',
            'description' => 'required|string|min:15'
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        $image = $request->file('image');

//        dd($image);
        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'blogs'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        // handle creator
        $newBlog = new Blog();
        $newBlog->title = $request->input('title');
        $newBlog->subTitle = $request->input('subTitle');
        $newBlog->description = $request->input('description');
        $newBlog->image = $imageName;
        $newBlog->save();
        //redirection to posts.index
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
//        $blog = Blog::findOrFail($id);
//        dd($blog);
        return view('blogs.show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
//        $blog = Blog::find($id);

        return response()->view("blogs.edit", [
            'blog' => $blog,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'subTitle' => 'required|string|min:10',
            'image' => 'required|file',
            'description' => 'required|string|min:15'
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        $image = $request->file('image');

//        dd($image);
        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'blogs'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        // handle creator
//        $blog = Blog::findOrFail($blogId);
        $blog->title = $request->input('title');
        $blog->subTitle = $request->input('subTitle');
        $blog->description = $request->input('description');
        $blog->image = $imageName;
        $blog->save();
        //redirection to posts.index
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
//        dd($id);
        $blog->delete();
        return to_route('blogs.index')
            ->with('success', 'blog deleted successfully');
    }
}
