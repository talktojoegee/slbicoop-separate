<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'username', 'password', 'user_type', 'user_status', 'created_at'];


  public function getUserById($id){
    $builder = $this->db->table('users');
    $builder->where('user_id = '.$id);
    return $builder->get()->getRowObject();
  }
}

?>
