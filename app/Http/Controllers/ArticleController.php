<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public $stockCount = 0;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $a = new Article();
        return view('articles.create', ['article' => $a]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        Article::create($request->except('_token', '_method'));
        return redirect()->route('articles.index')->with('success', 'Article created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
        $article->update($request->except('_token', '_method'));
        return redirect()->route('articles.index');
    }

    public function stock(Request $request, Article $article)
    {
        //
        $article->increment('quantity', 1);
        return redirect()->route('articles.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $result = $article->delete();
        if ($result) {
            return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
        } else {
            return redirect()->route('articles.index')->withErrors('default', 'Article deleted error');
        }
    }
}
