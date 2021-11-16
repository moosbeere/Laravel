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
>>>>>>> comment:migrate, relationship
    }
}
