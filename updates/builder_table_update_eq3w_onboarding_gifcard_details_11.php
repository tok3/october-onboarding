<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails11 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('templ_provided')->nullable()->change();
            $table->integer('validity_starts_from')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('templ_provided')->nullable(false)->change();
            $table->integer('validity_starts_from')->nullable(false)->change();
        });
    }
}
