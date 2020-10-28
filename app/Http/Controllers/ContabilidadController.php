<?php

namespace App\Http\Controllers;

use App\Clases\Almacenamiento;
use App\clases\modelosgenerales\Codigocontable;
use App\Contabilidad;
use App\Formatos\Excelmuestreo;
use App\Formatos\Txtexportaciones;
use App\Imports\CodigocontableImport;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()){
            return redirect('login');
        }else{
            $contabilidad = DB::table('codigocontables')->get();
            return view('layouts.contabilidad',['contabilidad'=>$contabilidad]);
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
        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        
        $empresa_id = DB::table('userdatas')->where('user_id','=',$user_id)->get()->first()->empresa_id;
        
        if($request->hasfile('myfile')){
            $this->validate($request, [
                'myfile' => 'mimes:xls,xlsx,txt,csv'
            ]);    
            
            try {
                if($request->csv && $request->excel)
                {
                    return ['error'=>"DEBES SELECCIONAR SOLO UNA OPCION (CSV/EXCEL)"];
                }
                if($request->excel)
                {
                    $ruta = Almacenamiento::guardartemporalmente($username,$request->file('myfile'));
                    Excelmuestreo::aumentarcolumnasempresa($ruta,$empresa_id);
            
                    Excel::import(new CodigocontableImport, $ruta);
                }
                if($request->csv)
                {
                    if($request->delimitador == null)
                    {
                        return ["error"=>"Olvido decirnos que delimitador esta usando"];
                    }
                    else
                    {
                        $data = Txtexportaciones::csv_to_array($request->file('myfile'),$request->delimitador);
                    }   
                    for ($i=0; $i < count($data); $i++) { 
                        $row = $data[$i];

                        for ($i2=0; $i2 < count($row); $i2++) { 
                            $row[$i2] = str_replace(',','',$row[$i2]);
                            if($row[$i2] == "")
                            {
                                
                                if($i == 12 || $i == 13){
                                    $row[$i2] = null;
                                }else{
                                    $row[$i2] = null;
                                }
                                
                            }
                        }

                        if($row[13]!=null)
                        {
                            try {
                                $row[13] = $row[13];
                                $row[13] = str_replace(".", "/", $row[13]);
                                $row[13] = str_replace("-", "/", $row[13]);
                            } catch (\Throwable $th) {
                                $row[13] = null;
                            }
                        }
                        
                        if($row[12]!=null)
                        {
                            try {
                                $row[12] = $row[12];
                                $row[12] = str_replace(".", "/", $row[12]);
                                $row[12] = str_replace("-", "/", $row[12]);
                            } catch (\Throwable $th) {
                                $row[12] = null;
                            }
                        }

                        $registro = new Codigocontable([
                            'id_empresa'=> $empresa_id,
                            'codigo'=> $row[0],
                            'descripcion'=> $row[1]
                        ]);
                        $registro->save();
                    }
                }
            
                Storage::deleteDirectory('public/'.$useremail.'/temporal', true);
                // sleep 1 second because of race condition with HD
                sleep(1);
                // actually delete the folder itself
                Storage::deleteDirectory('public/'.$useremail.'/temporal');  
                //return response()->json($reporte,200);
                $contabilidad = DB::table('codigocontables')->where('empresa_id','=',$empresa_id)->get();
                return $contabilidad;
            } catch (\Throwable $th) {
                return ['errortec'=>$th->getMessage(),'error'=>"Pruebe recargando la pagina, o revisando si su archivo tiene las columnas en el orden que se plantea en las plantillas."];
            }
        }
        else
        {
            $registro = new Codigocontable([
                'id_empresa'=> $empresa_id,
                'codigo'=> $request->codigo,
                'descripcion'=> $request->descripcion
            ]);
            $registro->save();
            $contabilidad = DB::table('codigocontables')->get();
            return $contabilidad;
        }
    }

    public function destroy(Request $request)
    {
        $id_codigocontable = $request->id;
        DB::table('codigocontables')->where('id','=',$id_codigocontable)->delete();
        return redirect('contabilidad/index');
    }
}
