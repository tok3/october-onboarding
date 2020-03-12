<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingCompanies extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_companies', function($table)
        {
           $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('address')->nullable();
                $table->string('address_2')->nullable();
                $table->string('postcode')->nullable();
                $table->string('city')->nullable();
                $table->string('company_no')->nullable();
                $table->string('vat_no')->nullable();
                $table->string('iban', 34)->nullable();
                $table->string('swift', 11)->nullable();
                $table->string('bic', 8)->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_companies');
    }
}
