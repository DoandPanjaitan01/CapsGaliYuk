<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class TransactionModel extends Model
{
    protected $table = 'Transactions';
    protected $primaryKey = 'TransactionID';
    protected $allowedFields = ['AppointmentID','AppointmentID','AppointmentID','PaymentStatus','PaymentMethod'];
}