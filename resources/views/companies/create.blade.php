@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-8">
            <h1>{{ __("Add Company") }}</h1>
        </div>

        {{--        button to go back to companies index page--}}
        <div class="col-4 text-end">
            <a href="{{ route('companies.index') }}">
                <button class="btn btn-danger">{{ __("Go back") }}</button>
            </a>
        </div>
    </div>

    {{--    create form--}}
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        {{--        name input--}}
        <div class="form-group">
            <label for="name">{{ __('Company name') }}
                <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control" autofocus value="{{ old('name') }}">

            {{--            name validation error message--}}
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--        email input--}}
        <div class="form-group">
            <label for="email">{{ __('Company email') }}</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">

            {{--            email validation error message--}}
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--        logo image input--}}
        <div class="form-group">
            <label for="logo_image">{{ __('Company logo') }} (jpeg, png, jpg, svg)</label>
            <input type="file" name="logo_image" id="logo_image" class="form-control" onchange="previewImage()">

            {{--logo validation error message--}}
            @error('logo_image')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            {{--            checkbox not to provide logo--}}
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="no_logo" name="no_logo" value="1"
                       onchange="toggleLogo()">
                <label class="form-check-label" for="no_logo">
                    {{ __('I do not want to provide a logo') }}
                </label>
            </div>

            {{--            logo image preview with file name--}}
            <div class="d-flex align-items-center mt-2" style="display: none;"> <!-- Initially hidden if no logo -->
                <img class="company-logo logoPreview" src="" alt="{{ __('Company Logo') }}">
                <span class="fileName ms-2"></span>
            </div>
        </div>

        {{--        website_url input--}}
        <div class="form-group">
            <label for="website_url">{{ __('Company website') }}</label>
            <input type="text" name="website_url" id="website_url" class="form-control" value="{{ old('website_url') }}">

            {{--            website_url validation error--}}
            @error('website_url')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--        save button--}}
        <button type="submit" class="btn btn-success mt-2">{{ __('Save company') }}</button>
    </form>

@endsection
