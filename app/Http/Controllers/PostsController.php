<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    public function index(Request $request){
      // $length = $request->input('length');
      // $orderBy = $request->input('column'); //Index
      // $searchValue = $request->input('search');
      //
      // $data = \DB::table('posts')
      //        ->select('*')
      //        ->where("title", "LIKE", "%$searchValue%")
      //        ->orWhere('content', "LIKE", "%$searchValue%")
      //        ->paginate($length);
      //
      // return new DataTableCollectionResource($data);
      $posts = Post::latest()->get();
      return response([
        'success' => true,
        'message' => 'Lists Semua Post',
        'data'    => $posts
      ],200);
    }

    public function store(Request $request){
      $validator = Validator::make($request->all(), [
        'title'   => 'required',
        'content' => 'required',
      ], [
        'title.required'    => 'Masukkan Title',
        'content.required'  => 'Masukkan Post',
      ]);
      if($validator->fails()){
        return response()->json([
            'success' => false,
            'message' => 'Silahkan Isi Bidang yang kosong',
            'data'    => $validator->errors()
        ],400);
      } else {
        $post = Post::create([
          'title'   => $request->input('title'),
          'content' => $request->input('content'),
        ]);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 400);
        }
      }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required' => 'Masukkan Title Post !',
                'content.required' => 'Masukkan Content Post !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $post = Post::whereId($request->input('id'))->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
            ]);


            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 500);
        }

    }

}