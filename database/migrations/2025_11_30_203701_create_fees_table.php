<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->constrained()->onUpdate("cascade");
            $table->foreignId("treasury_id")->nullable()->constrained()->onUpdate("cascade")->onDelete("set null")->default(null);
            $table->enum("type" , ["registeration" , "punishment"]);
            $table->integer("cost")->check("amount > 0");
            $table->string("process_number")->nullable()->unique()->default(null);
            $table->boolean("paid")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
