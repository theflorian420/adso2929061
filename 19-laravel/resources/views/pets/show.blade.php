@extends('layouts.app')

@section('title', 'Larapets: Show Pet')

@section('content')
    @include('partials.navbar')
    <h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
        </svg>
        Show Pet
    </h1>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('pets') }}">Pet Module</a></li>
            <li>Show Pet</li>
        </ul>
    </div>

    <div class="bg-[#0009] p-10 rounded-sm">
        <div class="avatar flex flex-col gap-1 items-center justify-center cursor-pointer hover:scale-105 transition ease-in">
            <div class="mask mask-squircle w-60">
                <img src="{{ asset('images/pets/' . $pet->image) }}" alt="{{ $pet->name }}" />
            </div>
        </div>

        <div class="flex gap-2 flex-col md:flex-row mt-4 justify-center">
            <ul class="list bg-[#0006] text-white rounded-box shadow-md w-64">
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Name:</span> <span>{{ $pet->name }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Kind:</span> <span>{{ $pet->kind }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Breed:</span> <span>{{ $pet->breed }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Age:</span> <span>{{ $pet->age }} years old</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Weight:</span> <span>{{ $pet->weight }} kg</span>
                </li>
            </ul>
            <ul class="list bg-[#0006] text-white rounded-box shadow-md w-64">
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Location:</span> <span>{{ $pet->location }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Active:</span>
                    <span>
                        @if ($pet->active)
                            <div class="badge badge-outline badge-success">Active</div>
                        @else
                            <div class="badge badge-outline badge-error">Inactive</div>
                        @endif
                    </span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Status:</span>
                    <span>
                        @if ($pet->status)
                            <div class="badge badge-outline badge-warning">Adopted</div>
                        @else
                            <div class="badge badge-outline badge-success">Available</div>
                        @endif
                    </span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Created At:</span> <span>{{ $pet->created_at->diffForHumans() }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Updated At:</span> <span>{{ $pet->updated_at->diffForHumans() }}</span>
                </li>
            </ul>
        </div>

        <div class="mt-4 bg-[#0006] text-white rounded-box shadow-md p-4 max-w-[32rem] mx-auto">
            <span class="text-[#fff9] font-semibold block mb-1">Description:</span>
            <p>{{ $pet->description }}</p>
        </div>
    </div>
@endsection
