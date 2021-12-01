<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD


    public function article(){
        return $this->belongsTo(Articles::class);
    }
=======
>>>>>>> comments new model, controller, migrate
=======
=======
>>>>>>> 22d6e2089f0bf144673c74c60e7df25ca7471209
    public function article(){
        return $this->belongsTo(Articles::class);
    }

<<<<<<< HEAD
>>>>>>> comment:migrate, relationship
=======
>>>>>>> 22d6e2089f0bf144673c74c60e7df25ca7471209
}
