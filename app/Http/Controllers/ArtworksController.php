<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artworks;
use App\Category;
use App\Colors;

class ArtworksController extends Controller
{
    public function index(){

        $artworks = Artworks::filter()->paginate(10);
        $categories = Category::all();
        $colors = Colors::all();

        return view('artworks', compact('artworks', 'categories', 'colors'));
    }

    public function show($artwork) {
        $artwork = Artworks::where('slug', $artwork)->firstOrFail();
        $related = Artworks::where('artists_id', $artwork->artists->id)->where('id', '!=', $artwork->id)->get();
        
        return view('artworksdetail', compact('artwork', 'related'));
    }  

    public function search(Request $request) {
        $query = $request->input('query');
        $artworks = Artworks::where('title', 'like', "%$query%")->paginate(10);

        return view('searchpage')->with('artworks', $artworks);
    }
}
