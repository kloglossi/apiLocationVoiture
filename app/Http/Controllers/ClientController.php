<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cl=DB::table('client')->get();
        if($cl){
            $res=array('response'=>'succes',$cl);
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }
    }

    public function login_in(Request $request){
        $email=$request->input('email');
        $mdp=$request->input('password');

        $con=DB::table('utilisateur')->insert([
            'code_util'=>rand(4000,1500000),
           'email_util'=>$email,
           'nom_util'=>$request->input('nom'),
           'password_util'=>password_hash($mdp,PASSWORD_BCRYPT),
            'idgroupe_utilisateur'=>1
        ]);

        if($con){
            $rep=array('response'=>'bravo ');
            return response()->json($rep,200);
        }else{
            $rep=array('response'=>'données incorrectes');
            return response()->json($rep,404);
        }
    }


    public function login(Request $request){

        $email=$request->input('email');
        $mdp=$request->input('password');

        $hash=\Illuminate\Support\Facades\DB::table('utilisateur')->where([
            'email_util'=>$email
        ])->select('password_util')->value('password_util');

        $login=DB::table('utilisateur')->where([
            'email_util'=>$email
        ])->get();


        if($login && $this->passV($mdp,$hash)){
            $rep=array('response'=>'vous etes conncecte ');
            return response()->json($rep,200);
        }else{
            $rep=array('response'=>'données incorrectes');
            return response()->json($rep,404);
        }
    }


    public function passV($pass,$hash){
        if(password_verify($pass,$hash)){
            return true;
        }else{
            return false;
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
        $code=rand(500,50000);
        $cl=DB::table('client')->insert([
            'code_client'=>$code,
            'nom_client'=>$request->input('nom'),
            'prenoms_client'=>$request->input('prenoms'),
            'date_nais_client'=>$request->input('date'),
            'tel_client'=>$request->input('tel'),
            'email_client'=>$request->input('email'),
            'adresse_client'=>$request->input('adresse')
        ]);

        if($cl){
            $res=array('response'=>'client ajouté');
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
        $cl=DB::table('client')->where('code_client',$id)->update([
            'nom_client'=>$request->input('nom'),
            'prenoms_client'=>$request->input('prenoms'),
            'date_nais_client'=>$request->input('date'),
            'tel_client'=>$request->input('tel'),
            'email_client'=>$request->input('email'),
            'adresse_client'=>$request->input('adresse')
        ]);

        if($cl){
            $res=array('response'=>'Mise à jour effectuée');
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $cl=DB::table('client')->where('code_client',$id)->delete();
        if($cl){
            $res=array('response'=>'client supprimée');
            return response()->json($res,200);
        }else{
            $res=array('response'=>'echec');
            return response()->json($res,404);
        }

    }
}
