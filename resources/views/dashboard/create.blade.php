@extends('layout.dashboardLayout')

@section('body-section')
    <h2>Create a Course</h2>
    <a href="{{ route('course.view') }}"><i class="fa-solid fa-backward mb-2"></i> Back to course page</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="mb-3 col">
                <label for="course_title" class="form-label">Course Title</label>
                <input type="text" class="form-control @error('course_title') is-invalid @enderror" id="course_title" name="course_title" value="{{ old('course_title') }}">
                @error('course_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col">
                <label for="course_feature_video" class="form-label">Feature Video</label>
                <input type="text" class="form-control @error('course_feature_video') is-invalid @enderror" id="course_feature_video" name="course_feature_video" value="{{ old('course_feature_video') }}">
                @error('course_feature_video')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col">
                <label for="course_level" class="form-label">Level</label>
                <input type="text" class="form-control @error('course_level') is-invalid @enderror" id="course_level" name="course_level" value="{{ old('course_level') }}">
                @error('course_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col">
                <label for="course_category" class="form-label">Category</label>
                <input type="text" class="form-control @error('course_category') is-invalid @enderror" id="course_category" name="course_category" value="{{ old('course_category') }}">
                @error('course_category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col">
                <label for="course_fee" class="form-label">Course Fee</label>
                <input type="text" class="form-control @error('course_fee') is-invalid @enderror" id="course_fee" name="course_fee" value="{{ old('course_fee') }}">
                @error('course_fee')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="course_summary">Course Summary</label>
            <textarea name="course_summary" id="summary" class="form-control @error('course_summary') is-invalid @enderror">{{ old('course_summary') }}</textarea>
            @error('course_summary')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="course_feature_image">Featured Image</label>
            <input type="file" class="form-control @error('course_feature_image') is-invalid @enderror" id="course_feature_image" name="course_feature_image">
            @error('course_feature_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <img id="feature_image_preview" src="" alt="Preview" class="img-fluid mt-2 d-none" style="max-height: 150px;">
        </div>

        <div id="modules">
            <a href="#" id="add_module" class="btn btn-success btn-sm mb-3">
                <i class="fa-solid fa-plus"></i> Add Module
            </a>
        </div>

        <div class="row button mx-1">
            <button class="btn btn-success col" type="submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
            <a href="{{ url('dashboard') }}" class="btn btn-danger col"><i class="fa-solid fa-xmark"></i> Cancel</a>
        </div>
    </form>

    <div class="module card mb-3 d-none" id="module_template">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Module</span>
            <div>
                <button type="button" class="btn btn-sm btn-secondary toggle-module"><i class="fa-solid fa-caret-down"></i></button>
                <button type="button" class="btn btn-sm btn-danger remove-module"><i class="fa-solid fa-trash"></i> Remove</button>
            </div>
        </div>
        <div class="card-body module-body">
            <div class="form-group mb-3">
                <label>Module Title</label>
                <input type="text" class="form-control" name="module_title[]">
            </div>
            <button class="btn btn-primary btn-sm mb-2 add-content-btn">
                <i class="fa-solid fa-plus"></i> Add Content
            </button>
            <div class="contents"></div>
        </div>
    </div>

    <div class="content card mb-2 d-none" id="content_template">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Content</span>
            <div>
                <button type="button" class="btn btn-sm btn-secondary toggle-content"><i class="fa-solid fa-caret-down"></i></button>
                <button type="button" class="btn btn-sm btn-danger remove-content"><i class="fa-solid fa-trash"></i> Remove</button>
            </div>
        </div>
        <div class="card-body content-body">
            <div class="form-group mb-3">
                <label>Content Title</label>
                <input type="text" class="form-control" name="content_title[][]">
            </div>
            <div class="form-group mb-3">
                <label>Video Source Type</label>
                <select class="form-control" name="video_source_type[][]">
                    <option value="">Choose Type</option>
                    <option value="1">YouTube</option>
                    <option value="2">Vimeo</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Video Url</label>
                <input type="text" class="form-control" name="video_url[][]">
            </div>
            <div class="form-group mb-3">
                <label>Video Length</label>
                <input type="text" class="form-control" name="video_length[][]">
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    tinymce.init({
        selector: "#summary",
        plugins: "link lists table code",
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link table | code",
        menubar: false,
        height: 300,
    });

    $(document).ready(function () {
        const $modulesWrapper = $("#modules");
        const $moduleTemplate = $("#module_template");
        const $contentTemplate = $("#content_template");

        function addContent($module) {
            let $newContent = $contentTemplate.clone().removeClass("d-none").removeAttr("id");
            $newContent.find(".remove-content").on("click", function () {
                $newContent.remove();
            });
            $module.find(".contents").append($newContent);
        }

        function addModule(defaultWithContent = true) {
            let $newModule = $moduleTemplate.clone().removeClass("d-none").removeAttr("id");
            $newModule.find(".add-content-btn").on("click", function (e) {
                e.preventDefault();
                addContent($newModule);
            });
            $newModule.find(".remove-module").on("click", function () {
                $newModule.remove();
            });
            let $toggleBtn = $newModule.find(".toggle-module");
            let $moduleBody = $newModule.find(".module-body");
            $toggleBtn.on("click", function () {
                $moduleBody.slideToggle(200);
                /*$toggleBtn.text($moduleBody.is(":visible") ? "⬇" : "➡");*/
            });
            if (defaultWithContent) {
                addContent($newModule);
            }
            $modulesWrapper.append($newModule);
        }

        $("#add_module").on("click", function (e) {
            e.preventDefault();
            addModule(true);
        });

        addModule(true);

        $(document).on("click", ".toggle-content", function () {
            let $btn = $(this);
            let $card = $btn.closest(".content");
            let $body = $card.find(".content-body");
            $body.slideToggle(200);
        });

        $('.remove-module').first().prop('disabled', true);
        $('.remove-content').first().prop('disabled', true);
    });
</script>
@endsection
