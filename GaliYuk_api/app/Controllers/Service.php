<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ServiceModel;
 
class Service extends ResourceController
{
    use ResponseTrait;
    // all Services
    public function index()
    {
        $model = new ServiceModel();
        $data['Service'] = $model->orderBy('ServiceID', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new ServiceModel();
        $data = [
            'ServiceProvider' => $this->request->getVar('ServiceProvider'),    
            'ServiceName'  => $this->request->getVar('ServiceName'),
            'Description'  => $this->request->getVar('Description'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Service berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single Service
    public function show($ServiceID = null)
    {
        $model = new ServiceModel();
        $data = $model->where('ServiceID', $ServiceID)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data ServiceID tidak ditemukan.');
        }
    }
    // update
    public function update($ServiceID = null)
    {
        $model = new ServiceModel();
        $ServiceID = $this->request->getVar('ServiceID');
        $data = [
            'ServiceProvider' => $this->request->getVar('ServiceProvider'),    
            'ServiceName'  => $this->request->getVar('ServiceName'),
            'Description'  => $this->request->getVar('Description'),
        ];
        $model->update($ServiceID, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Service berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($ServiceID = null)
    {
        $model = new ServiceModel();
        $data = $model->where('ServiceID', $ServiceID)->delete($ServiceID);
        if ($data) {
            $model->delete($ServiceID);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Service berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data ServiceID tidak ditemukan.');
        }
    }
}