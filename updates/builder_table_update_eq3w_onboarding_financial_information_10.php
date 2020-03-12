<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation10 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('mod_engine')->nullable()->change();
            $table->integer('mod_global')->nullable()->change();
            $table->integer('mod_sales')->nullable()->change();
            $table->integer('payment_mode')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('mod_engine')->nullable(false)->change();
            $table->integer('mod_global')->nullable(false)->change();
            $table->integer('mod_sales')->nullable(false)->change();
            $table->integer('payment_mode')->nullable(false)->change();
        });
    }
}
