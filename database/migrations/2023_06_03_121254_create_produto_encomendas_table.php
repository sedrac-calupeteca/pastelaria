<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_encomenda', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->integer('quantidade_produto')->unsigned()->default(1);
            $table->double('preco')->unsigned()->default(0);
            $table->double('total')->unsigned()->default(0);
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->foreignId('encomenda_id')->constrained('encomendas')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['produto_id','encomenda_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_encomendas');
    }
};
