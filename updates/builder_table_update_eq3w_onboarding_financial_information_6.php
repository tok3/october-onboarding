<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation6 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('vat_to_disc')->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('vat_to_disc')->default(0)->change();
        });
    }
}
