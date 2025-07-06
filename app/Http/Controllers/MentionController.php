<?php
namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\Mention;
use Illuminate\Http\Request;

class MentionController extends Controller
{
    public function index()
    {
        $mentions = Mention::all();
        return view('mentions.index', compact('mentions'));
    }

    public function create()
    {
        $mention = new Mention();
        return view('mentions.create', [
            'mention' => $mention,
            'etablissements' => Etablissement::pluck('Libelee', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'Libelee' => 'required|string|max:255',
            'description' => 'required|string',
            'Etabli_id' => 'required|integer',
        ]);

        Mention::create($validated);
        return redirect()->route('mentions.index')->with('success', 'Mention ajoutée.');
    }

    public function edit(Mention $mention)
    {
        return view('mentions.create', [
            'mention' => $mention,
            'etablissements' => Etablissement::pluck('Libelee', 'id'),
            'selected' => $mention->Etabli_id,
        ]);
    }

    public function update(Request $request, Mention $mention)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'Libelee' => 'required|string|max:255',
            'description' => 'required|string',
            'Etabli_id' => 'required|integer',
        ]);

        $mention->update($validated);
        return redirect()->route('mentions.index')->with('success', 'Mention modifiée.');
    }

    public function destroy(Mention $mention)
    {
        $mention->delete();
        return redirect()->route('mentions.index')->with('success', 'Mention supprimée.');
    }
}