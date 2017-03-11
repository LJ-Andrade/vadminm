<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Article;

class VadminController extends Controller
{

    public function __construct()
    {
        // Date convert to passed time plugin
        Carbon::setLocale('es');
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users    = User::orderBy('id', 'ASC')->where('type','member')->get();
        
        $articles = Article::search($request->title)->limit(6)->orderBy('id', 'DESCC')->get();
        $articles->each(function($articles){
            $articles->category;
            $articles->user;
            $articles->images;
        });
      
    
        return view('vadmin')
            ->with('articles', $articles)
            ->with('users', $users);

    }


}
