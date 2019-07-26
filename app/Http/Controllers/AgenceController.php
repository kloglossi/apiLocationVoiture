<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ag=DB::table('agence')->get();

        if($ag){
            return response()->json($ag,200);
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
        $code_ag=rand(2000,3450000);
        $agence=DB::table('agence')->insert([
           'code_agence'=>$code_ag,
            'email_agence'=>$request->input('email'),
            'tel_agence'=>$request->input('tel'),
            'adresse_agence'=>$request->input('adresse')
        ]);

        if($agence){
            $res=array('response'=>'Agence cree','succes'=>'true');
            return response()->json($res,200);

        }else{
            $res=array('response'=>'echec','succes'=>'false');
            return response()->json($res,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ag=DB::table('agence')->where('code_agence',$id)->get();

        if($ag){
            return response()->json($ag,200);
        }else{
            $res=array('response'=>'echec','succes','false');
            return response()->json($res,404);
        }
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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $agence=DB::table('agence')->where('code_agence',$id)->update([
            'email_agence'=>$request->input('email'),
            'tel_agence'=>$request->input('tel'),
            'adresse_agence'=>$request->input('adresse')
        ]);

        $loadag=DB::table('agence')->where('code_agence',$id)->get();

        if($agence){
            $res=array('response'=>'mise à jour effectuée',$loadag);
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
    public function destroy($id,Request $request)
    {
        $ag=DB::table('agence')->where('code_agence',$id)->delete();
        if($ag){
            $res=array('response'=>'suppression effectuée','succes','false');
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
    }
}
