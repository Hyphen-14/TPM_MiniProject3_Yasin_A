@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Travel Wishlist</h1>
    <a href="{{ route('wishlists.create') }}" class="btn btn-primary">Tambah Wishlist</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wishlists as $wishlist)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $wishlist->title }}</td>
                <td>{{ $wishlist->description }}</td>
                <td>{{ $wishlist->category->name }}</td>
                <td>
                    @if($wishlist->image)
                    <img src="{{ asset('storage/' . $wishlist->image) }}" alt="{{ $wishlist->title }}" width="100">
                    @else
                    Tidak ada gambar
                    @endif
                </td>
                <td>
                    <a href="{{ route('wishlists.edit', $wishlist->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('wishlists.destroy', $wishlist->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus wishlist ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada wishlist</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
