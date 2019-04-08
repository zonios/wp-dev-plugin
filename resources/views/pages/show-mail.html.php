<div class="wrap">
  <!-- nous utilisons la fonction get_admin_page_title() pour récupérer le titre de la page admin que l'on a défini lors de l'enregistrement -->
  <h1><?= get_admin_page_title(); ?>: </h1>

  <!-- Ici nous ajoutons une partie d'html afin qui prendra en charge les notifications. On met cela dans un fichier à part afin de pouvoir réutiliser les notifications ailleurs -->
  <?php view('partials/notice'); ?>
  <div class="row">
    <div class="col-sm-6">
      <div class="postbox">
        <div class="inside">
          <div>
            <strong>E-mail: </strong> <?= $mail->email; ?>
          </div>
          <div>
            <strong>Nom: </strong> <?= $mail->lastname; ?>
          </div>
          <div>
            <strong>Prénom: </strong> <?= $mail->firstname; ?>
          </div>
          <div>
            <strong>Message: </strong> <br> <?= $mail->content; ?>
          </div>
        </div>
      </div>
      <a href="<?php menu_page_url('mail-client'); ?>" class="button button-primary">retour</a>
      <a href="<?php menu_page_url('mail-client'); ?>&action=edit&id=<?= $mail->id; ?>" class="button button-primary">editer</a>
      <form class="form-inline d-inline-block" action="<?php get_site_url(); ?>?action=mail-delete" method="post">
        <input type="hidden" name="id" value="<?= $mail->id; ?>">
        <button type="submit" class="button">supprimer</button>
      </form>
    </div>
  </div>
</div>