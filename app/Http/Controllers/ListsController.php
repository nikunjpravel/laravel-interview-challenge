<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListsStoreRequest;
use App\Models\Lists;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Renderable
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ListsStoreRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ListsStoreRequest $request)
    {
        try {
            // Will return only validated data
            $validated = $request->validated();

            if ($validated) {
                Lists::updateOrCreate(
                ['id' => $request->id],
                [
                    'list_name' => $request->list_name,
                    'created_by' => Auth::id()
                ]);
            } else {
                return redirect('home')->withErrors($request->messages());
            }

            $message = 'List name added.';
            if ($request->id) {
                $message = 'List name updated.';
            }

            return redirect('home')->withSuccess($message);
        } catch (\Exception $e) {
            return redirect('home')->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(int $id): Renderable
    {
        $list = Lists::query()
            ->with('items')
            ->findItemByAuthenticatedUser($id)
            ->first();

        if (! $list) {
            return redirect()->back()->withErrors('List not found.');
        }

        $items = $list->items ?? [];

        return view('items.index', compact('items', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): Response
    {
        $list = Lists::findItemByAuthenticatedUser($id)->first();

        if (! $list) {
            return redirect()->back()->withErrors('List not found.');
        }

        $list->delete();

        return redirect()->back()->withSuccess('List deleted.');
    }
}
