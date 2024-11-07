@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{--                content for authenticated users--}}
                @auth
                    <div class="card">
                        <div class="card-header">{{ __('Welcome!') }}</div>
                        <div class="card-body">

                            {{--                            content for authenticated users--}}
                            @cannot('modify data')
                                {{ __("You are logged in as user!") }}
                            @endcan

                            {{--                            content for authenticated admin--}}
                            @can('modify data')
                                {{ __("You are logged in as admin!") }}
                            @endcan

                        </div>
                    </div>
                @endauth

                {{--                content for guests--}}
                @guest
                    <div class="card">
                        <div class="card-header">{{ __('Welcome!') }}</div>
                        <div class="card-body">
                            {{ __('Log in to view the data of companies and employees!') }}
                            <br>
                            {{ __("To edit the data, you need to log in with admin privileges.") }}
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
@endsection
