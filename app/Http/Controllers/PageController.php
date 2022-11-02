<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentTeam = auth()->user()->currentTeam->id;
        $pages[] = DB::table('pages')->where('team_id', $currentTeam)->get();

        // return compact('pages');
        $pages = Page::where('team_id', '=' , $currentTeam)->get();
        // return compact('pages');
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['team_id'] = auth()->user()->currentTeam->id;
        Page::create($data);

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $pageObjects = DB::table('page_objects')->where('page_id', $page->id)->get();
        $objects = array();

        $text_boxes = DB::table('page_objects')
        ->join('text_boxes', 'text_boxes.object_id', '=', 'page_objects.id')
        ->where('page_objects.page_id', '=', $page->id)
        ->get();
        
        $images = DB::table('page_objects')
        ->join('images', 'images.object_id', '=', 'page_objects.id')
        ->where('page_objects.page_id', '=', $page->id)
        ->get();

        $rectangles = DB::table('page_objects')
        ->join('rectangles', 'rectangles.object_id', '=', 'page_objects.id')
        ->where('page_objects.page_id', '=', $page->id)
        ->get();

        $circles = DB::table('page_objects')
        ->join('circles', 'circles.object_id', '=', 'page_objects.id')
        ->where('page_objects.page_id', '=', $page->id)
        ->get();

        $triangles = DB::table('page_objects')
        ->join('triangles', 'triangles.object_id', '=', 'page_objects.id')
        ->where('page_objects.page_id', '=', $page->id)
        ->get();

        for ($i = 0; $i <= count($text_boxes) - 1; $i++) {
            $objects[] = $text_boxes[$i];
        }

        for ($i = 0; $i <= count($images) - 1; $i++) {
            $objects[] = $images[$i];
        }

        for ($i = 0; $i <= count($rectangles) - 1; $i++) {
            $objects[] = $rectangles[$i];
        }

        for ($i = 0; $i <= count($circles) - 1; $i++) {
            $objects[] = $circles[$i];
        }

        for ($i = 0; $i <= count($triangles) - 1; $i++) {
            $objects[] = $triangles[$i];
        }

        return view('pages.edit', compact('page', 'objects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest $request
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->validated());
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index');
    }
}
