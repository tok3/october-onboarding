<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingFinancialInformation3 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->integer('disc_granted')->nullable()->default(0);
            $table->integer('payment_model')->nullable()->default(0);
            $table->string('credit_terms', 55)->nullable();
            $table->integer('vat_to_disc')->nullable()->default(0);
            $table->integer('vat_to_card')->nullable()->default(0);
            $table->integer('settlement_mode')->nullable()->default(0);
            $table->integer('payment_mode')->default(0);
            $table->string('remark', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_financial_information', function($table)
        {
            $table->dropColumn('disc_granted');
            $table->dropColumn('payment_model');
            $table->dropColumn('credit_terms');
            $table->dropColumn('vat_to_disc');
            $table->dropColumn('vat_to_card');
            $table->dropColumn('settlement_mode');
            $table->dropColumn('payment_mode');
            $table->dropColumn('remark');
        });
    }
}
