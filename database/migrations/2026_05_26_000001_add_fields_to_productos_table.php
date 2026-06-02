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
        Schema::table('productos', function (Blueprint $table) {
            $table->string('nombre')->after('id');
            $table->text('descripcion')->nullable()->after('nombre');
            $table->integer('precio')->default(0)->after('descripcion');
            $table->string('categoria')->after('precio');
            $table->string('imagen')->nullable()->after('categoria');
            $table->boolean('activo')->default(true)->after('imagen');
            $table->integer('stock')->default(0)->after('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn([
                'nombre',
                'descripcion',
                'precio',
                'categoria',
                'imagen',
                'activo',
                'stock',
            ]);
        });
    }
};
