@extends('admin.inc.master')

@section('style')
    <!-- Additional styles if needed -->
@endsection

@section('title')
    Edit Major
@endsection

@section('content')
    <div class="container my-5">
        <form action="{{ route('majors.update', ['major' => $major->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Use the PATCH method for updates -->

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $major->title) }}" placeholder="Enter Title">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                    name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@section('script')
    <!-- Additional scripts if needed -->
@endsection
