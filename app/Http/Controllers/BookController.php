<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.md-book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.md-book.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit'  => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric',
            'category_id' => 'required|exists:kategori_buku,id', 
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'  => 'nullable|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        $book = Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi' => $request->deskripsi,
            'cover_image' => $imagePath,
        ]);

        $book->categories()->attach($request->category_id);

        return redirect()->route('book.index')->with('success', 'Data buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return view('admin.md-book.show',compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.md-book.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric',
            'category_id' => 'required|exists:kategori_buku,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'  => 'nullable|string'
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit', 'deskripsi']);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        $book->categories()->sync($request->category_id);

        return redirect()->route('book.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover_image) {
        // 2. Hapus file dari disk 'public'
        Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
        return redirect()->route('book.index')->with('success','Data buku berhasil dihapus!');
    }
}
