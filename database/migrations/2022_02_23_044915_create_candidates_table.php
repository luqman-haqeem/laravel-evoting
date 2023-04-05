<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('election_id');
            $table->unsignedBigInteger('voter_id');
            $table->unsignedBigInteger('section_id');
            $table->text('candidate_image');

            $table->foreign('election_id')->references('id')->on('elections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('voter_id')->references('id')->on('voters')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('sections_id')->references('id')->on('sections');
            $table->text('motto');
            // $table->string('image',100);
            $table->softDeletes();
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
        Schema::dropIfExists('candidates');
    }
}
