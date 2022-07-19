<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\EtudiantResources;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;



class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $data = Etudiant::query()->when(!empty($params['keyword']), function (Builder $query) use ($params) {
            $query->where(function ($q) use ($params) {
                $q->where('nom', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('prenom', 'like', '%' . $params['keyword'] . '%');
            });
        })
            ->paginate($params['page'] ?? 10);


        return EtudiantResources::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $etudiant = Etudiant::create([
            'nom' => $params['nom'],
            'prenom' => $params['prenom'],
            'Age' => $params['Age'],
            'genre' => $params['genre'],
        ]);
        return $etudiant;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        return new EtudiantResources($etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $request)
    {
        // $etudiants = Etudiant::get();

        // $etudiants=Etudiant::find($etudiant);
        // // return view('edite', compact('etudiants'));
        // return response()->json( $etudiants);
        $key = trim($request->get('q'));

        $posts = Etudiant::query()
            ->where('nom', 'like', "%{$key}%")
            ->orWhere('prenom', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();
        return $posts;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $etudiant->update($request->all());
        return response()->json([
            'etudients' => $etudiant
        ]);
        // $etudiant = Etudiant::create([
        //     'nom' =>$params['nom'],
        //     'prenom' => $params['prenom'],
        //     'Age' => $params['Age'],
        //     'genre' => $params['genre'] ,
        // ]);
        // return $etudiant;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {

        $etudiant->delete();

        return "Bien supprimer";
    }
}
