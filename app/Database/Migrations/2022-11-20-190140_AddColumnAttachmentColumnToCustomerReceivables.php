<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnAttachmentColumnToCustomerReceivables extends Migration
{
    public function up()
    {
      $fields = [
        'cr_attachment' => [
          'type' => 'TEXT',
          'null'=>true,

        ]
      ];
      $this->forge->addColumn('customer_receivables', $fields);
    }

    public function down()
    {
        //
    }
}
