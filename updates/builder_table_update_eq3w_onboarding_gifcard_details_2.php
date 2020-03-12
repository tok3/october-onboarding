<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails2 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->text('dist_channel')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->text('dist_channel')->nullable(false)->change();
        });
    }
}
