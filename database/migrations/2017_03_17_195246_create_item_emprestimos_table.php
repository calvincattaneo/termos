<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_emprestimos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("emprestimo_id")->unsigned();
            $table->foreign("emprestimo_id")->references("id")->on("emprestimos")->onDelete("cascade");
            $table->string("descricao");
            $table->date('entregue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_emprestimos');
    }
}
