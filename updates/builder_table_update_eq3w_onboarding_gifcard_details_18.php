<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails18 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->renameColumn('templ_provided', 'templ_provided_by');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->renameColumn('templ_provided_by', 'templ_provided');
        });
    }
}
