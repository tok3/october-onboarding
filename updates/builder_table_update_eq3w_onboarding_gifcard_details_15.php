<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails15 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->decimal('min_req_val', 8, 2)->default(0.00)->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->decimal('min_req_val', 8, 2)->default(null)->change();
        });
    }
}
