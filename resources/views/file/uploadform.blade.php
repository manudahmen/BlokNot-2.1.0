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
        <input id="file" name="file[]" type="file" multiple="multiple" value="Choisir le(s) fichier(s)">
        <input type="submit" name="submitButton" value="Envoyer les fichiers"/>

    <ul id="file-list">
        <li class="no-items">(no files uploaded yet)</li>
    </ul>
    </form>
    <script language="javascript" type="text/javascript" src="../../scripts/dropzone.js"></script>
    <script language="javascript" type="text/javascript">
        ("div#mydrop").dropzone({ url: "{{asset("file/upload")}} });
    </script>

@stop
