<?php

namespace App\Http\Controllers;

use App\Models\Rectangle;
use App\Http\Requests\StoreRectangleRequest;
use App\Http\Requests\UpdateRectangleRequest;

class RectangleController extends Controller
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
     * @param  \App\Http\Requests\StoreRectangleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRectangleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rectangle  $rectangle
     * @return \Illuminate\Http\Response
     */
    public function show(Rectangle $rectangle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rectangle  $rectangle
     * @return \Illuminate\Http\Response
     */
    public function edit(Rectangle $rectangle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRectangleRequest  $request
     * @param  \App\Models\Rectangle  $rectangle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRectangleRequest $request, Rectangle $rectangle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rectangle  $rectangle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rectangle $rectangle)
    {
        //
    }
}
