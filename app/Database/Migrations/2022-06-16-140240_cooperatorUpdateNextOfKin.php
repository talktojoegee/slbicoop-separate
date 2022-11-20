<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CooperatorUpdateNextOfKin extends Migration
{
	public function up()
	{
		//
        $fields = [
            'application_kin_percentage' => [
                'type' => 'DOUBLE',
                'after' => 'application_kin_relationship',
                'null' => 'true'


            ],

            'application_kin2_fullname' => [
                'type' => 'TEXT',
                'after' => 'application_kin_relationship',
                'null' => 'true'


            ],

            'application_kin2_address' => [
                'type' => 'TEXT',
                'after' => 'application_kin2_fullname',
                'null' => true,
            ],

            'application_kin2_email' => [
                'type' => 'TEXT',
                'after' => 'application_kin2_address',
                'null' => true,
            ],

            'application_kin2_phone' => [
                'type' => 'TEXT',
                'after' => 'application_kin2_email',
                'null' => true,
            ],

            'application_kin2_relationship' => [
                'type' => 'TEXT',
                'after' => 'application_kin2_phone',
                'null' => true,
            ],

            'application_kin2_percentage' => [
                'type' => 'DOUBLE',
                'after' => 'application_kin2_relationship',
                'null' => true,
            ],



        ];
        $this->forge->addColumn('applications', $fields);

        $fields = [
            'cooperator_kin_percentage' => [
                'type' => 'DOUBLE',
                'after' => 'cooperator_kin_relationship',
                'null' => 'true'


            ],

            'cooperator_kin2_fullname' => [
                'type' => 'TEXT',
                'after' => 'cooperator_kin_relationship',
                'null' => 'true'


            ],

            'cooperator_kin2_address' => [
                'type' => 'TEXT',
                'after' => 'cooperator_kin2_fullname',
                'null' => true,
            ],

            'cooperator_kin2_email' => [
                'type' => 'TEXT',
                'after' => 'cooperator_kin2_address',
                'null' => true,
            ],

            'cooperator_kin2_phone' => [
                'type' => 'TEXT',
                'after' => 'cooperator_kin2_email',
                'null' => true,
            ],

            'cooperator_kin2_relationship' => [
                'type' => 'TEXT',
                'after' => 'cooperator_kin2_phone',
                'null' => true,
            ],

            'cooperator_kin2_percentage' => [
                'type' => 'DOUBLE',
                'after' => 'cooperator_kin2_relationship',
                'null' => true,
            ],



        ];
        $this->forge->addColumn('cooperators', $fields);

	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
