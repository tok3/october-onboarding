<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingContactTypes extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_contact_types', function($table)
        {
            $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('description')->nullable()->default('n/a');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_contact_types');
    }
}
