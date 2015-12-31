<!-- resources/views/guests/view_offered_seat.blade.php -->
<table>
    <th>
    <td>Utilisateur hôte</td>
    <td>Utilisateur invité</td>
    <td>Fichiers</td>
    <td>Actions</td>
    </th>
    <?php
    $user = \App\User::findByEmail(Auth::user()->email);
    $guests = \App\BlokNot\Guest::where("user_owner_id", "like", $user->getAttr('id'))->get();

    ?>

    <?php foreach($guests as $guest)
    ?>
    <tr>
        <td>{{ Auth::user()->email }}</td>
        <td></td>
        <td><?php
            $userG = \App\User::findByEmail($guest);
            \App\BlokNot\Guest::where("user_guest_id", "like", $guest)->get()->first() ?>
        </td>
        <td>Files</td>
        <td>Action</td>
    </tr>
</table>