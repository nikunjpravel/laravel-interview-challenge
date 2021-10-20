@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <div class="text-right">
                        <a href="{{ route('list.create') }}" class="btn btn-primary">List Add</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(count($lists) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">List Name</th>
                                <th scope="col">Items</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $key => $list)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $list->list_name ?? '-' }}</td>
                                <td>{{ $list->items->count() ?? 0 }}</td>
                                <td>
                                    <a href="{{ route('list.view', ['id' => $list->id]) }}" class="text-success mx-1">
                                        View
                                    </a>
                                    <a href="{{ route('list.delete', ['id' => $list->id]) }}"
                                      class="text-danger mx-1">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-center">
                        No data found.
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
