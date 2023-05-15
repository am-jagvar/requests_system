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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('title');
            $table->text('descryption')->nullable();
            $table->tinyInteger('priority')->default(0);// 0 normal , 1 fory , 2 Ani
            $table->tinyInteger('supervisor_verify')->default(0);// 0 taeid nashode , 1 taeid shode
            $table->tinyInteger('admin_verify')->default(0);// 0 taeid nashode , 1 taeid shode
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
