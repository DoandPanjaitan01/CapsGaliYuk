<?php
 
namespace App\Models;
 
use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'Appointments';
    protected $primaryKey = 'AppointmentID';
    protected $allowedFields = ['CustomerID','ServiceID','Price','Date','Status'];
}