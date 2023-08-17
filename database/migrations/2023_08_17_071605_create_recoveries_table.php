<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        public function up(): void
        {
            Schema::create('recoveries', function (Blueprint $table) {
                $table->id();
                $table->integer('customer_id');
                $table->integer('purchase_id');
                $table->string('amount');
                $table->dateTime('due_date');
                $table->boolean('is_paid')->default(0);
                $table->dateTime('paid_on')->nullable();
                $table->integer('account_id')->nullable();
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('recoveries');
        }
    };
