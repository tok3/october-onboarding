<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingFinancialInformation extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_financial_information', function($table)
        {
             $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('card_name')->nullable()->default('n/a');
                $table->integer('mod_sales')->default(0);
                $table->integer('mod_engine')->default(0);
                $table->decimal('disc_sales', 4, 2)->nullable();
                $table->decimal('disc_engine', 4, 2)->nullable();
                $table->integer('pay_upfront')->nullable()->default(0);
                $table->integer('pay_commission')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_financial_information');
    }
}
