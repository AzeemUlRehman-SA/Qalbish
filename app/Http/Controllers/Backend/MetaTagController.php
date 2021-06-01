<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;

class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meta_tags = MetaTag::all();

        return view('backend.meta-tags.index', compact('meta_tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.meta-tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'route' => 'required',
            'description' => 'required',
            'keywords' => 'required'
        ]);
        MetaTag::create([
            'title' => $request->title,
            'slug' => $request->title,
            'route' => $request->route,
            'description' => $request->description,
            'keywords' => $request->keywords,
        ]);
        return redirect()->route('admin.meta-tags.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Meta Tag created successfully.'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta_tags = MetaTag::find($id);
        return view('backend.meta-tags.edit', compact('meta_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $meta_tags = MetaTag::find($id);
        $this->validate($request, [
            'title' => 'required',
            'route' => 'required',
            'description' => 'required',
            'keywords' => 'required'
        ]);
        $meta_tags->update([
            'title' => $request->title,
            'slug' => $request->title,
            'route' => $request->route,
            'description' => $request->description,
            'keywords' => $request->keywords,
        ]);
        return redirect()->route('admin.meta-tags.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Meta Tag updated successfully.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
