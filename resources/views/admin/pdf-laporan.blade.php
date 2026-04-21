<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1f2937; background: #fff; }

    /* HEADER */
    .header { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); color: white; padding: 28px 36px; position: relative; overflow: hidden; }
    .header::after { content: ''; position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background: rgba(234,179,8,0.15); border-radius: 50%; }
    .header::before { content: ''; position: absolute; bottom: -20px; right: 80px; width: 100px; height: 100px; background: rgba(234,179,8,0.1); border-radius: 50%; }
    .header-inner { display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 1; }
    .hotel-name { font-size: 22px; font-weight: 700; letter-spacing: 3px; color: #fbbf24; }
    .hotel-sub  { font-size: 10px; letter-spacing: 4px; color: rgba(255,255,255,0.6); margin-top: 2px; text-transform: uppercase; }
    .doc-title  { text-align: right; }
    .doc-title h2 { font-size: 16px; font-weight: 700; color: white; }
    .doc-title p  { font-size: 9px; color: rgba(255,255,255,0.5); margin-top: 3px; }

    /* GOLD LINE */
    .gold-line { height: 3px; background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b); }

    /* INFO BAR */
    .info-bar { background: #fefce8; border-bottom: 1px solid #fde68a; padding: 10px 36px; display: flex; justify-content: space-between; align-items: center; }
    .info-item label { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #92400e; font-weight: 700; }
    .info-item p { font-size: 11px; font-weight: 600; color: #78350f; margin-top: 1px; }

    /* CONTENT */
    .content { padding: 20px 36px; }

    /* STATS */
    .stats-grid { display: flex; gap: 12px; margin-bottom: 20px; }
    .stat-box { flex: 1; border-radius: 10px; padding: 14px; text-align: center; }
    .stat-box.total    { background: #f8fafc; border: 1px solid #e2e8f0; }
    .stat-box.income   { background: #f0fdf4; border: 1px solid #bbf7d0; }
    .stat-box.confirm  { background: #eff6ff; border: 1px solid #bfdbfe; }
    .stat-box.cancel   { background: #fff1f2; border: 1px solid #fecdd3; }
    .stat-box .num  { font-size: 22px; font-weight: 800; }
    .stat-box .lbl  { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; margin-top: 3px; }
    .stat-box.total  .num { color: #374151; } .stat-box.total  .lbl { color: #9ca3af; }
    .stat-box.income .num { color: #16a34a; } .stat-box.income .lbl { color: #4ade80; }
    .stat-box.confirm .num { color: #2563eb; } .stat-box.confirm .lbl { color: #93c5fd; }
    .stat-box.cancel  .num { color: #dc2626; } .stat-box.cancel  .lbl { color: #fca5a5; }

    /* SECTION TITLE */
    .section-title { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #374151; border-left: 3px solid #f59e0b; padding-left: 10px; margin-bottom: 10px; }

    /* TABLE */
    table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
    thead tr { background: #1f2937; color: white; }
    thead th { padding: 8px 10px; text-align: left; font-size: 8px; letter-spacing: 1px; text-transform: uppercase; font-weight: 700; }
    tbody tr:nth-child(even) { background: #f9fafb; }
    tbody tr:nth-child(odd)  { background: #ffffff; }
    tbody td { padding: 8px 10px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .kode { font-family: monospace; color: #d97706; font-weight: 700; font-size: 9px; }
    .nama { font-weight: 600; color: #111827; }
    .sub  { font-size: 8px; color: #9ca3af; margin-top: 1px; }
    .harga { font-weight: 700; color: #1f2937; }
    tfoot tr { background: #1f2937; color: white; }
    tfoot td { padding: 10px 10px; font-weight: 700; font-size: 10px; }

    /* STATUS BADGES */
    .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .badge-pending   { background: #fef3c7; color: #92400e; }
    .badge-confirmed { background: #dbeafe; color: #1e40af; }
    .badge-checkin   { background: #dcfce7; color: #166534; }
    .badge-checkout  { background: #f3f4f6; color: #374151; }
    .badge-cancelled { background: #fee2e2; color: #991b1b; }

    /* FOOTER */
    .footer { background: #1f2937; color: rgba(255,255,255,0.5); padding: 14px 36px; display: flex; justify-content: space-between; font-size: 8px; margin-top: 20px; }
    .footer strong { color: #fbbf24; }
</style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-inner">
            <div>
                <div class="hotel-name">OGAG HOTEL</div>
                <div class="hotel-sub">Resort & Hospitality</div>
            </div>
            <div class="doc-title">
                <h2>LAPORAN RESERVASI</h2>
                <p>Dicetak: {{ now()->format('d M Y, H:i') }} WIB</p>
            </div>
        </div>
    </div>
    <div class="gold-line"></div>

    {{-- INFO BAR --}}
    <div class="info-bar">
        <div class="info-item">
            <label>Periode Laporan</label>
            <p>
                @if($dari && $sampai)
                    {{ \Carbon\Carbon::parse($dari)->format('d M Y') }} — {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }}
                @elseif($dari)
                    Sejak {{ \Carbon\Carbon::parse($dari)->format('d M Y') }}
                @elseif($sampai)
                    Sampai {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }}
                @else
                    Semua Waktu
                @endif
            </p>
        </div>
        <div class="info-item">
            <label>Total Reservasi</label>
            <p>{{ $reservations->count() }} Reservasi</p>
        </div>
        <div class="info-item">
            <label>Total Pendapatan</label>
            <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="info-item">
            <label>Dikeluarkan Oleh</label>
            <p>Admin OGAG Hotel</p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- STATS --}}
        <div class="stats-grid">
            <div class="stat-box total">
                <div class="num">{{ $reservations->count() }}</div>
                <div class="lbl">Total Reservasi</div>
            </div>
            <div class="stat-box income">
                <div class="num">Rp {{ number_format($totalPendapatan/1000000, 1) }}jt</div>
                <div class="lbl">Total Pendapatan</div>
            </div>
            <div class="stat-box confirm">
                <div class="num">{{ $reservations->whereIn('status',['confirmed','checked_in','checked_out'])->count() }}</div>
                <div class="lbl">Terkonfirmasi</div>
            </div>
            <div class="stat-box cancel">
                <div class="num">{{ $reservations->where('status','cancelled')->count() }}</div>
                <div class="lbl">Dibatalkan</div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="section-title">Detail Riwayat Reservasi</div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>Nama Tamu</th>
                    <th>Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Malam</th>
                    <th>Harga/Malam</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $i => $r)
                @php
                    $badgeClass = match($r->status) {
                        'pending'     => 'badge-pending',
                        'confirmed'   => 'badge-confirmed',
                        'checked_in'  => 'badge-checkin',
                        'checked_out' => 'badge-checkout',
                        'cancelled'   => 'badge-cancelled',
                        default       => 'badge-checkout',
                    };
                    $badgeLabel = match($r->status) {
                        'pending'     => 'Menunggu',
                        'confirmed'   => 'Konfirmasi',
                        'checked_in'  => 'Check In',
                        'checked_out' => 'Selesai',
                        'cancelled'   => 'Batal',
                        default       => $r->status,
                    };
                @endphp
                <tr>
                    <td style="color:#9ca3af; text-align:center;">{{ $i + 1 }}</td>
                    <td><span class="kode">{{ $r->kode_booking }}</span></td>
                    <td>
                        <div class="nama">{{ $r->nama_lengkap }}</div>
                        <div class="sub">{{ $r->email }}</div>
                    </td>
                    <td>{{ $r->jenis_kamar }}</td>
                    <td>{{ $r->check_in->format('d M Y') }}</td>
                    <td>{{ $r->check_out->format('d M Y') }}</td>
                    <td style="text-align:center; font-weight:600;">{{ $r->jumlah_malam }}</td>
                    <td>Rp {{ number_format($r->harga_per_malam, 0, ',', '.') }}</td>
                    <td class="harga">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</td>
                    <td style="color:#6b7280; font-size:8px;">{{ ucwords(str_replace('_',' ',$r->metode_pembayaran)) }}</td>
                    <td><span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span></td>
                </tr>
                @empty
                <tr><td colspan="11" style="text-align:center; padding:20px; color:#9ca3af;">Tidak ada data</td></tr>
                @endforelse
            </tbody>
            @if($reservations->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="8" style="text-align:right; letter-spacing:1px; font-size:9px;">TOTAL PENDAPATAN (Terkonfirmasi & Selesai)</td>
                    <td colspan="3" style="color:#fbbf24; font-size:12px;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>

    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <span>© {{ date('Y') }} <strong>OGAG Hotel</strong> — Dokumen ini dibuat secara otomatis oleh sistem.</span>
        <span>Laporan Reservasi | Dicetak: {{ now()->format('d M Y H:i') }} WIB</span>
    </div>

</body>
</html>