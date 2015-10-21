<?php

namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function sendEmailReminder($id)
    {
        // Préparation du lien de rappel (reminder link)
        $reminder = new \App\Reminder(Input::get('email'));
        $reminder->save(); // Save directly to track masssive attacks (on false email), has a cons: database recording.



        $user = User::findOrFail($id);

        $mail = $user->email; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }
//=====Déclaration des messages au format texte et au format HTML.
        $message_txt = "<p>Bonjour,</p>
 <p>voici votre lien pour renouveller votre mot de passe</p>
        <p>Si vous ne l'avez pas demandé inquiétez-vous. Sinon utilisez le lien suivant qui vous permettra de créer un nouveau mot de passe.</p>

        <p><a href='" . ($reminder->getLink()) . "'>Lien de réinitialisation de mot de passe</a></p>
        ";
        $message_html = "<html><head></head><body>" . $message_txt . "</body></html>";
//==========

//=====Création de la boundary
        $boundary = "-----=" . md5(rand());
//==========

//=====Définition du sujet.
        $sujet = "Hey mon ami !";
//=========

//=====Création du header de l'e-mail.
        $header = "From: \"Ibiteria\"<noreply@ibiteria.com>" . $passage_ligne;
        $header .= "Reply-to: \"Ibiteria\" <ibiteria.com>" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//==========

//=====Création du message.
        $message = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format texte.
        $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_txt . $passage_ligne;
//==========
        $message .= $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format HTML
        $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_html . $passage_ligne;
//==========
        $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//==========

//=====Envoi de l'e-mail.
        if (mail($mail, $sujet, $message, $header)) {
            $message_err = "OK";
            $ret = true;

        } else {
            $message_err = "Erreur lors de l'envoi du mail";
            $ret = false;
        }
//==========
        return $ret;
    }


}
