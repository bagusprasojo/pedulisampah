<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowModel extends Model
{
    protected $table = 'follow';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'follow_user_id']; // Field yang diizinkan untuk diisi
    protected $useAutoIncrement = true;
    
    // Aturan validasi, misalnya untuk pendaftaran pengguna
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
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

    function getFollowing($user_id)
    {
        $data = $this->select('follow_user_id as user_id')
                     ->where("user_id", $user_id)->findAll();

        return $data;
    }

    function getFollower($user_id)
    {
        $data = $this->select('user_id')
                     ->where("follow_user_id", $user_id)->findAll();
                     
        return $data;
    }
}
