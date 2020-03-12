<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingCompanies3 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->string('onboarding_code', 55)->nullable()->default('0')->change();
            $table->dropColumn('onboarding_complete');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_companies', function($table)
        {
            $table->string('onboarding_code', 55)->nullable(false)->default(null)->change();
            $table->integer('onboarding_complete')->nullable();
        });
    }
}
