<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  public function welcome()
  {
    return view('welcome');
  }

  public function store(Request $request) {

    $tmp_file = TemporaryFile::where('folder', $request -> image)->first();

    if($tmp_file) {
      Storage::copy('public/posts/tmp/' . $tmp_file -> folder . '/' . $tmp_file -> file, 'public/posts/' . $tmp_file -> folder . '/' . $tmp_file -> file);

      Post::create([
        'name' => $request -> name,
        'image' => $tmp_file->folder . '/' . $tmp_file -> file_name
      ]);

      Storage::deleteDirectory('posts/tmp/' .$tmp_file -> folder);
      $tmp_file -> delete();
      return redirect('/') -> with('success', 'Post created');
    }
    return redirect('/') -> with('danger', 'please upload an image.');
  }

  public function tmpUpload(Request $request) {
    if($request -> hasFile('image')) {
      $image = $request -> file('image');
      $file_name = $image -> getClientOriginalName();  
      $folder = uniqid('post', true);
      $image -> storeAs('public/posts/tmp/'. $folder, $file_name); 
      // use TemporaryFile::insert if still not working
      TemporaryFile::insert([
        'folder' => $folder,
        'file' => $file_name
      ]); 
      return $folder; 
    }
    return '';
  }
}


