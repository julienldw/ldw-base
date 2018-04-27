<form action="" method="post">
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row"><label for="facebook">Facebook</label></th>
        <td>
          <input type="url" class="large-text" name="facebook" value="<?php echo $facebook; ?>" />
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="twitter">Twitter</label></th>
        <td>
          <input type="url" class="large-text" name="twitter" value="<?php echo $twitter; ?>" />
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="googleplus">Google Plus</label></th>
        <td>
          <input type="url" class="large-text" name="googleplus" value="<?php echo $googleplus; ?>" />
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="linkedin">Linkedin</label></th>
        <td>
          <input type="url" class="large-text" name="linkedin" value="<?php echo $linkedin; ?>" />
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="youtube">Youtube</label></th>
        <td>
          <input type="url" class="large-text" name="youtube" value="<?php echo $youtube; ?>" />
        </td>
      </tr>
    </tbody>
  </table>
  <p class="submit">
    <input class="button-primary" name="ldwbase-social-networks" value="Enregistrer les modifications" type="submit"/>
    <input type="hidden" name="ldwbase_nonce" value="<?php echo wp_create_nonce('ldwbase-nonce'); ?>"/>
  </p>
</form>
