<!-- resources/views/guests/view_offered_seat.blade.php -->
<?php
try {
    $userList = \App\User::where("email", 'like', Auth::user()->email);
    $user = $userList->get()->first();
} catch (PDOException $ex) {
    echo $ex;
}
?><h2>{{ $user->email }}</h2>

<table>
    <th>
    <td>Utilisateur hôte</td>
    <td>Utilisateur invité</td>
    <td>Fichiers</td>
    <td>Actions</td>
    </th>
    <?php
    $guests = null;
    try {
    $table2 = DB::table('users')
            ->leftJoin('guests', function ($join) {
                $join->on('guests.user_owner_id', '=', 'users.id')
                        ->where('guests.user_owner_id', '=', Auth::user()->id);
            })
            ->groupBy('users.id')
            ->select('users.*');
    $guestsList = $table2->get();
    //$guestsList = \App\BlokNot\Guest::where("user_owner_id", '=', $user->getAttribute('id'));
    //$guests = $guestsList->get();

    $guest = $guests->each(function ($item, $key) {
    ?>

    <tr>
        <td>{{ $user->email }}</td>
        <td></td>
        <td><?php
            $invite = \App\User::find($item->get("user_guest_id"))->get()->first();
            echo $invite->email; ?>
        </td>
        <td>Files</td>
        <td>Action</td>
    </tr>
    <?php });

    //print_r($errors);
    ?>
    <?php
    }
    catch (PDOException $ex) {
        echo $ex;
    }
    ?>
</table>
