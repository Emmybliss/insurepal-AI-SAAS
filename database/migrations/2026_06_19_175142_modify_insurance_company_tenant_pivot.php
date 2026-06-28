<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('insurance_company_tenant', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_company_branch_id')
                ->nullable()
                ->after('insurance_company_id');

            $table->foreign('insurance_company_branch_id', 'ict_company_branch_fk')
                ->references('id')
                ->on('insurance_company_branches')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('insurance_company_tenant', function (Blueprint $table) {
            $table->dropForeign('ict_company_branch_fk');
            $table->dropColumn('insurance_company_branch_id');
        });
    }
};
