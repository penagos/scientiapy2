<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function search($query)
    {
        // TODO: some fuzzy search capability would be preferred
        return response()->json(Tag::where('tag', 'LIKE', '%'.$query.'%')->get()->map(function ($tag) {
            return $tag->tag;
        }));
    }
}
