<?php

namespace App\Http\Controllers;

use App\Models\PageObject;
use App\Http\Requests\StorePageObjectRequest;
use App\Http\Requests\UpdatePageObjectRequest;

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
        //
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
