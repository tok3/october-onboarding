<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingCompanies2 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->string('onboarding_code', 55);
            $table->integer('onboarding_complete')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->dropColumn('onboarding_code');
            $table->dropColumn('onboarding_complete');
        });
    }
}
