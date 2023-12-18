<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class UserController extends ResourceController 
{
    use ResponseTrait;
    public function db() {
        return db_connect();
    }

    // public function index()
    // {
    //     $builder = $db()->table('Users');
    // }
   

    public function showAppointments($userid = NULL)
    {
        $data = $this->db()->query("select P.ServiceProviderName, S.ServiceName, S.Price , A.date, A.status from appointments A  
        join serviceproviders P on P.serviceproviderid = A.serviceproviderid 
        join wellservices S on A.ServiceID = S.ServiceID 
        where A.CustomerID ='$userid';")->getResultArray();
        $this->db()->close();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Transaction ditemukan.');
        }
    }

    public function showTransactions($userid = NULL)
    {
        $data = $this->db()->query("select  P.ServiceProviderName, T.Amount , T.TransactionDate, T.PaymentStatus , T.PaymentMethod from transactions T
        join Appointments A on T.AppointmentID = A.AppointmentID 
        join serviceproviders P on A.ServiceProviderID = P.serviceproviderid
        where T.CustomerID ='$userid';")->getResultArray();
        $this->db()->close();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Transaction ditemukan.');
        }
    }
    



}