<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemsStoreRequest;
use App\Models\Lists;
use App\Models\Items;
use DB, Auth;

class ItemsController extends Controller
{
    public function create($id)
    {
        return view('items.create', compact('id'));
    }

    public function store(ItemsStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $message = '';
            if(!is_null($validated)){
                Items::updateOrCreate(
                ['id' => $request->id],
                [
                    'desc' => $request->desc,
                    'list_id' => $request->list_id
                ]);
            }
    
            $message = 'Item added successfully';
            
            if ($request->id) {
                $message = 'Item updated successfully';
            }

            return redirect()->route('list.view', ['id' => $request->list_id])->withSuccess($message);
            
        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }

    public function markAsRead($itemId)
    {
        Items::where('id', $itemId)->update([
            'is_completed' => config('constants.item_is_complete_status.yes')
        ]);

        return redirect()->back()->withSuccess('Item mark as read successfully');
    }

    public function destroy($itemId)
    {
        $item = Items::find($itemId);
        $item->delete();

        return redirect()->back()->withSuccess('Item deleted successfully');
    }
}
