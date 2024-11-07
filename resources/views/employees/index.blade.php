@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h1>{{ __("Employees") }}</h1>
        </div>

        {{--        button to add new employee for admin users--}}
        @can('modify data')
            <div class="col-4 text-end">
                <a href="{{ route('employees.create') }}">
                    <button class="btn btn-primary">{{ __("Add new employee") }}</button>
                </a>
            </div>
        @endcan
    </div>

    {{--    table of employees--}}
    <table class="table">

        {{--        table head--}}
        <thead>
        <tr>

            {{--            name order in hungarian--}}
            @if (app()->getLocale() === 'hu')
                <th>{{ __("Last name") }}</th>
                <th>{{ __("First name") }}</th>
            @endif

            {{--            name order in english--}}
            @if (app()->getLocale() === 'en')
                <th>{{ __("First name") }}</th>
                <th>{{ __("Last name") }}</th>
            @endif

            {{--            actions column for admins--}}
            <th>{{ __("Company name") }}</th>
            <th>{{ __("Email Address") }}</th>
            <th>{{ __("Phone number") }}</th>
            @can('modify data')
                <th>{{ __("Actions") }}</th>
            @endcan
        </tr>
        </thead>

        {{--        table content--}}
        <tbody>
        @foreach ($employees as $employee)
            <tr>

                {{--            name order in hungarian--}}
                @if (app()->getLocale() === 'hu')
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->first_name }}</td>
                @endif

                {{--            name order in english--}}
                @if (app()->getLocale() === 'en')
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                @endif

                <td>{{ $employee->company->name ?? ''}}</td>
                <td>{{ $employee->email}}</td>
                <td>{{ $employee->phone_number}}</td>

                {{--                action buttons for admins--}}
                @can('modify data')
                    <td>

                        {{--                        edit button--}}
                        <a href="{{ route('employees.edit', $employee->id) }}"
                           class="btn btn-primary btn-sm">{{ __('Edit') }}</a>

                        {{--                        delete button with confirmation--}}
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('{{ __('Are you sure you want to delete this employee?') }}');">{{ __('Delete') }}</button>
                        </form>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--    display pagination links--}}
    {{ $employees->links() }}

@endsection
