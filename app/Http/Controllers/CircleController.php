<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCircleRequest;
use App\Http\Requests\UpdateCircleRequest;
use App\Models\Circle;
use Illuminate\Support\Facades\DB;

class CircleController extends Controller
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
     * @param  \App\Http\Requests\StoreCircleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCircleRequest $request)
    {
        $circle = Circle::create([
            'object_id' => $request->object_id,
        ]);

        return DB::table('circles')->where('id', $circle->id)->get()[0];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function show(Circle $circle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function edit(Circle $circle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCircleRequest  $request
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCircleRequest $request, Circle $circle)
    {
        $data = $request->validated();

        if (is_null($data['fill'])) {
            $data['fill'] = "";
        }

        return $circle->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circle $circle)
    {
        //
    }
}
