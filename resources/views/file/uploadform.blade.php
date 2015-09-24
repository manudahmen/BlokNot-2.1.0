@extends('master')
@section('title', 'Upload form')

@section('header')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}"/>
@stop

@section('content')

    <h1>Uploads</h1>
    <h3>Choose file(s)</h3>
    <p>

    </p>

    <form action="{{asset("file/upload/$folderId")}}"
          id="form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        {!! method_field('POST') !!}
        <input id="file" name="file[]" type="file" value="Choisir le fichier" multiple>
        <input id="folder_id" name="folder_id" type="hidden" value="{{ $folderId }}">
        <input type="submit" id="upload-button" name="submitButton" value="Envoyer les fichiers"/>
    </form>
    <p id="progress"></p>
    <script language="JavaScript">
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });

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
                processData: false, type: 'post',

                contentType: false,
                data: fd,
                success: function (data) {
                    // do something...
                    document.write('uploaded' + data);
                },
                fail: function (data) {
                    document.write("Fail" + data);
                },
                always: function (data) {
                    document.write("Complete" + data);
                }
            });
        });
    </script>
@stop
