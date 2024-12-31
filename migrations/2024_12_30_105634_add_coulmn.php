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
        Schema::table('jpro_mother', function (Blueprint $table) {
            $table->string('building',30)->notNull()->default('')->comment('所属楼栋')->after('hep_b');
            $table->string('room',30)->notNull()->default('')->comment('所属房间')->after('building');
            $table->string('hep_b_date',20)->notNull()->default('')->comment('乙肝疫苗注射日期')->after('room');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jpro_mother', function (Blueprint $table) {
            $table->dropColumn('building');
            $table->dropColumn('room');
            $table->dropColumn('hep_b_date');
        });
    }
};
