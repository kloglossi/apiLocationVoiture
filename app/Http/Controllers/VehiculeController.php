<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $v=DB::table('vehicule')->get();
        if ($v){
            return response()->json($v,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
    }


    public function test(){
        return response()->json(['test'=>'echo'],200);
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

        //Get filename with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get extension
       $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        // Uplaod image
        $path= $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);


        $v=DB::table('vehicule')->insert([
           'num_immatriculation'=>$request->input('num'),
            'carburant'=>$request->input('carburant'),
            'capacite'=>$request->input('capacite'),
            'marque'=>$request->input('marque'),
            'modele'=>$request->input('modele'),
            'couleur'=>$request->input('couleur'),
            'cout_par_jour'=>$request->input('cout'),
            'cover_image'=>$filenameToStore
        ]);

        if($v){
            $res=array('response'=>'Vehicule a été Ajouté');
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v=DB::table('vehicule')->where('num_immatriculation',$id)->update([
            'carburant'=>$request->input('carburant'),
            'capacite'=>$request->input('capacite'),
            'marque'=>$request->input('marque'),
            'couleur'=>$request->input('couleur'),
            'cout_par_jour'=>$request->input('cout')
        ]);



        if($v){
            $res=array('response'=>'Vehicule a été mise à jour');
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cl=DB::table('vehicule')->where('num_immatriculation',$id)->delete();
        if($cl){
            $res=array('response'=>'Vehicule supprimé');
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
    }
}
