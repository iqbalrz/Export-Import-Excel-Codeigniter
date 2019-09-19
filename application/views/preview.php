<body>
  <h2>Data Preview</h2>
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
  <span class="btn blue"><a href="<?= base_url() ?>home/new_data">&#10010; New Data</a></span>
  <span class="btn"><a href="<?= base_url() ?>excel/export">Export</a></span>
  <span class="btn green"><a href="<?= base_url() ?>excel/check_import">Import</a></span>


  <br><br>
  <table class="view" cellpadding="8">
    <!-- Header -->
    <?php foreach ($fields as $field) : ?>
    <th><?= strtoupper($field) ?></th>
    <?php endforeach; ?>
    <th></th>

    <!-- Data -->
    <?php foreach ($datas as $data) : ?>
    <tr class="clickable">
      <?php foreach ($fields as $field) : ?>
      <td class="view">
        <a href="<?= base_url() ?>home/up_data/<?= $data['id'] ?>"><?= $data[$field] ?></a>
      </td>
      <?php endforeach; ?>

      <td>
        <span class="badge delete">
          <a href="<?= base_url() ?>home/del_data/<?= $data['id'] ?>" onclick="return confirm('Delete this item?');">&#10005;</a>
        </span>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>