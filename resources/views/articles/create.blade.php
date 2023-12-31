<!-- resources/views/articles/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create Article</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="id_teacher">Teacher</label>
        <select name="id_teacher" id="id_teacher" class="form-control">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="id_class">Class</label>
        <select name="id_class" id="id_class" class="form-control">
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>

    <button type="button" class="btn btn-primary" id="generateContentBtn"">Generate Article</button>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control" rows="6"></textarea>
    </div>

    <div class="form-group">
        <label for="published_at">Published At</label>
        <input type="datetime-local" name="published_at" id="published_at" class="form-control">
    </div>

    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

<script>
        document.addEventListener('DOMContentLoaded', function () {
            var generateContentBtn = document.getElementById('generateContentBtn');
            if (generateContentBtn) {
                generateContentBtn.addEventListener('click', function () {
                    var title = document.getElementById('title').value;

                    // Make an AJAX request to generate the article content
                    // Replace the API_ENDPOINT with your actual API endpoint
                    var apiEndpoint = 'API_ENDPOINT';
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', apiEndpoint);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            var contentField = document.getElementById('content');
                            contentField.value = response.content;
                        } else {
                            console.error('Error generating content:', xhr.status, xhr.statusText);
                        }
                    };
                    xhr.onerror = function () {
                        console.error('Error generating content:', xhr.status, xhr.statusText);
                    };
                    xhr.send(JSON.stringify({ title: title }));
                });
            }
        });
</script>
