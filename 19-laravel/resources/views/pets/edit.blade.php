@extends('layouts.app')

@section('title', 'Larapets: Edit Pet')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
        </svg>
        Edit Pet
    </h1>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('pets') }}">Pet Module</a></li>
            <li>Edit Pet</li>
        </ul>
    </div>

    <div class="card text-white md:w-[760px] w-[320px] bg-black/20 p-4 mb-4 rounded">
        <form method="POST" action="{{ url('pets/' . $pet->id) }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Photo column --}}
            <div class="w-full md:w-[280px] flex flex-col items-center gap-3">
                <div class="avatar flex flex-col gap-1 items-center justify-center cursor-pointer hover:scale-105 transition ease-in">
                    <div id="upload" class="mask mask-squircle w-48">
                        <img id="preview" src="{{ asset('images/pets/' . $pet->image) }}" />
                    </div>
                    <small class="pb-0 border-white border-b flex gap-1 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M208,40H48A24,24,0,0,0,24,64V176a24,24,0,0,0,24,24H208a24,24,0,0,0,24-24V64A24,24,0,0,0,208,40Zm8,136a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8H208a8,8,0,0,1,8,8Zm-48,48a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,224ZM157.66,106.34a8,8,0,0,1-11.32,11.32L136,107.31V152a8,8,0,0,1-16,0V107.31l-10.34,10.35a8,8,0,0,1-11.32-11.32l24-24a8,8,0,0,1,11.32,0Z"></path>
                        </svg>
                        Upload Image
                    </small>
                    @error('image') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror
                </div>
                <input type="file" id="image" name="image" class="hidden" accept="image/*">
                <input type="hidden" name="originimage" value="{{ $pet->image }}">

                {{-- Active --}}
                <div class="w-full">
                    <label class="label text-white">Active:</label>
                    <select name="active" class="select bg-[#0009] outline-0 w-full">
                        <option value="1" @if(old('active', $pet->active) == 1) selected @endif>Yes</option>
                        <option value="0" @if(old('active', $pet->active) == 0) selected @endif>No</option>
                    </select>
                </div>

                {{-- Adopted --}}
                <div class="w-full">
                    <label class="label text-white">Adopted:</label>
                    <select name="status" class="select bg-[#0009] outline-0 w-full">
                        <option value="0" @if(old('status', $pet->status) == 0) selected @endif>No</option>
                        <option value="1" @if(old('status', $pet->status) == 1) selected @endif>Yes</option>
                    </select>
                </div>
            </div>

            {{-- Fields col 1 --}}
            <div class="w-full md:w-[240px]">
                <label class="label text-white">Name:</label>
                <input type="text" class="input bg-[#0009] outline-0 w-full" name="name" placeholder="Max" value="{{ old('name', $pet->name) }}">
                @error('name') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror

                <label class="label text-white mt-2">Kind:</label>
                <select name="kind" class="select bg-[#0009] outline-0 w-full">
                    <option value="">Select...</option>
                    @foreach(['Dog','Cat','Pig','Mouse','Bird','Rabbit','Other'] as $k)
                        <option value="{{ $k }}" @if(old('kind', $pet->kind) == $k) selected @endif>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kind') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror

                <label class="label text-white mt-2">Breed:</label>
                <input type="text" class="input bg-[#0009] outline-0 w-full" name="breed" placeholder="Golden Retriever" value="{{ old('breed', $pet->breed) }}">
                @error('breed') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror

                <label class="label text-white mt-2">Location:</label>
                <input type="text" class="input bg-[#0009] outline-0 w-full" name="location" placeholder="Colombia" value="{{ old('location', $pet->location) }}">
                @error('location') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror
            </div>

            {{-- Fields col 2 --}}
            <div class="w-full md:w-[240px]">
                <label class="label text-white">Age (years):</label>
                <input type="number" class="input bg-[#0009] outline-0 w-full" name="age" placeholder="3" min="0" value="{{ old('age', $pet->age) }}">
                @error('age') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror

                <label class="label text-white mt-2">Weight (kg):</label>
                <input type="number" step="0.1" class="input bg-[#0009] outline-0 w-full" name="weight" placeholder="5.5" min="0" value="{{ old('weight', $pet->weight) }}">
                @error('weight') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror

                <label class="label text-white mt-2">Description:</label>
                <textarea class="textarea bg-[#0009] outline-0 w-full h-28" name="description" placeholder="Describe the pet...">{{ old('description', $pet->description) }}</textarea>
                @error('description') <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small> @enderror

                <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3 w-full">Save Changes</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#upload').click(function (e) {
            e.preventDefault()
            $('#image').click()
        })
        $('#image').change(function (e) {
            e.preventDefault()
            $('#preview').attr('src', window.URL.createObjectURL($(this).prop('files')[0]))
        })
    })
</script>
@endsection
