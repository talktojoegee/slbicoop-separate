<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vendors extends Migration
{
    public function up()
    {
      $this->db->disableForeignKeyChecks();
      $this->forge->addField(
        [
          'vendor_id' =>[
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
          ],
          'v_company_name' =>[
            'type' => 'TEXT',
            'null'=>true,
          ],
          'v_company_email' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_phone_no' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_website' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_gl_code' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_bank_id' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_bank_account' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_sort_code' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_address' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_contact_first_name' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_contact_last_name' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_contact_phone_no' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_contact_email' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_contact_position' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'v_contact_description' =>[
            'type' => 'TEXT',
            'null'=>true
          ],
          'created_by' =>[
            'type' => 'INT',
            'null'=>true,
          ],
          'created_at'=>[
            'type'=>'DATETIME',
            'null'=>true,
          ],


        ]
      );
      $this->forge->addKey('vendor_id', true);
      $this->forge->createTable('vendors');
    }

    public function down()
    {
        //
    }
}
