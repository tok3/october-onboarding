<?php namespace Eq3w\Onboarding\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateEq3wOnboardingGifcardDetails3 extends Migration
{
    public function up()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->string('dist_type', 255)->nullable();
            $table->text('delivery_channel')->nullable();
            $table->string('processor', 255)->nullable();
            $table->integer('order_api')->nullable();
            $table->integer('min_req')->nullable();
            $table->decimal('min_req_val', 5, 2)->nullable();
            $table->text('card_formats')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('eq3w_onboarding_gifcard_details', function($table)
        {
            $table->dropColumn('dist_type');
            $table->dropColumn('delivery_channel');
            $table->dropColumn('processor');
            $table->dropColumn('order_api');
            $table->dropColumn('min_req');
            $table->dropColumn('min_req_val');
            $table->dropColumn('card_formats');
        });
    }
}
