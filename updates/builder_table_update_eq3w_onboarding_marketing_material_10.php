<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingMarketingMaterial10 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->text('cardimage_org_name')->nullable()->after('moodpicture_org_name');
            $table->text('cardimage')->nullable()->after('moodpicture_org_name');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->dropColumn('cardimage_org_name');
            $table->dropColumn('cardimage');
        });
    }
}
