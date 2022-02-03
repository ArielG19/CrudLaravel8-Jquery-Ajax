<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoriaController;
use App\Models\Category;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('categorias.index');
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

    public function listarCategoria()
    {
        $categorias = Category::Orderby('id','desc')->paginate(5);
        return view('categorias.listar-categorias',['categorias'=>$categorias]);
             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
          //$name = $request->input('name');
        //dd($name);
        $categoria = new Category($request->all());

        $categoria->save();
       if($categoria){
                    //Session::flash('save','Se ha creado correctamente');
                    return response()->json(['success'=>'true']);
                }else{
                    return response()->json(['success'=>'false']);
                }
      //Session::flash('message','Categoria creada correctamente');
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
        $categorias = Category::FindOrFail($id);
        return response()->json($categorias);
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
         if($request->ajax()){

                $categorias =Category::FindOrFail($id);
                //en input amacenamos toda la info del request
                $input = $request->all();
                $resultado = $categorias->fill($input)->save();

                if($resultado){
                    return response()->json(['success'=>'true']);
                }else{
                    return response()->json(['success'=>'false']);
                }
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
