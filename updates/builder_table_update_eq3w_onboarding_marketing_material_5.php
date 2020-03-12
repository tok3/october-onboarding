<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingMarketingMaterial5 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->text('moodpicture')->nullable()->after('companylogo');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->dropColumn('moodpicture');
        });
    }
}
