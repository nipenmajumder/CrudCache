<?php

namespace App\Http\Controllers;

use App\crud;
use Illuminate\Http\Request;
use Validator;
use Session;
use Cache;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['crud_data'] = Cache::rememberForever('crud_data', function () {
            return crud::all();
        });

        return view('Crud.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crud_model = new crud;
        $request_data = $request->all();
        $validate = Validator::make($request_data, $crud_model->validation());
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request_data);
        }

        $crud_model->fill($request_data)->save();
        Session::flash('success', 'Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function show(crud $crud)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit['edit_data'] = collect(Cache::get('crud_data'))->where('crud_id', $id)->first();
        return view('Crud.edit', $edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $crud_model = crud::findOrFail($id);
        $request_data = $request->all();
        $validate = Validator::make($request_data, $crud_model->validation());
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request_data);
        }
        $crud_model->fill($request_data)->save();
        Session::flash('success', 'Update Successfully');
        return redirect()->route('crud.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        crud::findOrFail($id)->delete();
        Session::flash('success', 'Delete Successfully');
        return back();
    }
}
