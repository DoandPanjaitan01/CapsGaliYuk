<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username','email','password'];
}