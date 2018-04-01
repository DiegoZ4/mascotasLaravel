<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->paginate(5);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => 'required|min:4|max:120',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:4|max:120',
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        Flash::success("Se ha registrado con exito");

        return redirect()->route('users.index');
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
        $user = User::find($id);
        //dd($user);
        return view('admin.users.edit')->with('user', $user);
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        //$user->fill($request->all());
        $user->save();

        Flash::success("El usuario ".$user->name." se ha editado con exito!");

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Flash::error("El usuario ".$user->name." ha sido borrado correctamente");

        return redirect()->route('users.index');
    }

    public function checkAuth(Request $request){
      $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password')
      ];

      //dd($credentials);

      //si el login esta modal
      if(!Auth::attempt($credentials)){
        //echo "logueo mal";
        return response('Username password does not match', 403);

      }

      /*if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return response(Auth::user(), 201);
        }*/
      //dd(Auth::user());
      return response(Auth::user(), 201);
    }
}
