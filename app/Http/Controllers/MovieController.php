<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Movie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        if($request){
            $sql=trim($request->get('buscar'));
            $peliculas=DB::table('movies as m')
            ->join('actors as a','m.id_actor', '=', 'a.id')
            ->select('m.id', 'm.titulo', 'm.año', 'm.duracion', 'm.sinopsis', 'm.imagen', 'a.nombre as nombre_actor')
            ->where('m.titulo','LIKE','%'.$sql.'%')
            ->where('m.condicion', '=', '1')
            ->orderBy('m.id', 'desc')
            ->get();

            return $peliculas;
        }
        
    }

    public function show(Request $request)
    {
        return back();
    }

    public function store(Request $request)
    {
        if($request->pass == '12345678'){
            if($request->id_peli === null){
                $movie = new Movie();

                $movie->id_actor = $request->id_actor;
                $movie->titulo = $request->titulo;
                $movie->año = $request->año;
                $movie->duracion= $request->duracion;
                $movie->sinopsis = $request->sinopsis;
                $movie->condicion = '1';

                $file = $request->imagen;
                if($file){
                    $path = public_path('/imgPeliculas');
                    $fileName = time() .'.'. $file->getClientOriginalExtension();
                    $moved = $file->move($path, $fileName);
                    $movie->imagen = $fileName;
                }

                $movie->imagen = 'noimagen.jpg';
                $movie->save();

                /*$filePho = $request->imagen;

                if($filePho != null){
                    $nombre_ext = $request->file('imagen')->getClientOriginalName();
        
                    $nombre_archivo = pathinfo($nombre_ext, PATHINFO_FILENAME);
        
                    $extension = $request->file('imagen')->guessClientExtension();
        
                    $nombre_a_guardar = time().'.'.$extension;
        
                    $path = $request->file('imagen')->storeAs('public/img/peliculas',$nombre_a_guardar);
                }else{
                    $nombre_a_guardar = "noimagen.jpg";
                }
        
                $movie->imagen=$nombre_a_guardar;
                $movie->save();*/

            } else { 
                $this->update($request);
            }
        }
        //return $movie;
    }

    public function update(Request $request)
    {
        
        $movie= Movie::findOrFail($request->id_peli);
        $movie->id_actor = $request->id_actor;
        $movie->titulo= $request->titulo;
        $movie->año= $request->año;
        $movie->duracion= $request->duracion;
        $movie->sinopsis = $request->sinopsis;
        $movie->save();
        
            //return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $movie= Movie::findOrFail($request->id);
        if($movie->condicion=="1"){
            $movie->condicion= '0';
            $movie->save();
            return $movie;
        }else{
            $movie->condicion= '1';
            $movie->save();
            return $movie;
        }
    }


}
