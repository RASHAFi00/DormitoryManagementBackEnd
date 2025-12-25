<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treasury', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->nullable()->constrained()->onDelete("set null");
            $table->boolean("income")->default(false);
            $table->double("amount");
            $table->text("description")->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treasury');
    }
};
