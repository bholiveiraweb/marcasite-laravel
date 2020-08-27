<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('constructions_address');
            $table->decimal('proposal_total', 8, 2);
            $table->decimal('entry_amount', 8, 2);
            $table->integer('installment_qty');
            $table->decimal('installment_amount', 8, 2);
            $table->date('payment_starts');
            $table->integer('installment_date');
            $table->string('file')->nullable();
            $table->tinyInteger('status')->index();
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
        Schema::dropIfExists('proposals');
    }
}
