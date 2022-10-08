<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTriangleRequest;
use App\Http\Requests\UpdateTriangleRequest;
use App\Models\Triangle;
use Illuminate\Support\Facades\DB;

class TriangleController extends Controller
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
     * @param  \App\Http\Requests\StoreTriangleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTriangleRequest $request)
    {
        $triangle = Triangle::create([
            'object_id' => $request->object_id,
        ]);

        return DB::table('triangles')->where('id', $triangle->id)->get()[0];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Triangle  $triangle
     * @return \Illuminate\Http\Response
     */
    public function show(Triangle $triangle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Triangle  $triangle
     * @return \Illuminate\Http\Response
     */
    public function edit(Triangle $triangle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTriangleRequest  $request
     * @param  \App\Models\Triangle  $triangle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTriangleRequest $request, Triangle $triangle)
    {
        $data = $request->validated();

        if (is_null($data['fill'])) {
            $data['fill'] = "";
        }

        return $triangle->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Triangle  $triangle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Triangle $triangle)
    {
        //
    }
}
