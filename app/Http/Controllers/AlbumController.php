<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller {

    public function index() {
        $albuns = Album::all();

        return view('albuns.index', compact('albuns'));
    }


    public function create() {
        $artistas = \App\Models\Artista::all();
        return view('albuns.create', compact('artistas'));
    }


    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'capa_url' => 'nullable|url',
            'nome' => 'string',
            'artista_id' => 'required|exists:artistas,id'
        ]);

        Album::create($request->all());

        return redirect()->route('albuns.index')->with('sucesso', 'Álbum cadastrado com sucesso!');
    }

    public function show($id) {
        $album = Album::with('musicas')->findOrFail($id);

        return view('albuns.show', compact('album'));
    }

    public function destroy($id) {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('albuns.index')->with('sucesso', 'Álbum e suas faixas foram excluídos!');
    }
}
