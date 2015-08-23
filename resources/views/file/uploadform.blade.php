@extends('master')
@section('title', 'Upload form')

@section('header')
    @parent
@stop

@section('content')

    <h1>Uploads</h1>
    <h3>Choose file(s)</h3>
    <p>

    </p>
    <div id="mydrop" style="background-color: black; color: white; margin: 40px; height: 100px; width: 100px; background-color: #00ffff">

    </div>
    <form action="{{asset("file/upload/$folderId")}}"
          class="dropzone"
          id="my-awesome-dropzone" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input id="file-select" name="file[]" type="file" multiple="multiple" value="Choisir le(s) fichier(s)">
        <input id="file" name="folder_id" type="hidden" value="{{ $folderId }}">
        <input type="submit" id="upload-button" name="submitButton" value="Envoyer les fichiers"/>

    <ul id="file-list">
        <li class="no-items">(no files uploaded yet)</li>
    </ul>
    </form>
    <script language="javascript" type="text/javascript" src="../../scripts/dropzone.js"></script>
    <script language="javascript" type="text/javascript">
        ("div#mydrop").dropzone({ url: "{{asset("file/upload")}} });
    </script>
<script>
    var form = document.getElementById('my-awesome-dropzone');
    var fileSelect = document.getElementById('file-select');
    var uploadButton = document.getElementById('upload-button');
    form.onsubmit = function(event) {
        event.preventDefault();

        // Update button text.
        uploadButton.innerHTML = 'Uploading...';

        /// Get the selected files from the input.
        var files = fileSelect.files;

        // Create a new FormData object.
        var formData = new FormData();

        // Loop through each of the selected files.
        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            // Check the file type.
            if (!file.type.match('image.*')) {
                continue;
            }

            // Add the file to the request.
            formData.append('photos[]', file, file.name);
        }

        // Files
        formData.append(name, file, filename);

// Blobs
        formData.append(name, blob, filename);

// Strings
        formData.append(name, value);


        // Set up the request.
        var xhr = new XMLHttpRequest();

        / Open the connection.
                xhr.open('POST', '{{asset("file/upload/$folderId")}}', true);

        // Set up a handler for when the request finishes.
        xhr.onload = function () {
            if (xhr.status === 200) {
                // File(s) uploaded.
                uploadButton.innerHTML = 'Upload';
            } else {
                alert('An error occurred!');
            }
        };

        / Send the Data.
                xhr.send(formData);
    }
</script>
@stop
