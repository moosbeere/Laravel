<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
<<<<<<< HEAD
    // use HasFactory;

    public function comments(){
        return $this->hasMany(ArticleComment::class,'article_id');
=======
    use HasFactory;

    public function comments(){
        return $this->hasMany(ArticleComment::class, 'article_id');
<<<<<<< HEAD
>>>>>>> comment:migrate, relationship
=======
>>>>>>> 22d6e2089f0bf144673c74c60e7df25ca7471209
    }
}
