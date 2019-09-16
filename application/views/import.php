<body>
  <h2>Import Data</h2>
  <hr>

  <!-- Option button -->
  <br>
  <a href="<?= base_url() ?>home/new_data">💾  <u>Download Format</u></a>
  <br><br>

  <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>excel/ez">
  	<input type="file" name="file">
  	<input type="submit" name="preview" value="Preview data">
  </form>

</body>
</html>