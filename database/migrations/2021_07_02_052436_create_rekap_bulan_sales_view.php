<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapBulanSalesView extends Migration
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
          CREATE OR REPLACE VIEW rekap_bulan_sales AS SELECT 
           SUBSTRING(keyword, 1, 7) AS bulan, 
           sales_id, 
           SUM(penjualan) AS penjualan, 
           SUM(cash_in) AS cash_in, SUM(piutang) AS piutang 
           FROM `faktur` 
           GROUP BY SUBSTRING(keyword, 1, 7), sales_id

        --    CREATE OR REPLACE VIEW rekap_bulan_sales AS SELECT 
        --    SUBSTRING(tanggal_faktur, 4, 7) AS bulan, 
        --    sales_id, 
        --    SUM(penjualan) AS penjualan, 
        --    SUM(cash_in) AS cash_in, SUM(piutang) AS piutang 
        --    FROM `faktur` 
        --    GROUP BY SUBSTRING(tanggal_faktur, 4, 7), sales_id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `rekap_bulan_sales`;
            SQL;
    }
}
