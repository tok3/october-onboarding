<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails10 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('replacement_type')->nullable();
            $table->integer('has_exp_date')->nullable();
            $table->integer('validity_in_month')->nullable();
            $table->integer('validity_starts_from');
            $table->integer('templ_provided');
            $table->string('template_barcode', 55)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->dropColumn('replacement_type');
            $table->dropColumn('has_exp_date');
            $table->dropColumn('validity_in_month');
            $table->dropColumn('validity_starts_from');
            $table->dropColumn('templ_provided');
            $table->dropColumn('template_barcode');
        });
    }
}
