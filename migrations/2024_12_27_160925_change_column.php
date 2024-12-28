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


        if (Schema::hasColumn('jpro_mother', 'bleed_amount')) {
            Schema::table('jpro_mother', function (Blueprint $table) {
                $table->dropColumn('bleed_amount');
            });

        }
        Schema::table('jpro_mother', function (Blueprint $table) {
            $table->string('surname', 100)->notNull()->default('')->comment('姓')->after('age');
            $table->string('passport', 255)->notNull()->default('')->comment('护照图片url')->after('surname');
            $table->string('hep_b', 6)->notNull()->default('')->comment('乙肝疫苗')->after('passport');
            $table->string('name', 100)->notnull()->default('')->comment('名')->change();
            $table->string('bleed_amount', 20)->notNull()->default('')->comment('流血量');
        });



        Schema::table('jpro_check_record', function (Blueprint $table) {
            $table->string('menstrual', 255)->notnull()->default('')->comment('月经情况')->after('remark');
            $table->smallInteger('status')->notnull()->default(1)->comment('状态 1正常 2注意 3')->after('menstrual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jpro_mother', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('passport');
            $table->dropColumn('hep_b');
        });

        Schema::table('jpro_check_record', function (Blueprint $table) {
            $table->dropColumn('menstrual');
            $table->dropColumn('status');
        });
    }
};
