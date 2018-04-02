<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Pet;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Response;;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->name);
        $pets = pet::search($request->name)->orderBy('id', 'ASC')->paginate(10);
        $pets->each(function($pets){
            $pets->user;
        });

        //dd($pets);

        return view('admin.pets.index')->with('pets', $pets);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.pets.create')
            ->with('users', $users);
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
            'name' => 'required|min:4|max:100',
            'rase' => 'required|min:4|max:100',
            'type' => 'required',
            'user_id' => 'required'
        ]);

        //Manipulacion de archivos de imagenes

        if($request->file()){
            $file = $request->file('image');
            $name = 'mascotas_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/images/pets/';

            $file->move($path, $name);
        }


        $pet = new pet($request->all());
        $pet->save();


        $image = new ImagesPet();
        $image->name = $name;
        $image->pet()->associate($pet);
        $image->save();

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
        $pet = pet::find($id);
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id');

        //dd($pet->imagesPets);

        return view('admin.pets.edit')
            ->with('users', $users)
            ->with('pet', $pet);
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
        $this->validate($request, [
            'name' => 'required|min:4|max:100',
            'rase' => 'required|min:4|max:100',
            'type' => 'required',
            'user_id' => 'required',
        ]);

        $pet = pet::find($id);
        $pet->fill($request->all());
        $pet->save();


        //Manipulacion de archivos de imagenes
        if($request->file()){
            $file = $request->file('image');
            $name = 'mascotas_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/images/pets/';
            $file->move($path, $name);

            $image = new ImagesPet();
            $image->name = $name;
            $image->pet()->associate($pet);
            $image->save();
        }


        Flash::success('Se ha creado la mascota '.$pet->name.' correctamente.');

        return redirect()->route('pets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);
        $pet->delete();

        Flash::error("La mascota ".$pet->name." ha sido borrado correctamente");

        return redirect()->route('pets.index');
    }

    public function indexApi(Request $request)
    {
        //dd((int)$request->user_id);
        //$pets = pet::find((int)$request->user_id);
        $pets = pet::where('user_id', $request->user_id)->get();
        dd($pets);
        //$pets = pet::find($pet[0]->id);
        //$pets = pet::search((int)$request->user_id)->orderBy('id', 'ASC')->paginate(10);
        /*$pet->each(function($pet){
            $pets = pet::find($pet->id);
        });*/

        //dd($pets);

        return response()->json($pets);
    }
}
