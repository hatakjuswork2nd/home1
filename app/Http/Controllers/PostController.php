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
        $posts=Post::orderBy('created_at','desc')->get();//モデル名::all() ：モデルに紐づいたデータベースのデータを全て取得。order順番。desc(descend)降りる
        $user=auth()->user();//auth()->user() ：ログイン中のユーザーを表す
        return view('post.index', compact('posts', 'user'));//view('ルート名', compact(変数名）)：表示する画面に変数を受け渡す。compact('posts', 'user') と入れると、['posts' => $posts, 'user' => $user]
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
        if (request('image')){//「もし送信されたデータの中にimageがあれば、次の処理を行う
            $original = request()->file('image')->getClientOriginalName();//① 元々のファイル名を取得し、これを$originalに代入する
            $name = date('Ymd_His').'_'.$original;//日時秒と$originalを統合して$nameに代入
            request()->file('image')->move('storage/images', $name);//② $nameの名前で画像ファイルを指定した場所に保存する
            $post->image = $name;//$post->image はpostsテーブルのimageカラム。③ $nameの名前で画像ファイルのファイル名をデータベースに保存する
        }
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
        return view('post.show', compact('post'));
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
