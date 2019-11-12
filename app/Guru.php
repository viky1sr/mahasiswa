<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table='guru';
    protected $fillable=['nama','tlpn','alamat','avatar','jenis_kelamin'];

    public function makul()
    {
        return $this->hasMany(Makul::class);
    }
    public function getAvatarguru()
    {
        if(!$this->avatar){
            return asset('images/default.jpg');
        }

        return asset('images/'.$this->avatar);
    }
}
