@extends('master')
@section('title', 'Accueil mon BLOC NOTES')

@section('sidebar')
    @parent


@stop

@section('content')
<h1>Applications mon bloc-notes</h1>

   <ul>
       <li><a class="btn btn-large btn-primary openbutton app" href="{{URL::to("note/list/0/1")}}">Bloc-notes,
               gestionnaire de fichiers en ligne</a></li>
       <li><a class="btn btn-large btn-primary openbutton app" href="{{route("freezer") }}">Freezer</a></li>
   </ul>

<div style="height: 40%; overflow: scroll;;">    <p>
        <p>Vous &ecirc;tes tomb&eacute;s sur mon site web...</p>

        <p>Qui &ecirc;tes-vous ? Un pirate, un hackeur? Dehors.</p>
        <p>Une charognard &agrave; la recherche d'informations juteuses? Dehors et ne lisez m&ecirc;me
        pas.</p>

        <p>Quelqu'un int&eacute;ress&eacute; par les applications webs? D&eacute;sirant trouver autre chose que
        ce qu'il trouve d'habitude sur Internet, alors <strong>Bienvenue</strong>!</p>


        <p>Je ne vais pas vous promettre monts et merveilles comme de toute fa&#xE7;on vous n'y
        croiriez pas.</p>
        <p>Ici se trouvent les applications que je d&eacute;veloppe actuellement. Je ne suis pas une
        entreprise ni un repr&eacute;sentant de commerce.</p>
        <p>Je suis:</p>
<ol>
    <li>un consommateur</li>
    <li>un ancien &eacute;tudiant gradu&eacute; en informatique de gestion</li>
    <li>un allocataire social (pour le moment)</li>

</ol>

        <p>Je d&eacute;veloppe des applications depuis ma plus tendre (pourtant l'enfance ne l'est pas
        toujours) enfance.</p>
        <p>C'est ma passion: programmer des machines. Dans quel but? Je n'en
        sais rien.</p>




    
    <h2>BlokNot 1.1</h2>
<p>Modifications depuis Blocnotes.</p>
<p>Je souhaite appeler mon application BlokNot . Mais vu qu'on m'a d&eacute;j&agrave; vol&eacute; pas mal de titre sur Google (hmmm sa<br/>r&eacute;putation dans mon coeur c'est UN INFINI NEGTIF).</p>
<h2><a href="#blok-not-1-1" name="blok-not-1-1" id="blok-not-1-1" class="anchor"></a>Blok Not 1.1</h2>
<h2><a href="#am&eacute;liorations-" name="am&eacute;liorations-" id="am&eacute;liorations-" class="anchor"></a>Am&eacute;liorations :</h2>
<ul>
    <li>Utilisation du Framework Laraval 5.1 (branche master de juillet 2015, sans les Form et Html Facades)</li>
    <li>Stabilit&eacute; accrue.</li>
    <li>Upload de note sous forme de texte, images, vid&eacute;o, pdf. Pas tous visionnables dans l'interface</li>
    <li>Web design augment&eacute; et plus joli.</li>
    <li>Correction de bogues, et je n'utile plus que partiellement l'ancienne biblioth&egrave;que.</li>
</ul>
<h2><a href="#manquent-" name="manquent-" id="manquent-" class="anchor"></a>Manquent:</h2>
<ul>
    <li>Installateur web (avec cr&eacute;ations de tables, configuration des fichiers priv&eacute;s et informations sensibles)</li>
    <li>Quelques m&eacute;thodes, comme la r&eacute;cup&eacute;ration du mot de passe;</li>
</ul>
    <h2>Freezer</h2>
    <p>Recherches simples d'artistes, albums, titres.</p>
@stop</div>