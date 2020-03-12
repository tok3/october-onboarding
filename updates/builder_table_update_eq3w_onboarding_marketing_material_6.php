<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingMarketingMaterial6 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->string('companylogo_org_name', 255)->nullable()->after('companylogo');
            $table->string('moodpicture_org_name', 255)->nullable()->after('moodpicture');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->dropColumn('companylogo_org_name');
            $table->dropColumn('moodpicture_org_name');
        });
    }
}
