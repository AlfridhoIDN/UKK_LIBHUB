<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run()
    {
        $masterFiles = [
            'image1.png',
            'image2.png',
            'image3.png',
            'image4.png',
            'image5.png'
        ];

        for ($i = 1; $i <= 20; $i++) {
            
            $randomFile = $masterFiles[array_rand($masterFiles)];
            
            $sourcePath = database_path('seeders/images/' . $randomFile);

            if (File::exists($sourcePath)) {
                $extension = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $hashedName = 'covers/' . Str::random(40) . '.' . $extension;


                Storage::disk('public')->put($hashedName, File::get($sourcePath));

                $book = Book::create([
                    'judul' => 'Judul Buku Dummy Ke-' . $i,
                    'penulis' => 'Penulis Ke-' . $i,
                    'penerbit' => 'Penerbit Gramedumy',
                    'tahun_terbit' => rand(2015, 2024),
                    'cover_image' => $hashedName, 
                    'deskripsi' => 'Ini adalah deskripsi untuk buku nomor ' . $i,
                ]);

                $book->categories()->attach(rand(1, 3));
            }
        }
    }
}