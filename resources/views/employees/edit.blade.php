@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-8">
            <h1>{{ __("Edit Employee") }}</h1>
        </div>

        {{--        button to go back to employees index page--}}
        <div class="col-4 text-end">
            <a href="{{ route('employees.index') }}">
                <button class="btn btn-danger">{{ __("Go back") }}</button>
            </a>
        </div>

    </div>

    {{--    edit form--}}
    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{--        names input order in english--}}
        @if (app()->getLocale() === 'en')

            {{--            first name input--}}
            <div class="form-group">
                <label for="first_name">{{ __('First name') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="first_name" id="first_name" class="form-control"
                       value="{{ old('first_name', $employee->first_name) }}" autofocus>

                {{--                first name validation error message--}}
                @error('first_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{--        last name input--}}
            <div class="form-group">
                <label for="last_name">{{ __('Last name') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                       value="{{ old('last_name', $employee->last_name) }}">

                {{--                last name validation error message--}}
                @error('last_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endif

        {{--        names input order in hungarian--}}
        @if (app()->getLocale() === 'hu')

            {{--        last name input--}}
            <div class="form-group">
                <label for="last_name">{{ __('Last name') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                       value="{{ old('last_name', $employee->last_name) }}" autofocus>

                {{--                last name validation error message--}}
                @error('last_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{--        first name input--}}
            <div class="form-group">
                <label for="first_name">{{ __('First name') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="first_name" id="first_name" class="form-control"
                       value="{{ old('first_name', $employee->first_name) }}">

                {{--                first name validation error message--}}
                @error('first_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endif

        {{--        company name select--}}
        <div class="form-group">
            <label for="company_id">{{ __('Company name') }}</label>
            <select name="company_id" id="company_id" class="form-control">

                {{--                without company option--}}
                <option value="">{{ __('Without company') }}</option>

                {{--                company names from database--}}
                @foreach ($companies as $company)
                    <option

                        {{--                        set original company selected--}}
                        value="{{ $company->id }}" {{ (old('company_id', $employee->company_id) == $company->id) ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>

            {{--            company_id validation error message--}}
            @error('company_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--        email input--}}
        <div class="form-group">
            <label for="email">{{ __('Email address') }}</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $employee->email) }}">

            {{--            email validation error message--}}
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--        phone number input--}}
        <div class="form-group">
            <label for="phone_number">{{ __('Phone Number') }}</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control"
                   value="{{ old('phone_number', $employee->phone_number) }}">

            {{--            phone number validation error message--}}
            @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--        save button--}}
        <button type="submit" class="btn btn-success mt-2">{{ __('Save changes') }}</button>
    </form>

@endsection
