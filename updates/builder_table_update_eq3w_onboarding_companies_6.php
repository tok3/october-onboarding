<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingCompanies6 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->integer('onboarding_complete')->nullable()->default(0);
            $table->integer('locked')->nullable()->default(0);
            $table->integer('confirmed')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->dropColumn('onboarding_complete')->after('onboarding_code');
            $table->dropColumn('locked')>after('onboarding_code');
            $table->dropColumn('confirmed')>after('onboarding_code');
        });
    }
}
