<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;

class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function indexApi($pet_id)
    {
        $visits = Visit::where('pet_id', $pet_id)->orderBy('id', 'ASC')->get();
        return $visits->toJson();
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
        
        
        $this->validate($request, [
            'clinica' => 'required|min:4|max:100',
            'fecha' => 'required',
            'doctor' => 'required|min:4|max:100',
            'diganostico' => 'required|min:4|max:100',
            'receta' => 'required|min:4|max:100',
            'pet_id' => 'required',
        ]);

        
        $visit = new Visit($request->all());
        $visit->pet_id = 5;

        if($visit->save()){
            return 1;
        }else{
            return 0;
        };
        
    }

    public function storeApi(Request $request, $pet_id)
    {
       

        $this->validate($request, [
            'clinica' => 'required|min:4|max:100',
            'fecha' => 'required',
            'doctor' => 'required|min:4|max:100',
            'diganostico' => 'required|min:4|max:100',
            'receta' => 'required|min:4|max:100',
        ]);

        
        $visit = new Visit($request->all());
        $visit->pet_id = $pet_id;

        if($visit->save()){
            return $visit->id;
        }else{
            return 0;
        };
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visits = Visit::where('id', $id)->orderBy('id', 'ASC')->get();
        return $visits->toJson();
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

    public function updateApi(Request $request, $pet_id, $id)
    {
        $this->validate($request, [
            'clinica' => 'required|min:4|max:100',
            'fecha' => 'required',
            'doctor' => 'required|min:4|max:100',
            'diganostico' => 'required|min:4|max:100',
            'receta' => 'required|min:4|max:100',
        ]);

        $visit = Visit::find($id);
        //dd($request->all());
        $visit->fill($request->all());
        if($visit->save()){
            return $visit->id;
        }else{
            return 0;
        };
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
        $visit = Visit::find($id);
        
        if($visit->delete()){
            return 1;
        }else{
            return 0;
        }
    }
}
