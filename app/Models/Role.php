<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function permissions(){
        return $this->belongsToMany(Pemission::class,'permissios_role', 'role_id','permission_role');
    }
   
}
