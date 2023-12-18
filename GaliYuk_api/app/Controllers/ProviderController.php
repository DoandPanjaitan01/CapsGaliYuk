<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ProviderController extends ResourceController 
{
    use ResponseTrait;
    public function db() 
    {
        return db_connect();
    }

    public function showAppointments($providerid = NULL)
    {
        $data = $this->db()->query("select U.username, S.ServiceName, S.Price , A.date, A.status from appointments A  
        join users U on A.CustomerID  = U.id 
        join wellservices S on A.ServiceID = S.ServiceID 
        where A.serviceproviderid ='$providerid';")->getResultArray();
        $this->db()->close();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Transaction ditemukan.');
        }
    }
    public function showTransactions($providerid = NULL)
    {
        $data = $this->db()->query("select  U.username, T.Amount , T.TransactionDate, T.PaymentStatus , T.PaymentMethod from transactions T
        join Appointments A on T.AppointmentID = A.AppointmentID 
        join users U on A.CustomerID = U.id
        where A.ServiceProviderID ='$providerid';")->getResultArray();
        $this->db()->close();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Transaction ditemukan.');
        }
    }


}