<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        public function up(): void
        {
            Schema::create('purchases', function (Blueprint $table) {
                $table->id();
                $table->integer('customer_id');
                $table->string('title');
                $table->string('model')->nullable();
                $table->string('imei')->nullable();
                $table->boolean('is_pta')->default(0);
                $table->integer('user_id');
                $table->string('total_amount');
                $table->softDeletes();
                $table->timestamps();

//                0343-8506593 Easy Paisa
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('purchases');
        }
    };
