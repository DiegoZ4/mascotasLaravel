<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Article;
use App\image;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::search($request->title)->orderBy('id', 'ASC')->paginate(10);
        $articles->each(function($articles){
            $articles->category;
            $articles->user;
        });

        //dd($articles);

        return view('admin.articles.index')->with('articles', $articles);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.articles.create')
            ->with('categories', $categories)
            ->with('tags', $tags);
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
            'title' => 'required|min:4|max:250|unique:articles',
            'desc' => 'required|min:4|max:500',
            'volanta' => 'required|min:4|max:50',
            'category_id' => 'required',
            'content' => 'required|min:10',
            'image' => 'required',
        ]);

        //Manipulacion de archivos de imagenes
        if($request->file()){
            $file = $request->file('image');
            $name = 'mascotas_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/images/articles/';

            $file->move($path, $name);
        }

        $article = new Article($request->all());
        $article->user_id = \Auth::user()->id;
        $article->save();

        $article->tags()->sync($request->tags);

        $image = new Image();
        $image->name = $name;
        $image->article()->associate($article);
        $image->save();

        Flash::success('Se ha creado el artículo '.$article->title.' correctamente.');

        return redirect()->route('articles.index');
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
        $article = Article::find($id);
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->pluck('name', 'id');

        //dd($article->images->first()->name);

        return view('admin.articles.edit')
            ->with('categories', $categories)
            ->with('article', $article)
            ->with('tags', $tags);
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
            'title' => 'required|min:4|max:250|unique:articles,title,'.$id,
            'desc' => 'required|min:4|max:500',
            'volanta' => 'required|min:4|max:50',
            'category_id' => 'required',
            'content' => 'required|min:10',
        ]);

        $article = Article::find($id);
        $article->fill($request->all());
        if($request->public == null){
           $article->public = 0; 
        }
        $article->save();

        $article->tags()->sync($request->tags);

        //Manipulacion de archivos de imagenes
        if($request->file()){
            $file = $request->file('image');
            $name = 'mascotas_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/images/articles/';
            $file->move($path, $name);

            $image = new Image();
            $image->name = $name;
            $image->article()->associate($article);
            $image->save();
        }

        Flash::success('Se ha creado el artículo '.$article->title.' correctamente.');

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        Flash::error("El artículo ".$article->name." ha sido borrado correctamente");

        return redirect()->route('articles.index');
    }
}
