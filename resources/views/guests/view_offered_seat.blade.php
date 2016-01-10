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
                        ->where('users.id', '=', Auth::user()->id);
            })
            ->groupBy('users.id')
            ->select(array('users.id', 'guests.user_guest_id'));
    $guestsList = $table2->get();
    //$guestsList = \App\BlokNot\Guest::where("user_owner_id", '=', $user->getAttribute('id'));
    //$guests = $guestsList->get();

    //$guest = $guestsList->each(function ($item, $key) {
    foreach($guestsList as $guest)
    {
    ?>

    <tr>
        <td>{{ $user->email }}</td>
        <td></td>
        <td><?php
            $invite = \App\User::findOrNew($guest->user_guest_id);
            echo $invite->email; ?>
        </td>
        <td><a href="{{ URL::to("guests/files/to/".$user->id."/from/".$guest->user_guest_id)  }}">Fichiers
                disponibles</a></td>
        <td>Action</td>
    </tr>
    <?php }//);

    //print_r($errors);
    ?>
    <?php
    }
    catch (PDOException $ex) {
        echo $ex;
    }
    ?>
</table>
