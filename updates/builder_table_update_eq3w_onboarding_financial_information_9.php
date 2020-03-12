<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation9 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->decimal('disc_engine', 4, 2)->default(0.00)->change();
            $table->decimal('disc_global', 4, 2)->default(0.00)->change();
            $table->decimal('disc_sales', 4, 2)->default(0.00)->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->decimal('disc_engine', 4, 2)->default(null)->change();
            $table->decimal('disc_global', 4, 2)->default(null)->change();
            $table->decimal('disc_sales', 4, 2)->default(null)->change();
        });
    }
}
