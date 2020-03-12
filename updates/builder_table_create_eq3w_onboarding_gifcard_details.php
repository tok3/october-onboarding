<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingGifcardDetails extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255)->nullable();
            $table->text('dist_channel');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_gifcard_details');
    }
}
