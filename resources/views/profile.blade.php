@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Profile</h1>
@stop

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif


@section('content')


    {{--<img src="{{ asset(auth()->user()->image) }}" alt="{{ Auth::user()->name  }}'s profile picture" class="img-rounded"/>--}}

    @if (auth()->user()->profile)
        <img src="{{ asset('/storage'.auth()->user()->profile) }}"
             style="width: 80px; height: 80px; border-radius: 50%;" alt="{{ Auth::user()->name  }}'s profile picture"/>
    @endif

    <br>
    <br>
    <br>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('profile.image') }}" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <lable for="name">Name:</lable>
            <input type="text" class="form-control disabled" name="name" id="name" value="{{ Auth::user()->name }}">
        </div>
        <div class="form-group">
            <lable for="email">Name:</lable>
            <input type="email" class="form-control disabled" name="email" id="email" value="{{ Auth::user()->email }}"
                   disabled>
        </div>

        <div class="custom-file form-group">
            <label class="profile_image " for="profileImage">Choose file</label>
            <input type="file" class="form-control custom-file-input" id="profile_image" name="profile_image">
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Upload Image">
        </div>

    </form>

@stop