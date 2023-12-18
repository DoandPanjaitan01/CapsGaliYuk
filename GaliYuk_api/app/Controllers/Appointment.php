<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AppointmentModel;
 
class Appointment extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        $model = new AppointmentModel();
        $data['user'] = $model->orderBy('AppointmentID', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new AppointmentModel();
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
    public function show($AppointmentID = null)
    {
        $model = new AppointmentModel();
        $data = $model->where('AppointmentID', $AppointmentID)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tAppointmentIDak ditemukan.');
        }
    }
    // update
    public function update($AppointmentID = null)
    {
        $model = new AppointmentModel();
        $AppointmentID = $this->request->getVar('AppointmentID');
        $data = [
            'username' => $this->request->getVar('username'),    
            'email'  => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
        ];
        $model->update($AppointmentID, $data);
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
    public function delete($AppointmentID = null)
    {
        $model = new AppointmentModel();
        $data = $model->where('AppointmentID', $AppointmentID)->delete($AppointmentID);
        if ($data) {
            $model->delete($AppointmentID);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data user berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data AppointmentID tIDak ditemukan.');
        }
    }
}