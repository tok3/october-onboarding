<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingContacts extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_contacts', function($table)
        {
           $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('type');
                $table->integer('company_id');
                $table->string('firstname', 55);
                $table->string('lastname', 55);
                $table->string('position', 55)->nullable()->default('n/a');
                $table->string('email', 155)->nullable()->default('n/a');
                $table->string('phone', 55)->nullable()->default('n/a');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_contacts');
    }
}
