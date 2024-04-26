@extends('layouts.app')
@include('layouts.template')
@section('content')

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>

    <div >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <hr>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- @include('profile.partials.update-password-form') --}}
                    <h2 class="text-lg font-medium text-gray-900">
                        Password Seetings
                    </h2>
                    <button class="btn btn-success">
                        <a href="{{ route('password.request') }}" style="text-decoration: none; color: inherit;">
                            Reset Password
                        </a>
                    </button>

                </div>
            </div>
            <hr>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

@endsection
