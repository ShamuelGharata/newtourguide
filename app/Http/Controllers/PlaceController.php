<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $categories = \Illuminate\Support\Facades\DB::table('categories')->get();

        $query = \App\Models\Place::query();
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $places = $query->paginate(6);
        $events = \Illuminate\Support\Facades\DB::table('events')->paginate(3);
        $favorites = auth()->check() ? auth()->user()->favorites : collect();

        return view('index', compact('places', 'events', 'favorites', 'categories'));
    }
    public function show($id) 
    {
        $place = Place::with(['reviews.user', 'facilities'])->findOrFail($id);
        return view('details', compact('place'));
    }
}