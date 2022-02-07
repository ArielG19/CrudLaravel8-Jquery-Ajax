<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GaleriaController;
use Illuminate\Support\Facades\File;
use App\Models\Image;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('galeria.index');
    }
    public function listarImagenes()
    {
        $imagenes = Image::Orderby('id','desc')->paginate(5);
        //dd($imagenes);
        return view('galeria.listar-imagenes',['imagenes'=>$imagenes]);
             
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
        //dd($request);
        //validacion de informacion
         $validator = \Validator::make($request->all(),[
              'nombre'=>'required|string|unique:images',
              'img'=>'required|image'
           ],[
               'nombre.required'=>'El nombre es requerido',
               'nombre.string'=>'El nombre debe contener solo letras',
               'nombre.unique'=>'El nombre ya existe',
               'img.required'=>'La imagen es requerida',
               'img.image'=>'El archivo tiene que ser una imagen',
           ]);

         //si hay errores
           if(!$validator->passes()){
               return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
           }else{
                 if($request->hasFile('img')) {
                    $imagen = $request->file('img');
                    $filename = time() . '.' . $imagen->getClientOriginalExtension();
                    $path = public_path('imagenes');
                    //$destinationPath = public_path('/images/productImages/');
                    $imagen->move($path, $filename);
                    //almacena datos
                   Image::insert([
                       'nombre'=>$request->nombre,
                       'imagen'=>$filename,
                   ]);

                   //mensaje exitoso
                   return response()->json(['code'=>1,'msg'=>'saved successfully']);
               }
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
        //solicitamos la informacion de la tabla imagenes por id
        $imagenes = Image::FindOrFail($id);
        return response()->json($imagenes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImagenes(Request $request, $id){
        //dd($request->all());
        if($request->ajax()){

                $imagenes = Image::FindOrFail($id);
                $imagenes->nombre = $request->input('updateNombre');
                //dd($imagenes);
                if($request->hasFile('updateImg')) {

                    //eliminar archivo anterior si existe
                    $path = 'imagenes/'.$imagenes->imagen;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    //guardamos archivo nuevo
                    $imagen = $request->file('updateImg');
                    $filename = time() . '.' . $imagen->getClientOriginalExtension();
                    $path = public_path('imagenes');
                    $imagen->move($path, $filename);
                    $imagenes->imagen = $filename;
                }
                //guardamos y devolvemos los datos
                $resultado = $imagenes->save();

                 if($resultado){
                    return response()->json(['success'=>'true', 'mensaje'=>'Se ha actualizado correctamente']);
                }else{
                    return response()->json(['success'=>'false'],'mensaje'=>'No se ha podido actualizar');
                }


        }

    }
    public function update(Request $request, $id)
    {
        

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
