<?php 
namespace App\Models;
use CodeIgniter\Model;

class MailModel extends Model{
    protected $table = 'mails';
    protected $primaryKey = 'mail_id';
    protected $allowedFields = ['mail_id', 'subject', 'body', 'sent_by'];




     public function getMails(){
        $builder = $this->db->table('mails');
        $builder->join('mail_receivers', 'mails.mail_id = mail_receivers.mail_id');
        $builder->join('cooperators', 'cooperators.cooperator_id = mail_receivers.mail_receiver_id');
        return $builder->get()->getResultObject(); 
    }
     public function getMail($id){
        $builder = $this->db->table('mails');
        $builder->join('mail_receivers', 'mails.mail_id = mail_receivers.mail_id');
        $builder->where('mails.mail_id = '.$id);
        return $builder->get()->getRowObject(); 
    }


    /*public function getSchedulePaymentDetail($id){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.schedule_master_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('schedule_masters.schedule_master_id = '.$id);
        return $builder->get()->getResultObject();
    } */

}

?>