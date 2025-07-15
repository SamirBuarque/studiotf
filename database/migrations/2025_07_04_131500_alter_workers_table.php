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
        Schema::table("workers", function (Blueprint $table) {
            $table->date("birth_date")->nullable()->after('name')->default(null);
            $table->string('position')->nullable()->after('birth_date')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('position');
        });
    }
};
