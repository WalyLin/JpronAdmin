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
        Schema::dropIfExists('jpro_extra_info_type');
        Schema::dropIfExists('jpro_extra_info');
        Schema::dropIfExists('jpro_plan');
        Schema::dropIfExists('jpro_plan_type');
        Schema::dropIfExists('jpro_user');

        Schema::create('jpro_user', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('nickname', 200)->notnull()->default('')->comment('昵称');
            $table->tinyInteger('sex')->notnull()->default(1)->comment('性别 1男 2女 3未知');
            $table->unsignedTinyInteger('age')->notnull()->default(1)->comment('年龄');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1正常 2禁用');
            $table->string('remark', 200)->notnull()->default('')->comment('备注');
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
            $table->datetimes();
            $table->softDeletes();
            $table->comment('人员表');
        });

        Schema::create('jpro_extra_info_type', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name', 200)->notnull()->default('')->comment('名称');
            $table->string('remark', 200)->notnull()->default('')->comment('备注');
            $table->string('role')->notnull()->default('')->comment('可以查看的角色');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1-正常 2-禁用');
            $table->datetimes();
            $table->softDeletes();
            $table->comment('人员额外信息分类表');
        });


        Schema::create('jpro_extra_info', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('user_id')->notnull()->default(0)->comment('用户id');
            $table->string('type', 100)->notnull()->default('')->comment('类型');
            $table->text('detail')->notnull()->comment('额外信息详情');
            $table->string('remark', 200)->notnull()->default('')->comment('备注');
            $table->string('role')->notnull()->default('')->comment('可以查看的角色');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1-正常 2-禁用');

            $table->datetimes();
            $table->softDeletes();
            $table->comment('人员额外信息表');
        });


        Schema::create('jpro_plan_type', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('pid')->notnull()->default(0)->comment('父级ID');
            $table->string('name', 200)->notnull()->default('')->comment('类型名称');
            $table->string('remark', 200)->notnull()->default('')->comment('备注');
            $table->string('role')->notnull()->default('')->comment('可以查看的角色');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1-正常 2-禁用');
            $table->datetimes();
            $table->softDeletes();
            $table->comment('事件类型表');
        });

        Schema::create('jpro_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('user_id')->notnull()->default(0)->comment('用户id');
            $table->string('plan_type', 100)->notnull()->default('')->comment('事件类型');
            $table->text('detail')->notnull()->comment('事件详情');
            $table->string('remark', 200)->notnull()->default('')->comment('备注');
            $table->datetime('time')->nullable()->comment('计划时间');
            $table->string('role')->notnull()->default('')->comment('可以查看的角色');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('状态 1未开始 2执行中 3完毕 4取消');

            $table->datetimes();
            $table->softDeletes();
            $table->comment('事件表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jpro_extra_info_type');
        Schema::dropIfExists('jpro_extra_info');
        Schema::dropIfExists('jpro_plan');
        Schema::dropIfExists('jpro_plan_type');
        Schema::dropIfExists('jpro_user');
    }
};
