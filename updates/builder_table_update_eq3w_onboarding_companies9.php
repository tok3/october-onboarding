<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingCompanies9 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->string('account_number')->after('bank_name');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->dropColumn('account_number');
        });
    }
}