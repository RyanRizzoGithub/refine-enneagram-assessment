<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStartingUsesToTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tokens', function (Blueprint $table) {
            // The original number of uses a code was created with. The existing
            // "uses" column is decremented as the code is redeemed, so it only
            // tells us the remaining uses; we keep the starting value here so the
            // admin can see "X of Y used".
            $table->unsignedInteger('starting_uses')->default(0)->after('uses');
        });

        // Backfill existing rows. There is no historical record of what these
        // codes were originally created with, so the best available value is
        // the current (remaining) uses. Codes created after this migration
        // record their true starting value.
        DB::table('tokens')->update(['starting_uses' => DB::raw('uses')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokens', function (Blueprint $table) {
            $table->dropColumn('starting_uses');
        });
    }
}
