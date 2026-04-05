<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::with('book')
                            ->where('user_id', auth()->id())
                            ->get();
        return view('user.favorite.index',compact('favorites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $userId = auth()->id();
        $bukuId = $request->buku_id;

        $favorite = Favorite::where('user_id', $userId)
                            ->where('buku_id', $bukuId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'Buku berhasil dihapus dari Bookmark');
        }

        Favorite::create([
            'user_id' => $userId,
            'buku_id' => $bukuId,
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambah ke Bookmark');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favorites = Favorite::findOrFail($id);
        $favorites -> delete();

        return redirect()->back()->with('success','Buku Berhasil Di Unfavorit');
    }
}
