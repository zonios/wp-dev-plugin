<?php 
namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Models\Mail;

class MailController
{
  /**
   * Envoi d'un email
   *
   * @return void
   */
  public static function send()
  {
    // on vérifie la sécurité pour voir si le formulaire est bien authentique
    if (!wp_verify_nonce($_POST['_wpnonce'], 'send-mail')) {
      return;
    };
    Request::validation([
      'name' => 'required',
      'email' => 'email',
      'firstname' => 'required',
      'message' => 'required'
    ]);

    // on instancie la class Mail et on rempli les valeurs dans les propriétés.
    $mail = new Mail();
    
    $mail->userid = get_current_user_id();
    $mail->lastname = sanitize_text_field($_POST['name']);
    $mail->firstname = sanitize_text_field($_POST['firstname']);
    $mail->email = sanitize_email($_POST['email']);
    $mail->content = sanitize_textarea_field($_POST['message']);
    // Sauvegarde du mail dans la base de donnée
    $mail->save();

    // la fonction wordpress pour envoyer des mails https://developer.wordpress.org/reference/functions/wp_mail/
    if (wp_mail($mail->email, 'Pour ' . $mail->name . ' ' . $mail->firstname, $mail->message)) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'votre e-mail a bien été envoyé'
      ];
    } else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'Une erreur est survenu, veuillez réessayer plus tard'
      ];
    }
    // la fonction wp_safe_redirect redirige vers une url. La fonction wp_get_referer renvoi vers la page d'ou la requête a été envoyé.
    wp_safe_redirect(wp_get_referer());
  }
  /**
   * Affiche la page principal
   *
   * @return void
   */
  public static function index()
  {
    $mails = array_reverse(Mail::all());
    $old = [];
    if (isset($_SESSION['old']) && isset($_SESSION['notice']['error'])) {
      $old = $_SESSION['old'];
      unset($_SESSION['old']);
    }
    view('pages/send-mail', compact('old', 'mails'));
  }

  /**
   * Affiche une entré en particulier
   *
   * @return void
   */
  public static function show()
  {
    $id = $_GET['id'];
    $mail = Mail::find($id);
    view('pages/show-mail', compact('mail'));
  }

    /**
   * Affiche un formulaire pour éditer le mail
   *
   * @return void
   */
  public static function edit()
  {
    $id = $_GET['id'];
    $mail = Mail::find($id);
    view('pages/edit-mail', compact('mail'));
  }

  public static function update()
  {
    // on vérifie la sécurité pour voir si le formulaire est bien authentique
    if (!wp_verify_nonce($_POST['_wpnonce'], 'edit-mail')) {
      return;
    };
    // on vérifie les valeurs
    Request::validation([
      'lastname' => 'required',
      'email' => 'email',
      'firstname' => 'required',
      'content' => 'required'
    ]);
    // on récupère le mail original de la base de donnée
    $mail = Mail::find($_POST['id']);
    // On met à jour les nouvelles valeurs et fait une notification
    
    $mail->userid = get_current_user_id();
    $mail->lastname = sanitize_text_field($_POST['lastname']);
    $mail->firstname = sanitize_text_field($_POST['firstname']);
    $mail->email = sanitize_email($_POST['email']);
    $mail->content = sanitize_textarea_field($_POST['content']);
    // on met à jour dans la base de donnée
    if ($mail->update()) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'votre e-mail a bien été modifié'
      ];
    } else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'Une erreur est survenu, veuillez réessayer plus tard'
      ];
    }
    wp_safe_redirect(wp_get_referer());
  }

    /**
   * Supprime une entrée de la table
   *
   * @return void
   */
  public static function delete()
  {
    $id = $_POST['id'];
    if (Mail::delete($id)) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'Le mail a bien été supprimé'
      ];
      wp_safe_redirect(menu_page_url('mail-client', false));
      // self::index();
    } else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'un Problème est survenu, veuillez rééssayer'
      ];
      wp_safe_redirect(wp_get_referer());
    }
  }
}