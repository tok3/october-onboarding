<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->dropColumn('card_name');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->string('card_name', 191)->nullable()->default('n/a');
        });
    }
}
