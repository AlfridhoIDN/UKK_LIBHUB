<?php

namespace App\Http\Controllers;
use App\Models\Loan;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        
        $loans = Loan::with(['user', 'book'])
                    ->where('status_peminjaman', $status)
                    ->where('status_peminjaman', '!=', 'dikembalikan') 
                    ->latest()
                    ->paginate(10);

        return view('admin.md-loan.index', compact('loans', 'status'));
    }

    public function view()
    {
        $activeLoans = Loan::with('book')
            ->where('user_id', auth()->id())
            ->where('status_peminjaman', 'accepted')
            ->orderBy('tanggal_pengembalian', 'asc')
            ->get();

        return view('user.loan.index', compact('activeLoans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $book = Book::findOrFail($id);
        return view('user.loan.create',compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        ]);

        Loan::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => 'pending',
        ]);

        return redirect()->route('user.loan')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        $loan->update([
            'status_peminjaman' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
