@extends('layouts.dashboard.app')

@section('content')


<div class="container mt-5">
    <h2 class="font-weight-semibold text-dark display-4">
        {{ __('Profile') }}
    </h2>

    <div class="row">
        <div class="justify-content-center">
            
                <!-- Update Avatar Form -->
                @include('profile.partials.update-avatar-form')
            

                <!-- Update Profile Information Form -->
                @include('profile.partials.update-profile-information-form')


                <!-- Update Password Form -->
                @include('profile.partials.update-password-form')


                <!-- Delete User Form -->
                @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>





@endsection