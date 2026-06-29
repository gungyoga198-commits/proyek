<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'room_id',
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
        'tipe_pembayaran',   // lunas | dp
        'jumlah_dp',         // 50% dari total_harga jika dp
        'batas_bayar',       // created_at + 12 jam
        'nama_bank',         // BCA | BRI | BNI | MANDIRI | PAYPAL
        'no_rekening',
        'nama_pemegang_kartu',
        'status',
        'kode_booking',
    ];

    protected $casts = [
        'check_in'    => 'date',
        'check_out'   => 'date',
        'batas_bayar' => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public static function generateKodeBooking(): string
    {
        do {
            $kode = 'BUKYUK-' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('kode_booking', $kode)->exists());

        return $kode;
    }

    // ── ACCESSOR ────────────────────────────────────────────────────
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

    // Apakah sudah melewati batas bayar dan masih pending?
    public function getIsTerlambatBayarAttribute(): bool
    {
        return $this->status === 'pending'
            && $this->batas_bayar
            && Carbon::now()->gt($this->batas_bayar);
    }

    // Sisa waktu pembayaran dalam format human-readable
    public function getSisaWaktuBayarAttribute(): ?string
    {
        if (!$this->batas_bayar || $this->status !== 'pending') return null;
        $diff = Carbon::now()->diff($this->batas_bayar);
        if (Carbon::now()->gt($this->batas_bayar)) return 'Waktu habis';
        return $diff->h . 'j ' . $diff->i . 'm';
    }

    // Jumlah yang harus dibayar sekarang
    public function getJumlahHarusBayarAttribute(): float
    {
        if ($this->tipe_pembayaran === 'dp') {
            return $this->jumlah_dp ?? ($this->total_harga * 0.5);
        }
        return $this->total_harga;
    }
}
