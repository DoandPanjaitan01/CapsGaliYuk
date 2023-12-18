<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
 
class User extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        $model = new UserModel();
        $data['user'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),    
            'email'  => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data user berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($UserID = null)
    {
        $model = new UserModel();
        $data = $model->where('id', $UserID)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data user ditemukan.');
        }
    }
    // update
    public function update($UserID = null)
    {
        $model = new UserModel();
        $UserID = $this->request->getVar('id');
        $data = [
            'username' => $this->request->getVar('username'),    
            'email'  => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
        ];
        $model->update($UserID, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data user berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($UserID = null)
    {
        $model = new UserModel();
        $data = $model->where('id', $UserID)->delete($UserID);
        if ($data) {
            $model->delete($UserID);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data user berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data UserID tidak ditemukan.');
        }
    }
}