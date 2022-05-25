<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billtest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "billtests";

    public function custommer(){
        return $this->hasOne(Custommer::class,'id','custommer_id');
    }
    public function doctor(){
        return $this->hasOne(Doctor::class,'id','doctor_id')->select('id','name','title');
    }
    public function ousent(){
        return $this->hasOne(Ousent::class,'id','ousent_id')->select('id','name');
    }
    public function testnames(){
         //return $this->belongsTomany(Testname::class,'billnames');
         return $this->belongsTomany(Testname::class,'billnames','billtest_id','testname_id');
    }
  
}
