<body>
  <h2>Import Data</h2>
  <hr>

  <!-- Sweet Alert -->
  <?php if( $this->session->flashdata('flash') ) : ?>
  <div class="alert success">
    <input type="checkbox" id="alert0">
    <label class="close" title="close" for="alert0"> &#10006; </label>
    <p class="inner"><?= $this->session->flashdata('flash') ?></p>
  </div>
  <?php endif; ?>

  <!-- Option button -->
  <br>
  <a href="<?= base_url() ?>excel/dl_format">💾  <u>Download Format</u></a>
  <br><br>

	<?= form_open_multipart('excel/check_import') ?>
  	<input type="file" name="file_import">
  	<input type="submit" name="preview" value="Preview data">
  </form>

</body>
</html>