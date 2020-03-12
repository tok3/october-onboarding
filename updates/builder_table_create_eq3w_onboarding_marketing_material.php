<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEq3wOnboardingMarketingMaterial extends Migration
{
    public function up()
    {
        Schema::create('eq3w_onboarding_marketing_material', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('company_id');
            $table->text('slogan');
            $table->text('about');
            $table->text('practical_info');
            $table->text('customer_text');
            $table->text('customer_info');
            $table->text('remark');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eq3w_onboarding_marketing_material');
    }
}
