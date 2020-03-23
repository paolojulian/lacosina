<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('measurement');
            $table->string('optional_name')
                ->nullable()
                ->default(null)
                ->max(50);

            $table->string('description')
                ->default('')
                ->max(1000);

            $table->string('image')
                ->nullable()
                ->default(null);

            $table->bigInteger('recipe_id')
                ->unsigned();
            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
                ->onDelete('cascade');

            $table->bigInteger('ingredient_id')
                ->unsigned();
            $table->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients')
                ->onDelete('cascade');

            $table->timestamps();

            $table->index('recipe_id');
            $table->unique(['recipe_id', 'ingredient_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ingredients');
    }
}
