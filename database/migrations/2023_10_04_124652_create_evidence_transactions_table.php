<?php

use App\Models\Evidence;
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
        Schema::create('evidence_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Evidence::class)->constrained();
            $table->date('transaction_date');
            $table->enum('transaction_type', ['terminated', 'returned', 'in', 'out']);
            $table->text('notes');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence_transactions');
    }
};
