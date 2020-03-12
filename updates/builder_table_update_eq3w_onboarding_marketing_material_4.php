<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingMarketingMaterial4 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->text('about')->nullable()->change();
            $table->text('companylogo')->nullable()->change();
            $table->text('customer_info')->nullable()->change();
            $table->text('customer_text')->nullable()->change();
            $table->text('practical_info')->nullable()->change();
            $table->text('remark')->nullable()->change();
            $table->text('slogan')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->text('about')->nullable(false)->change();
            $table->text('companylogo')->nullable(false)->change();
            $table->text('customer_info')->nullable(false)->change();
            $table->text('customer_text')->nullable(false)->change();
            $table->text('practical_info')->nullable(false)->change();
            $table->text('remark')->nullable(false)->change();
            $table->text('slogan')->nullable(false)->change();
        });
    }
}
