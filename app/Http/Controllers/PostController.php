<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Image;

class PostController extends Controller
{

  public function __construct()
  {
    return $this->middleware('auth')->except(['index']);
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('post.index')->with(['posts' => Post::paginate()]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('post.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'title' => 'required|min:4|max:10_000|string',
      'body' => 'required|min:4|max:10_000|string'
    ]);

    $slug = str()->slug($data['title']);

    $post = Post::create([...$data, 'slug' => $slug]);

    if ($request->has('images')) {
      $images = $request->validate(['images.*' => 'nullable|image|mime:jpg,png,jpeg']);

      $processedImgs = [];
      $imageProps = [
        'imageable_id' => $post->id,
        'imageable_type' => $post::class,
        'user_id' => auth()->id(),
      ];

      foreach ($images as $image) {
        $imageName = time() . '-' . $image->extension();
        $image->storeAs('uploads', $imageName, 'public');

        $imageProps['image'] = $imageName;
        array_push($processedImgs, $imageProps);
      }

      Image::insert($processedImgs);
    }

    return redirect()->route('post.show', $post->id);
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    return view('post.show', $post->id);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
    return view('post.edit', $post->id);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
    abort_if($post->id !== auth()->id() || auth()->user->is_admin === false, 403, 'Only admin can edit other users posts');

    $formData = $request->validate([
      'title' => 'required|min:4|max:10_000|string',
      'body' => 'required|min:4|max:10_000|string'
    ]);

    $slug = '';
    $data = [...$formData];

    if ($request->has('title')) {
      $slug = str()->slug('title');
      $data['slug'] = $slug;
    }

    $post->update(
      $data
    );

    if ($request->has('images')) {
      $images = $request->validate(['images.*' => 'nullable|image|mime:jpg,png,jpeg']);

      $processedImgs = [];
      $imageProps = [
        'imageable_id' => $post->id,
        'imageable_type' => $post::class,
        'user_id' => auth()->id(),
      ];

      foreach ($images as $image) {
        $imageName = time() . '-' . $image->extension();
        $image->storeAs('uploads', $imageName, 'public');

        $imageProps['image'] = $imageName;
        array_push($processedImgs, $imageProps);
      }

      Image::insert($processedImgs);
    }

    return redirect()->route('post.show', $post->id);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    abort_if($post->id !== auth()->id() || auth()->user->is_admin === false, 403, 'Only admin can delete other users posts');
    $post->delete();
    return redirect()->route('post.index');
  }
}
