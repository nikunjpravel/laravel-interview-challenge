@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Items List') }}
					<div class="text-right">
						<a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
						<a href="{{ route('item.create', ['id' => $id]) }}" class="btn btn-primary">Item Add</a>
					</div>
				</div>

				<div class="card-body">
					@if (session('success'))
					<div class="alert alert-success" role="alert">
						{{ session('success') }}
					</div>
					@endif
					@if(count($items) > 0)
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Item Description</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($items as $key => $item)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<td>
									@if ($item->is_completed)
										<del>{{ $item->desc ?? '-' }}</del>
									@else
										<p>{{ $item->desc ?? '-' }}</p>
									@endif
								</td>
								<td>
									@unless ($item->is_completed)
										<a href="{{ route('item.mark_completed', ['itemId' => $item->id]) }}" class="text-success mx-1">
											Mark Completed
										</a>
									@endif
									<a href="{{ route('item.delete', ['itemId' => $item->id]) }}" class="text-danger mx-1">
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
