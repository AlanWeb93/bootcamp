<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class ActorController extends Controller
{

    public function index(Request $request)
    {
        
        $actors=DB::table('actors')
        ->where('condicion', '=', '1')
        ->orderBy('actors.id', 'desc')->get();
        return $actors;
        
    }

    public function store(Request $request)
    {
        if($request->pass == '12345678'){
            if($request->id_actor === null){
                $actor=new Actor();
            $actor->nombre= $request->nombre;
            $actor->fecha_nacimiento= $request->fecha_nacimiento;
            $actor->condicion = '1';
            $actor->save();
            }else{
                $this->update($request);
            }
            
            //return $actor;
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $actor= Actor::findOrFail($request->id_actor);
            $actor->nombre= $request->nombre;
            $actor->fecha_nacimiento= $request->fecha_nacimiento;
            $actor->save();
        
            //return $actor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $actor= Actor::findOrFail($request->id);
        if($actor->condicion=="1"){
            $actor->condicion= '0';
            $actor->save();
            return $actor;
        }else{
            $actor->condicion= '1';
            $actor->save();
            return $actor;
        }
    }
}
