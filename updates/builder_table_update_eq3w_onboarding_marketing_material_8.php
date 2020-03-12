<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingMarketingMaterial8 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->string('moodpicture_local_path', 255)->nullable();
            $table->string('companylogo_local_path', 255);
            $table->dropColumn('asfasdf');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_marketing_material', function($table)
        {
            $table->dropColumn('moodpicture_local_path');
            $table->dropColumn('companylogo_local_path');
            $table->bigInteger('asfasdf');
        });
    }
}
