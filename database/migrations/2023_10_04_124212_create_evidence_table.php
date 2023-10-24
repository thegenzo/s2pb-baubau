<?php

use App\Models\CriminalPerpetrator;
use App\Models\Criteria;
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
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CriminalPerpetrator::class)->constrained();
            $table->string('register_number');
            $table->string('name');
            $table->integer('amount');
            $table->string('unit');
            $table->longText('description');
            $table->date('entry_date');
            $table->string('storage_location');
            $table->enum('status', ['detained', 'returned', 'terminated']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
