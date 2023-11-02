<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    var $fillable = ['reference', 'quantity', 'nota'];

    protected $attributes = [
        'quantity' => 0,
    ];


    public function stockCount()
    {
        return Article::sum("quantity");
    }

    public static function incrementQuantity($id)
    {
        // NOn foonctionnel
        $article = Article::find($id);
        $article->quantity++;
        $article->save();
    }

    /*
    public function increment()
    {
        $this->increment('quantity', 1);
        $this->save();
    }*/


    protected static function boot()
    {
        parent::boot();

        // Écoute l'événement de suppression du modèle
        static::deleting(function ($article) {
            // Vérifiez la condition, par exemple, si la quantité n'est pas égale à zéro, empêchez la suppression
            if ($article->quantity !== 0) {
                return false;
                // Empêchez la suppression en lançant une exception, en affichant un message, etc.
                //throw new \Exception("L'article ne peut pas être supprimé car la quantité n'est pas égale à zéro.");
            }
        });
    }

}
