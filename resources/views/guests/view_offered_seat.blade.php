<!-- resources/views/guests/view_offered_seat.blade.php -->
<table>
    <th>
    <td>Utilisateur hôte</td>
    <td>Utilisateur invité</td>
    <td>Fichiers</td>
    <td>Actions</td>
    </th>
    <?php

    $user = \App\User::where("email", Auth::user()->email);
    $guests = \App\Guest::where("user_owner_id", $user->get('id'))->get();

    if($guests->first != null)
    {

    foreach($guests as $guest)
    ?>
    <tr>
        <td>{{ Auth::user()->email }}</td>
        <td></td>
        <td><?php
            \App\Guest::where("user_guest_id", $guest->get("id"))->get()->first() ?>
        </td>
        <td>Files</td>
        <td>Action</td>
    </tr>
</table>
<?php   }
?>