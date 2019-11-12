<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sisswa extends Model
{
    protected $table = 'sisswa';
    protected $fillable = ['nama_depan','nama_belakang','falkutas','jenis_kelamin','tgl_lahir','agama','nilai','alamat','avatar','user_id',];

    public function getAvatar()
    {
        if(!$this->avatar){
            return asset('images/default.jpg');
        }

        return asset('images/'.$this->avatar);
    }
    public function makul()
    {
        return $this->belongsToMany(Makul::class)->withPivot(['nilai'])->withTimeStamps();
    }

    /**
     * @return float
     */
    public function rataRataNilai()
    {
            //ambil nilai rata2
            $total = 0;
            $hitungnilai = 0;
            foreach ($this->makul as $makul){
                $total =$total+$makul->pivot->nilai;
                $hitungnilai++;
        }
        return round($hitungnilai == 0 ? 0 : ($total/$hitungnilai));
    }
    public function nama_lengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }
}

