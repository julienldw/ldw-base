<form action="" method="post">
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row"><label for="gmap_api">Clé API Google</label></th>
        <td>
          <input type="text" class="regular-text" name="gmap_api" value="<?php echo $gmap_api; ?>">
          <p class="description">Clé API pour le développement : AIzaSyCfA_y54n7UkBQQb8lhy1cneHhRmI8HBME.<br>Créer un projet dédié pour la production <a href="https://console.developers.google.com/apis/" target="_blank">https://console.developers.google.com/apis/</a></p>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="submit">
    <input class="button-primary" name="ldwbase-general" value="Enregistrer les modifications" type="submit"/>
    <input type="hidden" name="ldwbase_nonce" value="<?php echo wp_create_nonce('ldwbase-nonce'); ?>"/>
  </p>
</form>
