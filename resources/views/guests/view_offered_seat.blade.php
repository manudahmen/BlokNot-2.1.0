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
    $guests = \App\BlokNot\Guest::where("user_owner_id", $user->get('id'))->get();

    if($guests->first != null)
    {

    $guest = $guests->each(function ($item, $key) {
    ?>
    <tr>
        <td>{{ Auth::user()->email }}</td>
        <td></td>
        <td><?php
            \App\User::where("id", $item->get("user_guest_id"))->get()->first()->get('email'); ?>
        </td>
        <td>Files</td>
        <td>Action</td>
    </tr>
    <?php }); ?>
</table>
<?php   }
?>