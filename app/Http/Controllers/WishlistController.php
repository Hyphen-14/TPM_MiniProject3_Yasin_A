<?php

namespace App\Http\Controllers;

use app\Models\Wishlist;
use app\Models\Category;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //Menampilkan semua wishlist
    public function index() 
    {
        $wishlists = Wishlist::with('category')->get();//Ambil data dari kategori
        return view('wishlist.index', compact('wishlists'));
    }

    //Menampilkan form tambah wishlist (katgori)
    public function create()
    {
        $categories = Category::all();//Ambil semua kategori
        return view('wishlist.create', compact('categories'));
    }

    //Menyimpan wishlist baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'category_id'=>'required|exists:categories,id',//validasi kategori
            'image'=>'required|image',
        ]);

        //Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Wishlist::create ([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Wishlist berhasil ditambahkan');
    }

    //Halaman edit Wishlist
    public function edit(Wishlist $wishlist)
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('wishlist.edit', compact('wishlist', 'categories'));
    }

    //Memperbarui wishlist
    public function update (Request $request, Wishlist $wishlist)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'category_id'=>'required|exists:categories,id',//validasi kategori
            'image'=>'required|image',
        ]);

        //Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images','public');
            $wishlist->image = $imagePath;
        }

        $wishlist->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'category_id'=> $request->category_id,
            'image'=> $request->image,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Wishlist berhasil diperbarui');    
    }

    //Menghapus wishlist
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->image) {
            \Storage::disk('public')->delete($wishlist->image);
        }

        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('success', 'Wishlist berhasil dihapus');
    }
}
