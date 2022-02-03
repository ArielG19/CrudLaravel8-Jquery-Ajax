<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GaleriaController;
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
        //dd($request->name);
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
               $path = 'files/';
               $file = $request->file('img');
               $file_name = time().'_'.$file->getClientOriginalName();

            //$upload = $file->storeAs($path, $file_name);
            $upload = $file->storeAs($path, $file_name, 'public');

               if($upload){
                    //almacena datos
                   Image::insert([
                       'nombre'=>$request->nombre,
                       'imagen'=>$file_name,
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
