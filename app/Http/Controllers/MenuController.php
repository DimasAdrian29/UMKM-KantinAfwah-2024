<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::all();
        return view('menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;

        if ($request->hasFile('gambar')) {
            $menu->gambar = $request->file('gambar')->store('images', 'public');
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;

        if ($request->hasFile('gambar')) {
            if ($menu->gambar){
                Storage::delete('public/'. $menu->gambar);
            }
            $menu->gambar = $request->file('gambar')->store('images', 'public');
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->gambar){
            Storage::delete('public/'. $menu->gambar);
        }

        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
