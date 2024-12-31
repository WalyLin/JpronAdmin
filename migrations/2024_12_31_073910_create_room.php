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

        Schema::create('jpro_building', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 30)->notNull()->default('')->comment('楼栋名称');
            $table->string('address', 30)->notNull()->default('')->comment('地址');
            $table->smallInteger('room_num')->notNull()->default(0)->comment('房间数量');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1正常 2禁用');
            $table->string('remark', 255)->notNull()->default('')->comment('备注');

            $table->datetimes();
            $table->comment('楼栋表');
        });


        Schema::create('jpro_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 30)->notNull()->default('')->comment('房间名称');
            $table->bigInteger('building_id')->nullable()->comment('关联所属楼栋id');
            $table->smallInteger('max_num')->notNull()->default(0)->comment('房间最大人数');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1正常 2禁用');
            $table->string('remark', 255)->notNull()->default('')->comment('备注');
            $table->datetimes();
            $table->comment('房间表');
        });


        if (Schema::hasColumn('jpro_mother', 'building')) {
            Schema::table('jpro_mother', function (Blueprint $table) {
                $table->dropColumn('building');
                $table->dropColumn('room');
                $table->bigInteger('building_id')->nullable()->comment('所属楼栋');
                $table->bigInteger('room_id')->nullable()->comment('所属房间');
            });
        }

        if (!Schema::hasColumn('jpro_mother', 'building_id')) {
            Schema::table('jpro_mother', function (Blueprint $table) {
                $table->bigInteger('building_id')->nullable()->comment('所属楼栋');
                $table->bigInteger('room_id')->nullable()->comment('所属房间');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jpro_building');
        Schema::dropIfExists('jpro_room');


        if (Schema::hasColumn('jpro_mother', 'building_id')) {
            Schema::table('jpro_mother', function (Blueprint $table) {
                $table->dropColumn('building_id');
                $table->dropColumn('room_id');

            });
        }
    }
};
