<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * This function appears to be responsible for displaying a list of blogs.
     */
    public function index()
    {
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
     * This function appears to be responsible for storing a new blog post.
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
            return Redirect::back()->withErrors($validator->errors());
        }
        $image = $request->file('image');

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
     * This show function is responsible for displaying a specific blog post.
     */
    public function show(Blog $blog)
    {
        //
        $blog = Blog::findOrFail($blog->id);
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
     * This update function is responsible for updating an existing blog post.
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
            return Redirect::back()->withErrors($validator->errors());
        }
        $image = $request->file('image');

        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'blogs'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        // handle creator
        $blog->title = $request->input('title');
        $blog->subTitle = $request->input('subTitle');
        $blog->description = $request->input('description');
        $blog->image = $imageName;
        $blog->save();
        //redirection to posts.index
        return redirect()->route('blogs.index');
    }

    /**
     * This destroy function is responsible for deleting a specific blog post.
     */
    public function destroy(Blog $blog)
    {
        //
        $blog->delete();
        return to_route('blogs.index')
            ->with('success', 'blog deleted successfully');
    }
}
