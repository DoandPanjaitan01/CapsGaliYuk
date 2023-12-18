<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ServiceproviderModel extends Model
{
    protected $table = 'ServiceProviders';
    protected $primaryKey = 'ServiceProviderID';
    protected $allowedFields = ['ServiceCategory','ExperienceYears','Description','ServiceArea','AvailableHours'];
}