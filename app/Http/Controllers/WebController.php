<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Article;
use App\Category;
use App\Tag;

class WebController extends Controller
{

	public function __construct()
	{
        // Date convert to passed time plugin
		Carbon::setLocale('es');
	}

    
	public function portfolio(Request $request)
	{

        $articles = Article::search($request->title)->orderBy('id', 'DESCC')->where('status', 'active')->paginate(12);
        $articles->each(function($articles){
            $articles->category;
            $articles->images;
        }); 

		// $articles = Article::orderBy('id', 'DESC')->paginate(10);
		// $articles->each(function($articles){
		// 	$articles->category;
		// 	$articles->images;
		// }); 
    	return view('web.portfolio.portfolio')
    	->with('articles', $articles);
    }


    public function searchCategory($name)
    {
        $category = Category::SearchCategory($name)->first();
        $articles=$category->article()->paginate(12);
        $articles->each(function($articles){
                $articles->category;
                $articles->images;
        });
        return view('web.portfolio.portfolio')->with('articles', $articles);
    }

    public function searchTag($name)
    {
        $tag = Tag::SearchTag($name)->first();
        $articles = $tag->article()->paginate(12);
        $articles->each(function($articles){
                $articles->category;
                $articles->images;
        });
        return view('web.portfolio.portfolio')->with('articles', $articles);
    }

    public function viewArticle($id)
    {
        $article = Article::find($id);
        $article->each(function($article){
                $article->category;
                $article->images;
                $article->tags;
                $article->colors;
        });

        return view('web.portfolio.article')->with('article', $article);
    }

    public function showWithSlug($slug) {

        $article = Article::where('slug', '=', $slug)->first();
        // dd($article);
        return view('web.portfolio.article')->with('article', $article);
    }

    public function home()
    {
        $categories = Category::all();
        
        return view('web')->with('categories', $categories);
    }

    public function contact()
    {  
        return view('contacto');
    }


}
