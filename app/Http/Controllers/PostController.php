<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
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
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',/**title：入力されているか・255文字までか */
            'body'=>'required|max:1000',/**body：入力されているか・255文字までか */
            'image'=>'image|max:1024'/**image：画像ファイル形式か・1024キロバイト（1メガバイト）以内か */
        ]);/**フォームから送信された内容を処理 */
        $post=new Post();  /*******postの新しいインスタンスを作る*/
        $post->title=$request->title;/** 新しい$postモデルの中のtitleを指します=フォームから投稿された件名（title）の中身*/
        $post->body=$request->body;
        $post->user_id=auth()->user()->id;/**３行目の$post->user_id には、投稿者のidが入るようにします。        auth()->user()->id とすると、認証済みのログイン中のユーザーのid が入ります。 */
        $post->save();/**新しく作成したインスタンスがデータベースに保存されます。 */
        return redirect()->route('post.create')->with('message', '投稿を作成しました');
        /**return redirect()->route('post.create');ルート名がpost.indexのページにリダイレクトするという意味です/

        /**戻りたい時はreturn back() */
        /**画像処理は後ほど記述 */

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
