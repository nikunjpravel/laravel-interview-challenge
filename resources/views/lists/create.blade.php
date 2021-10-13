@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Create List') }}
					<div class="text-right">
						<a href="{{ route('home') }}" class="btn btn-secondary">back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('list.store') }}" method="post" class="form-group">
						@csrf
						<label for="list_name">List Name</label>
						<input type="text" autofocus name="list_name" id="list_name" placeholder="Please enter List Name..."
						  class="form-control @error('list_name') is-invalid @enderror" required>
						@error('list_name')
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