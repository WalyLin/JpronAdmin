<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::table('jpro_extra_info_type', function (Blueprint $table) {
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
        });


        Schema::table('jpro_extra_info', function (Blueprint $table) {
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
        });


        Schema::table('jpro_plan_type', function (Blueprint $table) {
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
        });

        Schema::table('jpro_plan', function (Blueprint $table) {
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jpro_plan_type', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        Schema::table('jpro_extra_info', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        Schema::table('jpro_plan', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        Schema::table('jpro_extra_info_type', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        
    }
};
