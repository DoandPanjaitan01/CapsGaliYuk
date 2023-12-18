<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ServiceModel extends Model 
{
    protected $table = 'WellServices';
    protected $primaryKey = 'ServiceID';
    protected $allowedFields = ['ServiceProvider','ServiceName','Description'];

}