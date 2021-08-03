<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapPerBulanView extends Migration
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
            CREATE OR REPLACE VIEW rekap_per_bulan AS 
           SELECT SUBSTRING(keyword, 1, 7) AS bulan, 
           SUM(IF( SUBSTRING(keyword, 1, 7) = SUBSTRING(keyword, 1, 7), penjualan, 0) ) AS penjualan, 
           SUM(IF( SUBSTRING(keyword, 1, 7) = SUBSTRING(keyword, 1, 7), cash_in, 0) ) AS cash_in, 
           SUM(IF( SUBSTRING(keyword, 1, 7) = SUBSTRING(keyword, 1, 7), piutang, 0) ) AS piutang 
           FROM faktur GROUP BY SUBSTRING(keyword, 1, 7)

        --    CREATE OR REPLACE VIEW rekap_per_bulan AS 
        --    SELECT SUBSTRING(tanggal_faktur, 4, 7) AS bulan, 
        --    SUM(IF( SUBSTRING(tanggal_faktur, 4, 7) = SUBSTRING(tanggal_faktur, 4, 7), penjualan, 0) ) AS penjualan, 
        --    SUM(IF( SUBSTRING(tanggal_faktur, 4, 7) = SUBSTRING(tanggal_faktur, 4, 7), cash_in, 0) ) AS cash_in , 
        --    SUM(IF( SUBSTRING(tanggal_faktur, 4, 7) = SUBSTRING(tanggal_faktur, 4, 7), piutang, 0) ) AS piutang 
        --    FROM faktur GROUP BY SUBSTRING(tanggal_faktur, 4, 7)
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `rekap_per_bulan`;
            SQL;
    }
}
