<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FollowModel;


class FollowController extends BaseController
{
    public function __construct()
    {
        helper('auth'); // Panggil helper 'auth' yang telah Anda buat
    }

    public function follow($user_id)
    {
        $session = session();
        if (!is_logged_in()) {
            $session->set('previous_url', current_url());
            return redirect()->to('/login')->with('error', 'Anda harus login untuk membuat komentar');
        }

        $user_model = new UserModel();
        $user = $user_model->select('*')
                           ->where('id', $user_id)
                           ->first();

        if (!is_null($user)) {
            $follow_model = new FollowModel();

            $logged_user_id = $session->get('user_id');

            try {
                $data_follow = $follow_model->select('*')
                                        ->where('user_id',$logged_user_id)  
                                        ->where('follow_user_id', $user_id)
                                        ->first();

                if (!$data_follow && $logged_user_id != $user_id) {
                
                    $save_data = [
                                    'user_id'=> $logged_user_id,
                                    'follow_user_id'=> $user['id'],
                                ];

                    $follow_model->save($save_data);
                    $this->incrementFollowingCount($logged_user_id,1);
                    $this->incrementFollowerCount($user_id,1);
                }

                return redirect()->to('/public_profile/' . $user['username'])->with('success','Berhasil follow');
            } catch (Exception $e) {
                die($e->errorMessage());
            }
        } else {
            echo 'User Tidak Ditemukan';
        }
    }

    public function unfollow($user_id)
    {
        $session = session();
        if (!is_logged_in()) {
            $session->set('previous_url', current_url());
            return redirect()->to('/login')->with('error', 'Anda harus login untuk membuat komentar');
        }

        $user_model = new UserModel();
        $user = $user_model->select('*')
                           ->where('id', $user_id)
                           ->first();

        if (!is_null($user)) {
            $follow_model = new FollowModel();

            $logged_user_id = $session->get('user_id');

            try {

                $follow_model->where('user_id', $logged_user_id)
                             ->where('follow_user_id', $user['id'])   
                             ->delete();

                $this->incrementFollowingCount($logged_user_id,-1);
                $this->incrementFollowerCount($user_id,-1);

                return redirect()->to('/public_profile/' . $user['username'])->with('success','Berhasil Unfollow');
            } catch (Exception $e) {
                die($e->errorMessage());
            }
        } else {
            echo 'User Tidak Ditemukan';
        }
    }

    private function incrementFollowerCount($user_id, $inc)
    {
        // Lakukan penambahan klik pada laporan dengan menggunakan model laporan sampah
        $userModel = new UserModel();
        $user = $userModel->find($user_id);

        if ($user) {
            $currentFollowerCount = $user['follower_count']; 
            $newFollowerCount = $currentFollowerCount + $inc;

            $data = [
                'follower_count' => $newFollowerCount
            ];
            
            $builder = $userModel->builder();
            $builder->where('id', $user_id);
            $builder->update($data);
        }
    }

    private function incrementFollowingCount($user_id, $inc)
    {
        // Lakukan penambahan klik pada laporan dengan menggunakan model laporan sampah
        $userModel = new UserModel();
        $user = $userModel->find($user_id);

        if ($user) {
            $currentFollowerCount = $user['following_count']; 
            $newFollowerCount = $currentFollowerCount + $inc;

            $data = [
                'following_count' => $newFollowerCount
            ];
            
            $builder = $userModel->builder();
            $builder->where('id', $user_id);
            $builder->update($data);
        }
    }


}
