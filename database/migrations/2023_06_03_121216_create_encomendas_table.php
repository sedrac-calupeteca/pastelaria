<?php

use App\Utils\EncomendaUtil;
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
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_encomenda',EncomendaUtil::keysTiposEncomendas());
            $table->timestamp('tempo_entrega');
            $table->string('local_entrega');
            $table->string('file')->nullable();
            $table->boolean('foi_comprado')->default(false);
            $table->boolean('atendido')->default(false);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
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
        Schema::dropIfExists('encomendas');
    }
};
