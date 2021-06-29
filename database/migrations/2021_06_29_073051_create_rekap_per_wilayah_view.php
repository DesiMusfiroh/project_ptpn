<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapPerWilayahView extends Migration
{
    public function up()
    {
        \DB::statement($this->createView());
    }

    public function down()
    {
        \DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<SQL
           CREATE OR REPLACE VIEW rekap_per_wilayah AS 
           SELECT wilayah_id, 
           SUM(IF( wilayah_id = wilayah_id, penjualan, 0) ) AS penjualan, 
           SUM(IF( wilayah_id = wilayah_id, cash_in, 0) ) AS cash_in , 
           SUM(IF( wilayah_id = wilayah_id, piutang, 0) ) AS piutang 
           FROM faktur GROUP BY wilayah_id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `rekap_per_wilayah`;
            SQL;
    }
}
