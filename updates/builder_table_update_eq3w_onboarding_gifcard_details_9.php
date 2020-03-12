<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails9 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('pin_on_card')->nullable();
            $table->integer('pin_chars')->nullable();
            $table->string('avail_denom', 255)->nullable();
            $table->string('point_of_redeeming', 255)->nullable();
            $table->integer('multiple_country_redeeming')->nullable();
            $table->text('countries_redeem_in')->nullable();
            $table->integer('abil_check_balance')->nullable();
            $table->string('contact_to_block', 255)->nullable();
            $table->integer('val_per_api')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->dropColumn('pin_on_card');
            $table->dropColumn('pin_chars');
            $table->dropColumn('avail_denom');
            $table->dropColumn('point_of_redeeming');
            $table->dropColumn('multiple_country_redeeming');
            $table->dropColumn('countries_redeem_in');
            $table->dropColumn('abil_check_balance');
            $table->dropColumn('contact_to_block');
            $table->integer('val_per_api')->default(null)->change();
        });
    }
}
