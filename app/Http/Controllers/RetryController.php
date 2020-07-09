<?php

namespace App\Http\Controllers;

use App\Retry;
use Illuminate\Http\Request;
use Validator;
use Session;
use Cache;

class RetryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['retry_data'] = Cache::rememberForever('retry_data', function () {
            return Retry::all();
        });
        return view('Retry.list', $data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $retry_model = new Retry;
        $request_data = $request->all();
        $validate = Validator::make($request_data, $retry_model->validation());
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request_data);
        }

        $retry_model->fill($request_data)->save();
        Session::flash('success', 'Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Retry  $retry
     * @return \Illuminate\Http\Response
     */
    public function show(Retry $retry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Retry  $retry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit['edit_data'] = collect(Cache::get('retry_data'))->where('r_id', $id)->first();
        return view('Retry.edit', $edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retry  $retry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $retry_model = Retry::findOrFail($id);
        $request_data = $request->all();
        $validate = Validator::make($request_data, $retry_model->validation());
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request_data);
        }
        $retry_model->fill($request_data)->save();
        Session::flash('success', 'Update Successfully');
        return redirect()->route('retry.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retry  $retry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Retry::findOrFail($id)->delete();
        Session::flash('success', 'Delete Successfully');
        return back();
    }
}
