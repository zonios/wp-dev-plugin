<div class="wrap">
  <!-- nous utilisons la fonction get_admin_page_title() pour récupérer le titre de la page admin que l'on a défini lors de l'enregistrement -->
  <h1><?= get_admin_page_title(); ?></h1>
  <?php view('partials/notice'); ?>
  <div class="row">
    <div class="col-sm-6">
      <p>Ce formulaire vous permet de contacter vos clients pour leur réservation.</p>
      <!-- Vous pouvez trouver la documentation sur comment bien intégrer votre html à cette adresse https://dotorgstyleguide.wordpress.com/outline/forms/ -->
      <form action="<?= get_admin_url() . '?action=send-mail'; ?>" method="post">
        <!-- Cette fonction permet un sécurité pour vérifier que le formulaire est authentique -->
        <?php wp_nonce_field('send-mail'); ?>
        <table class="form-table">
          <tr>
            <th>e-mail</th>
            <td><input type="email" name="email" id="email" value="<?= $old['email']; ?>"></td>
          </tr>
          <tr>
            <th>Nom</th>
            <td><input type="text" name="name" id="name" value="<?= $old['name']; ?>"></td>
          </tr>
          <tr>
            <th>Prénom</th>
            <td><input type="text" name="firstname" id="firstname" value="<?= $old['firstname']; ?>"></td>
          </tr>
          <tr>
            <th>Message</th>
            <td><textarea name="message" id="message" cols="30" rows="10"><?= $old['message']; ?></textarea></td>
          </tr>
          <tr>
            <th></th>
            <td><button type="submit" class="button-primary">Envoyer</button></td>
          </tr>

        </table>
      </form>
    </div>
    <div class="col-sm-6">
      <?php foreach ($mails as $mail) : ?>
      <div class="postbox ">
        <div class="inside">
          <strong>client : </strong> <?= $mail->email; ?>
          <a href="<?php menu_page_url('mail-client'); ?>&action=show&id=<?= $mail->id; ?>" class="btn btn-primaty">voir</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>