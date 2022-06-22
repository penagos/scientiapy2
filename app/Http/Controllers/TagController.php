<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index', ['tags' => Tag::all()]);
    }

    public function search($tag)
    {
        // TODO: some fuzzy search capability would be preferred
        return response()->json(Tag::where('tag', $tag)->get()->map(function ($tag) {
            return $tag->tag;
        }));
    }
}
