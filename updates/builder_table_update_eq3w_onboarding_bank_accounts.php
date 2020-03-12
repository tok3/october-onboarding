<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingBankAccounts extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_bank_accounts', function($table)
        {
            $table->string('bic', 11)->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_bank_accounts', function($table)
        {
            $table->string('bic', 8)->change();
        });
    }
}
