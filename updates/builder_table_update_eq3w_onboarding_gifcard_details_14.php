<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails14 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->string('templ_provided', 55)->nullable()->unsigned(false)->default('n/a')->change();
            $table->string('validity_starts_from', 55)->nullable()->unsigned(false)->default('n/a')->change();
            $table->renameColumn('template_barcode', 'template_barcode_type');
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->integer('templ_provided')->nullable()->unsigned(false)->default(null)->change();
            $table->integer('validity_starts_from')->nullable()->unsigned(false)->default(null)->change();
            $table->renameColumn('template_barcode_type', 'template_barcode');
        });
    }
}
