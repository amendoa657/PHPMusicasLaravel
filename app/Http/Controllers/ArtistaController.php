<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller {
    public function index()
    {
        $artistas = Artista::all();
        return view('artista.index', compact('artistas'));
    }
    public function create()
    {
        return view('artista.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        Artista::create($request->all());

        return redirect()->route('artista.index')->with('sucesso', 'Artista cadastrado com sucesso!');
    }

    public function show($id)
    {
        // Eager Loading: Carrega o artista trazendo junto todos os seus álbuns
        $artista = Artista::with('albuns')->findOrFail($id);

        return view('artista.show', compact('artista'));
    }

    public function destroy()
    {

    }
}
