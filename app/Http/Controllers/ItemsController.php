<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemsStoreRequest;
use App\Models\Items;

class ItemsController extends Controller
{
    public function create(int $id)
    {
        return view('items.create', compact('id'));
    }

    public function store(ItemsStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($validated) {
                Items::updateOrCreate(
                ['id' => $request->id],
                [
                    'desc' => $request->desc,
                    'list_id' => $request->list_id
                ]);
            } else {
                return redirect('home')->withErrors($request->messages());
            }

            $message = 'Item added.';
            if ($request->id) {
                $message = 'Item updated.';
            }

            return redirect()->route('list.view', ['id' => $request->list_id])->withSuccess($message);
        } catch (\Exception $e) {
            return redirect('home')->withErrors($e->getMessage());
        }
    }

    public function markCompleted(int $itemId)
    {
        /** @var Items $item */
        $item = Items::findItemByAuthenticatedUser($itemId)->first();

        if (! $item) {
            return redirect()->back()->withErrors('Item not found.');
        }

        $item->is_completed = true;
        $item->save();

        return redirect()->back()->withSuccess('Item completed.');
    }

    public function destroy($itemId)
    {
        $item = Items::findItemByAuthenticatedUser($itemId)->first();

        if (! $item) {
            return redirect()->back()->withErrors('Item not found.');
        }

        $item->delete();

        return redirect()->back()->withSuccess('Item deleted.');
    }
}
