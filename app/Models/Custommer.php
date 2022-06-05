<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Custommer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function billtest(){
       return $this->hasOne(Billtest::class);
    }

    public function province()
    {
      return $this->hasOne(Province::class,'code','province_id');
    }
    public function district()
    {
      return $this->hasOne(District::class,'code','district_id');
    }


}
