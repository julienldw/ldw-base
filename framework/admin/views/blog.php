<form action="" method="post">
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row"><label for="posts_item_order">Affichage des articles</label></th>
        <td>
          <input type="text" class="regular-text" id="posts_item_order" name="posts_item_order" value="<?php echo $posts_item_order; ?>">
          <p class="description">Ordre d'affichage des éléments dans la liste des articles du blog.<br>Elements disponibles : img,title,meta,excerpt,more.</p>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="post_meta">Données d'article</label></th>
        <td>
          <textarea class="large-text" id="post_meta" name="post_meta"><?php echo $post_meta; ?></textarea>
          <p class="description">Contenu de l'élément "meta" (voir ci-dessus).<br/>
            Variables utilisables : %date% %author% %categories% %tags% %comments%<br>
            Voir ldw_entry_meta() dans framework/front/functions.php pour voir ce que ces variables affichent<br>
            L'affichage de chacune de ces variables peut être modifié grâce à des filtres</p>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="submit">
    <input class="button-primary" name="ldwbase-blog" value="Enregistrer les modifications" type="submit"/>
    <input type="hidden" name="ldwbase_nonce" value="<?php echo wp_create_nonce('ldwbase-nonce'); ?>"/>
  </p>
</form>
