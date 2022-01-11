@extends('layouts.app')

@section('title', $post->title)

@section('includes')
<script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}">
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-8" id="center">
        <div class="row mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div>

        <form action="{{ route('posts.update', $post) }}" METHOD="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div class="row mb-3">
                <label class="form-label">Title</label>
                <input class="w-100 form-control" value="{{ $post->title}}" type="text" name="title">
            </div>

            <div class="row mb-3">
                <label class="form-label">Content</label>
                <textarea class="w-100" name="content" id="content-editor">{{ $post->content }}</textarea>
            </div>

            <div class="row mb-3">
                <label class="form-label">Tags</label>
                <select class="w-100" id="tag-select" name="tags[]" multiple="multiple">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row w-100  mb-2">
                <input type="submit" value="Update" class="btn btn-success">
            </div>

        </form>
        
    </div>
</div>

<script>
    function image_upload_handler (blobInfo, success, failure, progress) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', "{{ route('upload') }}",);
        xhr.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");

        xhr.upload.onprogress = function (e) {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = function() {
            var json;

            if (xhr.status === 403) {
            failure('HTTP Error: ' + xhr.status, { remove: true });
            return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
            failure('HTTP Error: ' + xhr.status);
            return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText);
            return;
            }

            success(json.location);
        };

        xhr.onerror = function () {
            failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
        };


    tinymce.init({
        selector: '#content-editor',
        width : "100%",
        height: "32em",
        plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        images_upload_handler: image_upload_handler
    });

    $(document).ready(function() {
        $('#tag-select').select2();
        $('#tag-select').val({{ json_encode($post->tags()->allRelatedIds()) }});
        $('#tag-select').trigger('change');
    });
</script>

@endsection
