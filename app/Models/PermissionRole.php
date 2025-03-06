<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;
    protected $table = 'permissionrole';
    protected $fillable = [
        'permissionid',
        'roleid',
        'RecordOwnerID'
    ];
}
