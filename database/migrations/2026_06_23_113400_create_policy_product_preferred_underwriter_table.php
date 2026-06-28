<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policy_product_preferred_underwriter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_product_id');
            $table->foreign('policy_product_id', 'pppu_product_fk')->references('id')->on('policy_products')->cascadeOnDelete();
            $table->unsignedBigInteger('insurance_company_id');
            $table->timestamps();

            $table->foreign('insurance_company_id', 'pppu_insurance_company_fk')
                ->references('id')->on('insurance_companies')->cascadeOnDelete();

            $table->unique(['policy_product_id', 'insurance_company_id'], 'pppu_product_company_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policy_product_preferred_underwriter');
    }
};
