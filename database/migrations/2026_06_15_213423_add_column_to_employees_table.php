<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->unique();

            $table->string('phone_number');
            $table->string('address');

            $table->string('profile_picture')->nullable();

            $table->date('joining_date');

            $table->enum('account_status', [
                'active',
                'inactive',
                'suspended'
            ])->default('active');

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
