<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('company_id')->after('id');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->dropColumn('company_id');
        });
    }
}
