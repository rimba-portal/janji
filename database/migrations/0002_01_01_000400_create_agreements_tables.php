<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('agreement_types', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique(); // e.g., 'job_contract', 'maintenance_contract'
            $table->string('name');

            // Model Validation Rules (stores fully qualified class strings like Rimba\People\Models\Staff)
            $table->string('party_a_type');
            $table->string('party_b_type');
            $table->string('scopeable_type');

            // Multiplicity Control
            $table->string('scopeable_relation')->default('one'); // 'one' or 'many'

            $table->json('settings')->nullable();
            $table->timestamps();
        });
        Schema::create('agreements', function (Blueprint $table): void {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('agreement_type_id')->constrained('agreement_types');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('Draft');

            // Polymorphic pairs match against the type columns in agreement_types
            $table->numericMorphs('party_a');
            $table->nullableNumericMorphs('party_b');

            $table->json('attributes')->nullable();
            $table->timestamps();
        });
        Schema::create('agreement_scopes', function (Blueprint $table): void {
            $table->id();

            // Link to the parent agreement
            $table->foreignId('agreement_id')
                ->constrained('agreements')
                ->cascadeOnDelete();

            // The Polymorphic pair: scopeable_type and scopeable_id
            // This allows linking to JobPosition, Asset, Staff, etc.
            $table->numericMorphs('scopeable');

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_scopes');
        Schema::dropIfExists('agreements');
        Schema::dropIfExists('agreement_types');
    }
};
