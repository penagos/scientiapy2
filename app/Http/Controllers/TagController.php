<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    const PAGINATION_FACTOR = 25;

    public function index()
    {
        return view('tags.index', ['tags' => Tag::with('questions')->paginate(self::PAGINATION_FACTOR)]);
    }

    public function search($query)
    {
        // API request
        // TODO: some fuzzy search capability would be preferred
        return response()->json(Tag::where('tag', 'LIKE', '%'.$query.'%')->get()->map(function ($tag) {
            return $tag->tag;
        }));
    }
}
