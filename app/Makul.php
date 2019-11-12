<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    protected $table = 'makul';
    protected $fillable =['kode','nama','semester'];

    public function sisswa()
    {
        return $this->belongsToMany(Sisswa::class)->withPivot(['nilai']);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}

