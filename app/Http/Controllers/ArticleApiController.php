<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    public function destroy(Article $article)
    {
        $sucess = $article->delete();
        if ($sucess) {
            return response()->json(['success' => 'success'], 200);
        } else {
            return response()->json(['error' => 'Stock must be 0 before deletion'], 422);
        }
    }

}
