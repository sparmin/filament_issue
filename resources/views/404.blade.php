@extends('layout.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('404 Page Not Found') }}</div>

                <div class="card-body">
                    <h1>{{ __('Oops!') }}</h1>
                    <p>{{ __('The page you are looking for could not be found.') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
