<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTextBoxRequest;
use App\Http\Requests\UpdateTextBoxRequest;
use App\Models\TextBox;
use Illuminate\Support\Facades\DB;

class TextBoxController extends Controller
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
     * @param  \App\Http\Requests\StoreTextBoxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTextBoxRequest $request)
    {
        $textBox = TextBox::create([
            'object_id' => $request->object_id,
        ]);

        return DB::table('text_boxes')->where('id', $textBox->id)->get()[0];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function show(TextBox $textBox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function edit(TextBox $textBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTextBoxRequest  $request
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTextBoxRequest $request, TextBox $textBox)
    {
        DB::table('text_boxes')->where('id', $textBox->id)->update([
            'text' => $request->text,
        ]);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(TextBox $textBox)
    {
        //
    }
}
