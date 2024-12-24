<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('system_user', function (Blueprint $table) {
            $table->string('hospital',255)->default('')->comment('医院')->after('status');
            $table->string('doctor',255)->default('')->comment('医生')->after('hospital');
            $table->tinyInteger('age')->notnull()->default(0)->comment('年龄')->after('doctor');
            $table->tinyInteger('body_status')->notnull()->default(1)->comment('身体状况 1正常')->after('age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_user', function (Blueprint $table) {
            $table->dropColumn('hospital');
            $table->dropColumn('doctor');
            $table->dropColumn('age');
            $table->dropColumn('body_status');
        });
    }
};
