<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $con=DB::table('contrat')->get();
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

    }

    /**;
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $num=rand(500,500000);
        $con=DB::table('contrat')->insert([
            'num_contrat'=>$num,
            'date_depart'=>$request->input('date_depart'),
            'date_retour_prevue'=>$request->input('date_retour'),
            'num_immatriculation'=>$request->input('mat'),
            'code_client'=>$request->input('code_client')
        ]);

        if($con){
            $res=array('response'=>'Contrat signé');
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
        $num=rand(500,500000);
        $con=DB::table('contrat')->where('num_contrat',$id)->update([
            'date_depart'=>$request->input('date_depart'),
            'date_retour_prevue'=>$request->input('date_retour'),
            'num_immatriculation'=>$request->input('mat'),
            'code_client'=>$request->input('code_client')
        ]);

        if($con){
            $res=array('response'=>'Contrat signé');
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
        //
    }
}
