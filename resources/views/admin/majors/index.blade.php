@extends('admin.inc.master')

@section('style')
    <!-- Additional styles if needed -->
@endsection

@section('title')
    Majors
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
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($majors as $major)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $major->id }}</td>
                        <td>{{ $major->title }}</td>
                        <td>
                            <img src="{{ asset($major->image) }}" alt="{{ $major->title }}" width="100">
                        </td>
                        <td>
                            <a href="{{ route('majors.edit', $major->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('majors.destroy',$major->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5">No Majors Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @section('script')
        <!-- Additional scripts if needed -->
    @endsection
@endsection
