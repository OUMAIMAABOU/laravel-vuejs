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
    public function index()
    {
    
            $Etudiant=Etudiant::all();
        return response()->json($Etudiant);

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
        'nom' =>$params['nom'],
        'prenom' => $params['prenom'],
        'Age' => $params['Age'],
        'genre' => $params['genre'] ,
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
    public function edit(Etudiant $etudiant)
    {
        $etudiants = Etudiant::get();
   
        $etudiants=Etudiant::find($etudiant);
        // return view('edite', compact('etudiants'));
        return response()->json( $etudiants);


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
        $etudiant->update($request->all()) ;
return response()->json([
    'etudients'=>$etudiant
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
        try {
            $etudiant->delete();
        } catch (\Exception $ex) {
            return responseFailed($ex->getMessage(), Response::HTTP_FORBIDDEN);
        }

        return responseSuccess();
    }
}
