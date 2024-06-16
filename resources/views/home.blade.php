@extends('layouts.app')

@section('content')
    <div class="container">
        @guest
            <div class="alert alert-warning" role="alert">
                {{ __('You need to log in.') }}
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
@endsection
