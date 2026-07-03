<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Musica;
use Illuminate\Http\Request;

class MusicaController extends Controller {

    public function index() {
        $musicas = Musica::with('album')->get();

        return view('musicas.index', compact('musicas'));
    }

    public function create() {
        $albuns = Album::all();

        return view('musicas.create', compact('albuns'));
    }

    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'duracao' => 'required|string|max:10',
            'album_id' => 'required|exists:albuns,id',
        ]);

        $musica = Musica::create($request->all());

        return redirect()->route('albuns.show', $musica->album_id)
                         ->with('sucesso', 'Música adicionada com sucesso!');
    }

    public function show($id) {
        $musica = Musica::findOrFail($id);

        return redirect()->route('albuns.show', $musica->album_id);
    }

    public function destroy($id) {
        $musica = Musica::findOrFail($id);
        $albumId = $musica->album_id;
        $musica->delete();

        return redirect()->route('albuns.show', $albumId)
                         ->with('sucesso', 'Música removida com sucesso!');
    }
}
