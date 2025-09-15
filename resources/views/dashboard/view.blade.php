@extends('layout.dashboardLayout')
@section('body-section')
    <h2>All Courses</h2>
    <a href="{{ url('/course') }} " class=" btn btn-primary"><i class="fa-solid fa-plus"></i> Add Course</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Level</th>
            <th>Category</th>
            <th>Fee</th>
            <th>Summary</th>
            <th>Feature Video</th>
            <th>Modules & Contents</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $course->title ?? 'Null' }}</td>
            <td>{{ $course->level ?? 'Null' }}</td>
            <td>{{ $course->category ?? 'Null' }}</td>
            <td>{{ $course->fee ?? 'Null' }}</td>
            <td>{!! $course->summary ?? 'Null' !!}</td>
            <td>{{ $course->feature_video ?? 'Null' }}</td>
            <td>
                @foreach($course->modules as $module)
                    <strong>{{ $module->title }}</strong>
                    <ul>
                        @foreach($module->contents as $content)
                            <li>
                                {{ $content->title }} 
                                <a href="{{ $content->video_url ?? '#' }}">({{ $content->video_source_type == 1 ? 'YouTube' : 'Video' }}) - {{ $content->video_length ?? '' }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('script')
 @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        })
    </script>
@endif

@if ($errors->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('error') }}',
        })
    </script>
@endif

@if ($errors->any() && !$errors->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: `{!! implode('<br>', $errors->all()) !!}`,
        })
    </script>
@endif

@endsection