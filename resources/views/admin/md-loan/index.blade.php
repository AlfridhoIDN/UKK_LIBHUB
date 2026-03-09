@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Peminjaman</h1>
            <p class="text-sm text-slate-500 font-medium">Kelola alur sirkulasi buku perpustakaan.</p>
        </div>
    </div>

    <div class="flex items-center gap-2 bg-slate-100/50 p-1.5 rounded-[2rem] w-fit border border-slate-100">
        <a href="{{ route('loan.index', ['status' => 'pending']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'pending' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Request
        </a>
        <a href="{{ route('loan.index', ['status' => 'accepted']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'accepted' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Dipinjam
        </a>
        <a href="{{ route('loan.index', ['status' => 'returning']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'returning' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Pengembalian
        </a>
        <a href="{{ route('loan.index', ['status' => 'rejected']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'rejected' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Ditolak
        </a>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Buku & Peminjam</th>
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-6 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 hover:text-emerald-500 hover:border-emerald-200 transition">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <div>
                                    <h3 class="font-black text-slate-800 text-sm leading-tight line-clamp-1">{{ $loan->book->judul }}</h3>
                                    <p class="text-[11px] font-bold text-emerald-500 mt-0.5">@ {{ $loan->user->username }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-slate-300 uppercase leading-none mb-1">Estimasi Pengembalian</span>
                                <span class="text-xs font-bold text-slate-600 italic">
                                    {{ \Carbon\Carbon::parse($loan->tanggal_peminjaman)->format('d M') }} - {{ \Carbon\Carbon::parse($loan->tanggal_pengembalian)->format('d M Y') }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                @if($status == 'pending')
                                    <form action="{{ route('book.loan.update',$loan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="px-5 py-2.5 bg-emerald-500 text-white text-[10px] font-black rounded-xl hover:bg-emerald-600 transition shadow-sm uppercase tracking-widest">Accept</button>
                                    </form>
                                    <form action="{{ route('book.loan.update',$loan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="px-5 py-2.5 bg-white border border-rose-100 text-rose-500 text-[10px] font-black rounded-xl hover:bg-rose-50 transition shadow-sm uppercase tracking-widest">Reject</button>
                                    </form>
                                @elseif($status == 'accepted')
                                    <span class="px-6 py-2 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-xl uppercase tracking-widest flex items-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                        Aktif Meminjam
                                    </span>
                                    <button type="button" 
                                        onclick="printReceipt({
                                            nama: '{{ $loan->user->username }}',
                                            buku: '{{ $loan->book->judul }}',
                                            tgl_pinjam: '{{ \Carbon\Carbon::parse($loan->tanggal_peminjaman)->format('d/m/Y') }}',
                                            tgl_kembali: '{{ \Carbon\Carbon::parse($loan->tanggal_pengembalian)->format('d/m/Y') }}'
                                        })"
                                        class="p-2.5 bg-slate-900 text-white rounded-xl hover:bg-emerald-600 transition shadow-sm">
                                        <i class="fa-solid fa-print"></i>
                                    </button>
                                @elseif ($status == 'returning')
                                    <form action="{{ route('book.loan.update',$loan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dikembalikan">
                                        <button type="submit" class="px-5 py-2.5 bg-emerald-500 text-white text-[10px] font-black rounded-xl hover:bg-emerald-600 transition shadow-sm uppercase tracking-widest">Accept</button>
                                    </form>
                                    <form action="{{ route('book.loan.update',$loan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="px-5 py-2.5 bg-white border border-rose-100 text-rose-500 text-[10px] font-black rounded-xl hover:bg-rose-50 transition shadow-sm uppercase tracking-widest">Reject</button>
                                    </form>
                                @else
                                    <span class="px-6 py-2 bg-slate-50 text-slate-400 text-[10px] font-black rounded-xl uppercase tracking-widest">
                                        No Action Needed
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4 border border-slate-100">
                                    <i class="fa-solid fa-inbox text-slate-200 text-2xl"></i>
                                </div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-[0.2em]">Tidak ada data {{ $status }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



<div id="receipt-area" class="hidden">
    <div style="text-align: center; font-family: 'Courier New', Courier, monospace; width: 80mm; padding: 5mm; color: #000;">
        <h2 style="margin: 0; font-size: 18px; font-weight: 900;">LIBHUB</h2>
        <p style="margin: 2px 0; font-size: 12px;">Bukti Peminjaman Buku</p>
        <div style="border-bottom: 1px dashed #000; margin: 5px 0;"></div>
        
        <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
            <tr>
                <td style="padding: 2px 0;">Peminjam:</td>
                <td style="text-align: right; font-weight: bold;" id="rcp-nama"></td>
            </tr>
            <tr>
                <td style="padding: 2px 0; vertical-align: top;">Buku:</td>
                <td style="text-align: right; font-weight: bold;" id="rcp-buku"></td>
            </tr>
        </table>

        <div style="border-bottom: 1px dashed #000; margin: 5px 0;"></div>
        
        <div style="font-size: 11px; text-align: left;">
            <div style="display: flex; justify-content: space-between;">
                <span>Tgl Pinjam:</span>
                <span id="rcp-pinjam"></span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Tgl Kembali:</span>
                <span id="rcp-kembali"></span>
            </div>
        </div>
        <div style="border-bottom: 1px dashed #000; margin: 5px 0;"></div>
        <p style="margin: 2px 0; font-size: 12px;">Akan Di Kenakan Denda Apabila Buku:</p>
        <div style="font-size: 11px; text-align: left;">
            <div style="display: flex; justify-content: space-between;">
                <span>Telat Kembali:</span>
                <span id="rcp-pinjam">Rp.5.000/hari</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Rusak:</span>
                <span id="rcp-pinjam">Rp.50.000</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Kotor:</span>
                <span id="rcp-kembali">Rp.30.000</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Hilang:</span>
                <span id="rcp-kembali">(Ganti Baru)</span>
            </div>
        </div>

        <div style="border-bottom: 1px dashed #000; margin: 5px 0;"></div>
        <p style="font-size: 10px; font-style: italic;">* Harap kembalikan buku tepat waktu.<br>Terima Kasih!</p>
    </div>
</div>
<style>
    @media print {
        body * { visibility: hidden; }
        
        #receipt-area, #receipt-area * { visibility: visible; }
        
        #receipt-area {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 80mm;
            background: white;
            padding: 0;
            margin: 0;
        }

        @page {
            size: 53mm 150mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }
    }
</style>

<script>
function printReceipt(data) {
    document.getElementById('rcp-nama').innerText = data.nama;
    document.getElementById('rcp-buku').innerText = data.buku;
    document.getElementById('rcp-pinjam').innerText = data.tgl_pinjam;
    document.getElementById('rcp-kembali').innerText = data.tgl_kembali;

    window.print();
}
</script>

@endsection