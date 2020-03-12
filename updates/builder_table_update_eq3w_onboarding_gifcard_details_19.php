<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails19 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->string('max_denom')->nullable()->after('redeem_per_trans');
            $table->string('min_denom')->nullable()->after('redeem_per_trans');
            $table->integer('fixed_denom')->nullable()->after('redeem_per_trans');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->dropColumn('max_denom');
            $table->dropColumn('min_denom');
            $table->dropColumn('fixed_denom');
        });
    }
}
