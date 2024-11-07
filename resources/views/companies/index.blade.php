@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-8">
            <h1>{{ __("Companies") }}</h1>
        </div>

        {{--        button to add new company for admin users--}}
        @can('modify data')
            <div class="col-4 text-end">
                <a href="{{ route('companies.create') }}">
                    <button class="btn btn-primary">{{ __("Add new company") }}</button>
                </a>
            </div>
        @endcan
    </div>

    {{--    table of companies--}}
    <table class="table align-middle">

        {{--        table head--}}
        <thead>
        <tr>
            <th>{{ __("Company name") }}</th>
            <th>{{ __("Company email") }}</th>
            <th>{{ __("Company logo") }}</th>
            <th>{{ __("Company website") }}</th>

            {{--            actions column for admins--}}
            @can('modify data')
                <th>{{ __("Actions") }}</th>
            @endcan
        </tr>
        </thead>

        {{--        table content--}}
        <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>
                    @if ($company->logo_image_path)
                        <img class="company-logo" src="{{ asset('storage/' . $company->logo_image_path) }}" alt="logo">
                    @endif
                </td>
                <td>{{ $company->website_url }}</td>

                {{--                action buttons for admins--}}
                @can('modify data')
                    <td class="text-center">

                        {{--                        edit button--}}
                        <div class="row mb-2">
                            <a href="{{ route('companies.edit', $company->id) }}"
                               class="btn btn-primary btn-sm">{{ __('Edit') }}</a>

                        </div>

                        {{--                        delete button with confirmation--}}
                        <div class="row">
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('{{ __('Are you sure you want to delete this company?') }}');">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--    display pagination links--}}
    {{ $companies->links() }}
@endsection
