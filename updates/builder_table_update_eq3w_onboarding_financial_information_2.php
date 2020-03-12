<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation2 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('mod_global')->default(0);
            $table->decimal('disc_global', 4, 2)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->dropColumn('mod_global');
            $table->dropColumn('disc_global');
        });
    }
}
