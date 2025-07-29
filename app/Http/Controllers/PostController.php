<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //post list
    public function index()
    {
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index', compact('category', 'post'));
    }

    //post create
    public function createPost(Request $request)
    {
        $validator = $this->postValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!empty($request->image)) {
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);

            $data = $this->getPostData($request, $fileName);
        } else {
            $data = $this->getPostData($request, NULL);
        }

        Post::create($data);
        return back();
    }

    //delete post
    public function deletePost($id)
    {
        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData['image'];
        Post::where('post_id', $id)->delete();
        if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
            File::delete(public_path() . '/postImage/' . $dbImageName);
        }
        return back();
    }

    //search post
    public function searchpost(Request $request)
    {
        $post = Post::where('title', 'LIKE', '%' . $request->postSearch . '%')->get();
        $category = Category::get();
        return view('admin.post.index', compact('post', 'category'));
    }

    //direct edit page
    public function editPost($id)
    {
        $postDetails = Post::where('post_id', $id)->first();
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.update', compact('postDetails', 'category', 'post'));
    }

    //update post
    public function updatePost($id, Request $request)
    {
        $validator = $this->postValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->updatePostData($request);

        if (isset($request->image)) {
            $this->storeUpdatePostData($id, $request, $data);
        } else {
            Post::where('post_id', $id)->update($data);
        }

        return back();
    }

    //update post data
    private function updatePostData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->categoryID
        ];
    }

    //get update post Data with image
    private function storeUpdatePostData($id, $request, $data)
    {
        //get from client
        $file = $request->file('image');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();

        //update image in data
        $data['image'] = $fileName;

        //get image name from db
        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData['image'];

        //delete image from public folder
        if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
            File::delete(public_path() . '/postImage/' . $dbImageName);
        }

        //store new image in public folder
        $file->move(public_path() . '/postImage', $fileName);

        Post::where('post_id', $id)->update($data);
    }

    //get post data
    private function getPostData($request, $fileName)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileName,
            'category_id' => $request->categoryID
        ];
    }

    //post validation
    private function postValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'categoryID' => 'required'
        ]);
    }
}
