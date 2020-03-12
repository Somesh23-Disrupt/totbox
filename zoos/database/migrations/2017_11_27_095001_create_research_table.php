<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('book_code', '100')->unique();
            
            $table->unsignedInteger('research_masters_id');

            $table->unsignedInteger('research_status')->default(1);

            $table->foreign('research_masters_id')->references('id')->on('research_masters');
            $table->foreign('research_status')->references('id')->on('research_statuses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researches');
    }
}
