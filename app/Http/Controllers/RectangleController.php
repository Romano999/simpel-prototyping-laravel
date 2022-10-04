<?php

namespace App\Http\Controllers;

use App\Models\Rectangle;
use App\Http\Requests\StoreRectangleRequest;
use App\Http\Requests\UpdateRectangleRequest;
use Illuminate\Support\Facades\DB;

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
        $rectangle = Rectangle::create([
            'object_id' => $request->object_id,
        ]);

        return DB::table('rectangles')->where('id', $rectangle->id)->get()[0];
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
        $data = $request->validated();

        if (is_null($data['fill'])) {
            $data['fill'] = "";
        }

        return $rectangle->update($data);
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
