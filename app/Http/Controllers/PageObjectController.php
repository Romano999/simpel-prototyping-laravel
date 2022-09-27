<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageObjectRequest;
use App\Http\Requests\UpdatePageObjectRequest;
use App\Models\PageObject;
use Illuminate\Support\Facades\DB;

class PageObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageObjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageObjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PageObject  $pageObject
     * @return \Illuminate\Http\Response
     */
    public function show(PageObject $pageObject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PageObject  $pageObject
     * @return \Illuminate\Http\Response
     */
    public function edit(PageObject $pageObject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageObjectRequest  $request
     * @param  \App\Models\PageObject  $pageObject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageObjectRequest $request, PageObject $pageObject)
    {
        DB::table('page_objects')->where('id', $pageObject->id)->update([
            'pos_x' => $request->pos_x,
            'pos_y' => $request->pos_y,
            'angle' => $request->angle,
        ]);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PageObject  $pageObject
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageObject $pageObject)
    {
        //
    }
}
