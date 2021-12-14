<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_comments', function (Blueprint $table) {
            $table->integer('accept')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
     public function down()
    {
        //
    }
}
