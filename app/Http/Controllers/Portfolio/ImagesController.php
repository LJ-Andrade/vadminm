<?php

namespace App\Http\Controllers\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;

class ImagesController extends Controller
{
    public function index()
    {
    	$images = Image::all();
    	$images->each(function($images){
    		$images->article;
    	});

		return view('vadmin.images.index')->with('images', $images);
    }
}
