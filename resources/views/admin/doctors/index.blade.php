@extends('admin.inc.master')

@section('style')
    <!-- Additional styles if needed -->
@endsection

@section('title')
    Doctors
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Major</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($doctors as $doctor)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->title }}</td>
                        <td>{{ $doctor->major->title }}</td>
                        <td>
                            <img src="{{ asset('path_to_images/' . $doctor->image) }}" alt="{{ $doctor->name }}"
                                width="100">
                        </td>
                        <td>
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="7">No Doctors Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @section('script')
        <!-- Additional scripts if needed -->
    @endsection
@endsection
