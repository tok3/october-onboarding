<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation11 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->dropColumn('pay_upfront');
            $table->dropColumn('pay_commission');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('pay_upfront')->nullable()->default(0);
            $table->integer('pay_commission')->nullable()->default(0);
        });
    }
}
