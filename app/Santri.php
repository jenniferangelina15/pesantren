<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
	protected $table = 'santri';
    protected $fillable = ['nama', 'nik', 'kelas', 'wali', 'alamat', 'no_hp', 'jk', 'status', 'bulan_tagihan', 'password'];

    /**
     * Method One To One 
     */
    // public function user()
    // {
    // 	return $this->belongsTo(User::class);
    // }

    /**
     * Method One To Many 
     */
    public function pembayaran()
    {
    	return $this->hasMany(Pembayaran::class);
    }
}
