<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testname extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getGroup()
    {
        //dd( $this->belongsTo(Labogroup::class,'group_id'));
       
        return $this->belongsTo(Labogroup::class, 'group_id')->select('id','name');
    }
}
