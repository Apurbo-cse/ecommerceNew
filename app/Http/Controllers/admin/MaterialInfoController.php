<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\MaterialInfo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MaterialInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materialInfo = MaterialInfo::first();
        return view('admin.materialInfo.index', compact('materialInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.materialInfo.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
        
        ]);

        $data = new MaterialInfo();

        $data->description = $request->description;
        $data->tech_description = $request->tech_description;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $path = 'images/material';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($path, $file_name);
            $data['image'] = $path . '/' . $file_name;
        }

        $data->save();
        Toastr::success('Product successfully create', 'Success');
        return redirect()->route('admin.materialInfo.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialInfo  $materialInfo
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialInfo $materialInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialInfo  $materialInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialInfo $materialInfo)
    {
        $materialInfo = MaterialInfo::first();
        return view('admin.materialInfo.edit', compact('materialInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialInfo  $materialInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate([

            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
        
        ]);

        $data = MaterialInfo::findOrFail($id);
        $data->description = $request->description;
        $data->tech_description = $request->tech_description;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $path = 'images/material';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($path, $file_name);
            $data['image'] = $path . '/' . $file_name;
        }
        $data->save();
        Toastr::success('Material Info successfully updated', 'Success');
        return redirect()->route('admin.materialInfo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialInfo  $materialInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialInfo $materialInfo)
    {
        //
    }
}
