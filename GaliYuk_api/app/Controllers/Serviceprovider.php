<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ServiceproviderModel;

class Serviceprovider extends ResourceController
{
    use ResponseTrait;
    // all ServiceProviders
    public function index()
    {
        $model = new ServiceProviderModel();
        $data['ServiceProvider'] = $model->orderBy('ServiceProviderID', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new ServiceProviderModel();
        $data = [
            'ServiceProviderName' => $this->request->getVar('ServiceProviderName'),
            'ExperienceYears'  => $this->request->getVar('ExperienceYears'),
            'Description'  => $this->request->getVar('Description'),
            'ServiceArea'  => $this->request->getVar('ServiceArea'),
            'AvailableHours'  => $this->request->getVar('AvailableHours'),
            'Email'  => $this->request->getVar('Email'),
            'Phone'  => $this->request->getVar('Phone'),

        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data ServiceProvider berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single ServiceProvider
    public function show($ServiceProviderID = null)
    {
        $model = new ServiceProviderModel();
        $data = $model->where('ServiceProviderID', $ServiceProviderID)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data ServiceProviderID tidak ditemukan.');
        }
    }
    // update
    public function update($ServiceProviderID = null)
    {
        $model = new ServiceProviderModel();
        $ServiceProviderID = $this->request->getVar('ServiceProviderID');
        $data = [
            'ServiceProviderName' => $this->request->getVar('ServiceProviderName'),
            'ExperienceYears'  => $this->request->getVar('ExperienceYears'),
            'Description'  => $this->request->getVar('Description'),
            'ServiceArea'  => $this->request->getVar('ServiceArea'),
            'AvailableHours'  => $this->request->getVar('AvailableHours'),
            'Email'  => $this->request->getVar('Email'),
            'Phone'  => $this->request->getVar('Phone'),
        ];
        $model->update($ServiceProviderID, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data ServiceProvider berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($ServiceProviderID = null)
    {
        $model = new ServiceProviderModel();
        $data = $model->where('ServiceProviderID', $ServiceProviderID)->delete($ServiceProviderID);
        if ($data) {
            $model->delete($ServiceProviderID);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data ServiceProvider berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data ServiceProviderID tidak ditemukan.');
        }
    }
}