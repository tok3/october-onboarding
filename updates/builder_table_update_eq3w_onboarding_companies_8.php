<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingCompanies8 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->string('bank_name')->nullable()->after('bank_account');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->dropColumn('bank_name');
        });
    }
}
