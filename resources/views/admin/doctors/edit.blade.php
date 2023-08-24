@extends('admin.inc.master')

@section('style')
@endsection

@section('title')


    Edit Doctor - {{ $doctor->name }}
@endsection

@section('content')
    <div class="container my-5">
        <h1>Edit Doctor - {{ $doctor->name }}</h1>
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $doctor->title }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="major_id">Major</label>
                <select name="major_id" class="form-control" required>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}" {{ $doctor->major_id == $major->id ? 'selected' : '' }}>
                            {{ $major->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Doctor</button>
        </form>
    </div>
@endsection

@section('script')
@endsection
