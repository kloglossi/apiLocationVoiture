<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $con=DB::table('facture')->get();
        if($con){
            $res=array('response'=>'succes',$con);
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
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
        $num=rand(500,500000);
        $fact=DB::table('facture')->insert([
            'num_fact'=>$num,
            'date_fact'=>$request->input('date_fact'),
            'montant_fact'=>$request->input('montant'),
            'tva'=>$request->input('tva'),
            'num_contrat'=>$request->input('contrat')
        ]);

        if($fact){
            $res=array('response'=>'Facture crée');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
