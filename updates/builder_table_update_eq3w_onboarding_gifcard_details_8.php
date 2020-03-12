<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails8 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('val_per_api')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->dropColumn('val_per_api');
        });
    }
}
