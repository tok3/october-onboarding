<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingBankAccounts extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_bank_accounts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('company_id');
            $table->string('name', 255);
            $table->string('iban', 34);
            $table->string('bic', 8);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_bank_accounts');
    }
}
