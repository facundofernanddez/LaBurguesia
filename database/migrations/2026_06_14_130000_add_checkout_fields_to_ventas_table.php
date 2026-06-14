<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->string('metodo_entrega')->default('take_away')->after('usuario_id');
            $table->string('direccion')->nullable()->after('metodo_entrega');
            $table->string('forma_pago')->default('efectivo')->after('direccion');
            $table->integer('costo_envio')->default(0)->after('forma_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn(['metodo_entrega', 'direccion', 'forma_pago', 'costo_envio']);
        });
    }
};
