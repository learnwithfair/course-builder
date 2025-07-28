<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->date('order_date'); 
            $table->date('delivery_date'); 
            $table->string('po_number');
            $table->string('part_number');
            $table->string('revision')->nullable();
            $table->text('description')->nullable();
            $table->integer('qty')->default(0); 
            $table->double('unit_price',);
            $table->double('total_price',);
            $table->string('job_number')->nullable();
            $table->double('cost_per_unit')->nullable();
            $table->integer('stock_in_hand')->nullable();
            $table->string('stock_location')->nullable();
            $table->string('department')->nullable();
            $table->enum('job_status', [
                'Not Opened Yet',
                'In Process - Material Ordered',
                'In Process - Labour',
                'In Process - External Process',
                'Ready in Dispatch',
                'Delivered'
            ])->default('Not Opened Yet')->index();
            $table->timestamps();
            $table->string('file')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
