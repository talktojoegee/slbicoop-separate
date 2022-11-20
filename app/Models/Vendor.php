<?php

namespace App\Models;

use CodeIgniter\Model;

class Vendor extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'vendors';
    protected $primaryKey       = 'vendor_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'v_company_name', 'v_company_email', 'v_phone_no', 'v_website', 'v_gl_code', 'v_address',
      'v_contact_first_name', 'v_contact_last_name', 'v_contact_phone_no', 'v_contact_email',
      'v_contact_position', 'v_contact_description', 'created_by', 'created_at','v_bank_id','v_bank_account',
      'v_sort_code'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


  public function getVendors(){
    $builder = $this->db->table('vendors');
    $builder->join('coas', 'vendors.v_gl_code = coas.glcode');
    return $builder->get()->getResultObject();
  }

  public function getVendorById($id){
    $builder = $this->db->table('vendors');
    $builder->where('vendor_id = '.$id);
    return $builder->get()->getRowObject();
  }


}
