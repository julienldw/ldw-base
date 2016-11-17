<form action="" method="post">
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row"><label for="logo">Logo</label></th>
        <td>
          <div class="manage_media">
            <input type="hidden" name="logo_id" class="media_id" value="<?php echo $logo_id; ?>">
            <div class="media_thumb">
              <img src="<?php if(isset($logo_url)) echo $logo_url; ?>">
            </div>
            <div class="nomedia_button <?php if(strlen($logo_id) > 0) echo 'hasmedia';  ?>">
              <a href="#" class="insert_media button" data-title="Choisir un logo" data-button="Sélectionner cette image">Ajouter l'image</a>
            </div>
            <div class="hasmedia_buttons <?php if(strlen($logo_id) > 0) echo 'hasmedia';  ?>">
              <a href="#" class="unset_media button">Supprimer</a>
              <a href="#" class="insert_media button" data-title="Choisir un logo" data-button="Sélectionner cette image">Changer l'image</a>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="submit">
    <input class="button-primary" name="ldwbase-header" value="Enregistrer les modifications" type="submit"/>
    <input type="hidden" name="ldwbase_nonce" value="<?php echo wp_create_nonce('ldwbase-nonce'); ?>"/>
  </p>
</form>
