@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand infomation</h3>

                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{route('admin.index')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{route('brands.index')}}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Update Brand</div>
                    </li>
                </ul>
            </div>

            <div>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{route('brands.update', $brand->slug)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                     @method('PUT')
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="" type="text" placeholder="Brand name" name="name" value="{{ old('name', $brand->name) }}">
                        @error('name')
                        <span class="text-danger fs-4">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug" value="{{ old('slug', $brand->slug) }}">
                        @error('slug')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload Image <span class="tf-color-1">*</span></div>

                        <!-- CURRENT IMAGE -->
                        @if ($brand->image)
                        <div id="currentImageWrapper" class="mb-4">
                            <p class="text-sm mb-1">Current Image:</p>
                            <img id="currentImage" src="{{ asset('storage/' . $brand->image) }}" alt="Current Brand Image" class="w-40 h-auto rounded shadow">
                        </div>
                        @endif

                        <!-- NEW IMAGE PREVIEW (HIDDEN INITIALLY) -->
                        <div id="newImageWrapper" class="mb-4 hidden">
                            <p class="text-sm mb-1">New Image Preview:</p>
                            <img id="newImagePreview" src="#" alt="New Preview" class="w-40 h-auto rounded shadow">
                        </div>

                        <!-- FILE INPUT -->
                        <div class="upload-image flex-grow">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">
                                    Drop your image here or <span class="tf-color">click to browse</span>
                                </span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>

                        @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </fieldset>


                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>

<script>
document.getElementById('myFile').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const newPreviewWrapper = document.getElementById('newImageWrapper');
    const newPreview = document.getElementById('newImagePreview');
    const currentWrapper = document.getElementById('currentImageWrapper');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            newPreview.src = event.target.result;
            newPreviewWrapper.classList.remove('hidden');

            // Optionally hide current image
            if (currentWrapper) {
                currentWrapper.classList.add('hidden');
            }
        };
        reader.readAsDataURL(file);
    } else {
        newPreviewWrapper.classList.add('hidden');
        newPreview.src = '#';

        if (currentWrapper) {
            currentWrapper.classList.remove('hidden');
        }
    }
});
</script>

@endsection
