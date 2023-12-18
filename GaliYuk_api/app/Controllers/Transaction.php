<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TransactionModel;
 
class Transaction extends ResourceController
{
    use ResponseTrait;
    // all TransactionIDs
    public function index()
    {
        $model = new TransactionModel();
        $data['TransactionID'] = $model->orderBy('TransactionID', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new TransactionModel();
        $data = [
            'AppointmentID' => $this->request->getVar('AppointmentID'),    
            'Amount'  => $this->request->getVar('Amount'),
            'TransactionDate'  => $this->request->getVar('TransactionDate'),
            'PaymentStatus'  => $this->request->getVar('PaymentStatus'),
            'PaymentMethod'  => $this->request->getVar('PaymentMethod'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Transaction berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single TransactionID
    public function show($TransactionID = null)
    {
        $model = new TransactionModel();
        $data = $model->where('TransactionID', $TransactionID)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Transaction ditemukan.');
        }
    }
    // update
    public function update($TransactionID = null)
    {
        $model = new TransactionModel();
        $TransactionID = $this->request->getVar('TransactionID');
        $data = [
            'AppointmentID' => $this->request->getVar('AppointmentID'),    
            'Amount'  => $this->request->getVar('Amount'),
            'TransactionDate'  => $this->request->getVar('TransactionDate'),
            'PaymentStatus'  => $this->request->getVar('PaymentStatus'),
            'PaymentMethod'  => $this->request->getVar('PaymentMethod'),
        ];
        $model->update($TransactionID, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Transaction berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($TransactionID = null)
    {
        $model = new TransactionModel();
        $data = $model->where('TransactionID', $TransactionID)->delete($TransactionID);
        if ($data) {
            $model->delete($TransactionID);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Transaction berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data Transaction ditemukan.');
        }
    }
}