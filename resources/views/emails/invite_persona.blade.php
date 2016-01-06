<!-- resources/views/emails/invite_persona.blade.php</span>
<!-- $data = ["guestPersona" => $persona, "hostId" => Auth::user()->email]; -->
<strong>Hello, {{ $guestPersona["firstname"] }}</strong>

Vous êtes invité par {{ $hostId }} à partager des données avec.

Ibiteria.