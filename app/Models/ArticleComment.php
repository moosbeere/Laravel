<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory;
<<<<<<< HEAD
<<<<<<< HEAD


    public function article(){
        return $this->belongsTo(Articles::class);
    }
=======
>>>>>>> comments new model, controller, migrate
=======
    public function article(){
        return $this->belongsTo(Articles::class);
    }

>>>>>>> comment:migrate, relationship
}
