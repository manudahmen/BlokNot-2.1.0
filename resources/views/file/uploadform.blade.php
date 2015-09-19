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
          id="form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="_method" value="POST">
        <input id="file" name="file" type="file" multiple="multiple" value="Choisir le(s) fichier(s)">
        <input id="folder_id" name="folder_id" type="hidden" value="{{ $folderId }}">
        <input type="submit" id="upload-button" name="submitButton" value="Envoyer les fichiers"/>
    </form>
    <p id="progress"></p>
    <script>

        $('#form').submit(function (e) { // capture submit
            e.preventDefault();
            var fd = new FormData(this); // XXX: Neex AJAX2

            // You could show a loading image for example...

            $.ajax({
                url: $(this).attr('action'),
                xhr: function () { // custom xhr (is the best)

                    var xhr = new XMLHttpRequest();
                    var total = 0;

                    // Get the total size of files
                    $.each(document.getElementById('file').files, function (i, file) {
                        total += file.size;
                    });

                    // Called when upload progress changes. xhr2
                    xhr.upload.addEventListener("progress", function (evt) {
                        // show progress like example
                        var loaded = (evt.loaded / total).toFixed(2) * 100; // percent

                        $('#progress').text('Uploading... ' + loaded + '%');
                    }, false);

                    return xhr;
                },
                type: 'post',
                processData: false,
                contentType: false,
                data: fd,
                success: function (data) {
                    // do something...
                    alert('uploaded');
                }
            });
        });
    </script>
@stop
