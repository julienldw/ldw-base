<form action="" method="post">
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row"><label for="signature">Signature</label></th>
        <td>
          <textarea class="large-text" name="signature"><?php echo $signature; ?></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="submit">
    <input class="button-primary" name="ldwbase-footer" value="Enregistrer les modifications" type="submit"/>
    <input type="hidden" name="ldwbase_nonce" value="<?php echo wp_create_nonce('ldwbase-nonce'); ?>"/>
  </p>
</form>
