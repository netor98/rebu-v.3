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
      Schema::create('deliveries', function (Blueprint $table) {
         $table->id();
         $table->foreignId('sale_id')->constrained()->onDelete('cascade');
         $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Repartidor
         $table->foreignId('delivery_agent_id')->constrained()->onDelete('cascade'); // Repartidor
         $table->string('address');
         $table->integer('status')->default(0); // Puedes usar una tabla `delivery_statuses` para más flexibilidad
         $table->timestamp('delivery_date')->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('deliveries');
   }
};
