@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Add Item') }}
					<div class="text-right">
						<a href="{{ url()->previous() }}" class="btn btn-secondary">back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('items.store') }}" method="post" class="form-group">
						@csrf
						<input type="hidden" name="list_id" value="{{ $id }}">
						<label for="desc">Item Description</label>
						<input type="text" autofocus name="desc" id="desc" placeholder="Please enter Item Description..."
						  class="form-control @error('desc') is-invalid @enderror" required>
						@error('desc')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror

						<button class="btn btn-primary mt-2" type="submit">
							Submit
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection