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
                 if($request->hasFile('img')) {
                    $imagen = $request->file('img');
                    $filename = time() . '.' . $imagen->getClientOriginalExtension();
                    $path = public_path('imagenes');
                    //$destinationPath = public_path('/images/productImages/');
                    $imagen->move($path, $filename);
                    
                /*}
                //if($request->hasFile('imagen'))
                //{
                    $imagen= $request->file('imagen');
                    $filename= time(). '.'. $imagen->getClientOriginalExtension();
                    Image::make($imagen)->resize(300,300)->save(public_path('perfil/'.$filename));

                    $user=Auth::user();
                    $user->imagen =$filename;
                    $user->save();
                //}
                $path = 'files/';
                $file = $request->file('img');
                $file_name = time().'_'.$file->getClientOriginalName();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');


               if($upload){*/
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
