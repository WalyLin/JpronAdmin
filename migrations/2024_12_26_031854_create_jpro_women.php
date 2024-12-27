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
        Schema::create('jpro_mother', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->notnull()->default('')->comment('姓名');
            $table->unsignedTinyInteger('age')->notnull()->default(1)->comment('年龄');
            $table->unsignedTinyInteger('body_status')->notnull()->default(1)->comment('身体状态');
            $table->smallInteger('gravida')->notnull()->default(0)->comment('怀孕次数');
            $table->string('operation', 255)->notnull()->default('')->comment('手术情况');
            $table->string('food_allergy', 255)->notnull()->default('')->comment('食物过敏');
            $table->string('drug_allergy', 255)->notnull()->default('')->comment('药物过敏');
            $table->string('complication', 255)->notnull()->default('')->comment('并发症');
            $table->decimal('height', 5, 2)->notnull()->default(0)->comment('身高');
            $table->decimal('weight', 5, 2)->notnull()->default(0)->comment('体重');
            $table->datetime('last_menstrual_time')->nullable()->comment('上次月经时间');
            $table->datetime('arrive_time')->nullable()->comment('到达格鲁吉亚时间');
            $table->integer('bleed_amount')->nullable()->comment('流血量');
            $table->integer('children_amount')->nullable()->comment('小孩数量');
            $table->integer('menstrual_freq')->nullable()->comment('多少天一次月经');
            $table->string('tag', 30)->notnull()->default('')->comment('标签');
            $table->string('tag_remark', 200)->notnull()->default('')->comment('标签备注');
            $table->bigInteger('hospital_id')->notnull()->default(0)->comment('医院');
            $table->bigInteger('doctor_id')->notnull()->default(0)->comment('医生');
            $table->string('remark', 255)->notnull()->default('')->comment('备注');
            $table->text('extra')->nullable()->comment('扩展信息');
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
            $table->datetimes();
            $table->softDeletes();
            $table->comment('孕妈表');
        });


        Schema::create('jpro_check_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mother_id')->notnull()->default(0)->comment('孕妈id');
            $table->text('detail')->nullable()->comment('检查详情');
            $table->bigInteger('hospital_id')->notnull()->default(0)->comment('医院');
            $table->bigInteger('doctor_id')->notnull()->default(0)->comment('医生');
            $table->datetime('check_time')->nullable()->comment('检查时间');
            $table->string('remark', 255)->notnull()->default('')->comment('备注');
            $table->text('extra')->nullable()->comment('扩展信息');
            $table->bigInteger('created_by')->notnull()->default(0)->comment('创建者');
            $table->datetimes();
            $table->softDeletes();
            $table->comment('就诊记录表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jpro_mother');
        Schema::dropIfExists('jpro_check_record');
    }
};
