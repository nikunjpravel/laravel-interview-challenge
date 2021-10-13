<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListsStoreRequest;
use App\Models\Lists;
use App\Models\Items;
use DB, Auth;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListsStoreRequest $request)
    {
        try {
        // Will return only validated data
        $validated = $request->validated();
        $message = '';
        if(!is_null($validated)){
            Lists::updateOrCreate(
            ['id' => $request->id],
            [
                'list_name' => $request->list_name,
                'created_by' => Auth::id()
            ]);
        }

        $message = 'List name added successfully';
        if ($request->id) {
            $message = 'List name updated successfully';
        }

        return redirect('home')->withSuccess($message);

        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Items::where('list_id', $id)->get();
        
        return view('items.index', compact('items', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = Lists::find($id);
        $list->delete();

        return redirect()->back()->withSuccess('List deleted successfully');
    }
}
