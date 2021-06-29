<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapPerSalesView extends Migration
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
            CREATE OR REPLACE VIEW rekap_per_sales AS 
            SELECT sales_id, 
            SUM(IF( sales_id = sales_id, penjualan, 0) ) AS penjualan, 
            SUM(IF( sales_id = sales_id, cash_in, 0) ) AS cash_in , 
            SUM(IF( sales_id = sales_id, piutang, 0) ) AS piutang 
            FROM faktur GROUP BY sales_id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `rekap_per_sales`;
            SQL;
    }
}
