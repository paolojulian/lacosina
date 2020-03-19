<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_procedures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('optional_name')
                ->nullable()
                ->default(null)
                ->max(50);

            $table->text('description')->max(1000);

            $table->integer('duration_from_minute')
                ->nullable()
                ->default(null)
                ->default(null);
            $table->integer('duration_to_minute')
                ->nullable()
                ->default(null);

            $table->string('image')
                ->nullable()
                ->default(null);

            $table->bigInteger('recipe_id')
                ->unsigned();
            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
                ->onDelete('cascade');

            $table->bigInteger('procedure_id')
                ->unsigned();
            $table->foreign('procedure_id')
                ->references('id')
                ->on('ingredients')
                ->onDelete('cascade');

            $table->timestamps();

            $table->index('recipe_id');
            $table->unique(['recipe_id', 'procedure_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_procedures');
    }
}
