<?php

namespace App\Http\Controllers\admin;

use App\ArtisanInfo;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ArtisanInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artisanInfo = ArtisanInfo::first();
        return view('admin.artisanInfo.index', compact('artisanInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artisanInfo.create');
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

            'desc' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
        
        ]);

        $data = new ArtisanInfo();

        $data->desc = $request->desc;
        $data->sub_desc = $request->sub_desc;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $path = 'images/artisans';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($path, $file_name);
            $data['image'] = $path . '/' . $file_name;
        }

        $data->save();
        Toastr::success('Product successfully create', 'Success');
        return redirect()->route('admin.fairTradeInfo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArtisanInfo  $artisanInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ArtisanInfo $artisanInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArtisanInfo  $artisanInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artisanInfo = ArtisanInfo::first();
        return view('admin.artisanInfo.edit', compact('artisanInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArtisanInfo  $artisanInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'desc' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
        ]);

        $artisanInfo = ArtisanInfo::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'_artisanInfo.'.$image->getClientOriginalExtension();
            $path = 'assets/admin/images';

            if (file_exists(public_path($artisanInfo->image))) {
                unlink(public_path($artisanInfo->image));
            }
            $image->move($path, $imagename);
            $img = $path.$imagename;
        }else{
            $img = $artisanInfo->image;
        }

        $artisanInfo->desc = $request->desc;
        $artisanInfo->sub_desc = $request->sub_desc;
        $artisanInfo->image = $img;
        $artisanInfo->save();
        Toastr::success('Artisan information successfully updated', 'Success');
        return redirect()->route('admin.artisanInfo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArtisanInfo  $artisanInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArtisanInfo $artisanInfo)
    {
        //
    }
}
