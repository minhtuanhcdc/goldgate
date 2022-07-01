<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billtest extends Model
{
    use HasFactory;
    protected $guarded = ['id','hpv_code'];
    protected $table = "billtests";
    protected $hidden = ['primary_key'];
    public function custommer(){
        return $this->hasOne(Custommer::class,'id','custommer_id')->with(['province','district']);
    }
    public function doctor(){
        return $this->hasOne(Doctor::class,'id','doctor_id')->select('id','name','title');
    }
    public function ousent(){
        return $this->hasOne(Ousent::class,'id','ousent_id');
    }
    public function testnames(){
     //dd($this->belongsTomany(Testname::class,'billnames','billtest_id','testname_id'));
         return $this->belongsTomany(Testname::class,'billnames','billtest_id','testname_id');
    }
    public function results(){
        // dd($this->hasMany(Result::class,'bill_id','id'));
        //$this->primaryKey = 'hpv_code';
         return $this->belongsTomany(Testelement::class,'results','bill_id','element_id')->select('element_id','result');
    }
    // public function province(){
    //      //return $this->belongsTomany(Testname::class,'billnames');
    //      return $this->hasOneThrough(Custommeraddress::class,Province::class,'custommer_id','code');
    // }
    public function district(){
        // dd($this->hasOneThrough(District::class,Custommeraddress::class, 'custommer_id','id'));
         return $this->hasOneThrough(District::class,Custommeraddress::class, 'district_id','code');
    }
    public function ward(){
         //return $this->belongsTomany(Testname::class,'billnames');
         return $this->hasOneThrough(Ward::class,Custommeraddress::class, 'custommer_id','id');
    }
    public function phone(){
         //return $this->belongsTomany(Testname::class,'billnames');
         return $this->belongsTo(Custommeraddress::class, 'custommer_id','id');
    }
    public function imageLeft(){
         //return $this->belongsTomany(Testname::class,'billnames');
        // return $this->belongsTo(ImageThinprep::class, 'thinprep_code','thinprep_code');
         return $this->belongsTo(ImageThinprep::class, 'thinprep_code','thinprep_code');
    }

    public function cutommerupdate(){
          return $this->hasOne(Custommer::class);
    }
    public function resulthpvs(){
        // dd($this->hasMany(Result::class,'bill_id','id'));
        $this->primaryKey = 'hpv_code';
         return $this->belongsTomany(Testelement::class,'results','hpv_code','element_id')->select('element_id','result');
    }


}
