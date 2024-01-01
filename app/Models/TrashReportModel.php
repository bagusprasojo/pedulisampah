<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TrashReportPhotoModel;

class TrashReportModel extends Model
{
    protected $table            = 'trashreports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'title','location', 'description', 'photo', 'created_at', 'slug'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required',
        'location' => 'required',
        'description' => 'required',
        // 'photo' => 'ext_in[photo,png,jpg,jpeg,gif]', // Contoh aturan validasi untuk berkas foto
        // Tambahkan aturan validasi lainnya sesuai kebutuhan.
    ];
    
    protected $validationMessages = [
        'location' => [
            'required' => 'Lokasi harus diisi.',
        ],
        'title' => [
            'required' => 'Judul harus diisi.',
        ],
        'description' => [
            'required' => 'Deskripsi harus diisi.',  
            'min_length' => 'Deskripsi minimal terdiri dari 250 karakter.',          
        ],
        // 'photo' => [
            
        //     'max_size' => 'Ukuran file foto terlalu besar (maksimum 1MB).',
        //     'ext_in' => 'Hanya file dengan format PNG, JPG, JPEG, atau GIF yang diperbolehkan.',
        // ],
    ];
    
    protected $skipValidation     = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];
    protected $afterInsert    = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function photos()
    {
        return $this->hasMany(TrashReportPhotoModel::class, 'trash_report_id');
    }

    public function addPhoto($trashReportId, $photoPath)
    {
        $photoModel = new TrashReportPhotoModel();
        return $photoModel->insert([
            'trash_report_id' => $trashReportId,
            'photo_path' => $photoPath
        ]);
    }

    public function deletePhoto($photoId)
    {
        $photoModel = new TrashReportPhotoModel();
        return $photoModel->delete($photoId);
    }

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['title'])) {
            $slug = url_title($data['data']['title'], '-', true); // Membuat slug dari title

            $data['data']['slug'] = $this->createUniqueSlug($slug); // Menyimpan slug pada field 'slug'
        }

        return $data;
    }

    protected function createUniqueSlug($slug)
    {
        $count = 1;
        $originalSlug = $slug;

        while ($this->where('slug', $slug)->first()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
