<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_telepon',
        'alamat',
        'kota',
        'negara',
        'no_identitas',
        'jenis_identitas',
        'jenis_kamar',
        'check_in',
        'check_out',
        'jumlah_tamu',
        'jumlah_malam',
        'harga_per_malam',
        'total_harga',
        'permintaan_khusus',
        'metode_pembayaran',
        'nama_bank',
        'no_rekening',
        'nama_pemegang_kartu',
        'status',
        'kode_booking',
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];

    public static function generateKodeBooking(): string
    {
        do {
            $kode = 'OGAG-' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('kode_booking', $kode)->exists());

        return $kode;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'Menunggu Konfirmasi',
            'confirmed'   => 'Dikonfirmasi',
            'checked_in'  => 'Check In',
            'checked_out' => 'Check Out',
            'cancelled'   => 'Dibatalkan',
            default       => $this->status,
        };
    }
}