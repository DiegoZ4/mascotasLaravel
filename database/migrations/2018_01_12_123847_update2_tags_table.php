<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update2TagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_tag', function (Blueprint $table) {
          //drop the old constraint
          $table->dropForeign(['article_id']);
          //create new constraint with ON CASCADE
          $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_tag', function (Blueprint $table) {
           //drop new constraint with ON CASCADE
           $table->dropForeign('article_id');
           //recreate the old constraint
           $table->foreign('article_id')->references('id')->on('articles');
         });
    }
}
