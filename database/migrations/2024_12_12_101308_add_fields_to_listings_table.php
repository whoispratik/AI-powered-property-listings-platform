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
        Schema::table('listings', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('baths');
            $table->unsignedsmallInteger('area');
            $table->tinyText('city');
            $table->tinyText('unit');
            $table->boolean('parking');
            $table->tinyText('facing');
            $table->boolean('road_access');
            $table->unsignedInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // i have to include the above columns i wont do it now
       Schema::dropColumns('listings',['street','street_nr','code']);
    }
};
