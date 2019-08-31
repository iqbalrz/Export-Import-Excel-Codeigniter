<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>preview data</title>

  <style>
    a:link,
    a:visited {
      color: inherit;
      text-decoration: none;
    }

    table,
    td {
      border: solid 1px #333;
      border-collapse: collapse;
    }

    td {
      padding: 2px 10px;
    }

    .btn {
      margin: 10px 0;
      padding: 8px;
      border-radius: 5px;
      color: white;
      background: #ef6c00;
      cursor: pointer;
    }

    /* Alert Style by Robert Lemon */
    /* https://codepen.io/rlemon/pen/vmIlC */
    .alert {
      width: 30vw;
    }

    .alert .inner {
      padding: 12px;
      border-radius: 3px;
      border: 1px solid rgb(180, 180, 180);
      background-color: rgb(212, 212, 212);
    }

    .alert .close {
      float: right;
      cursor: pointer;
      padding: 12px;
    }

    .alert input {
      display: none;
    }

    .alert input:checked~* {
      animation-name: dismiss, hide;
      animation-duration: 300ms;
      animation-iteration-count: 1;
      animation-timing-function: ease;
      animation-fill-mode: forwards;
      animation-delay: 0s, 100ms;
    }

    .alert.success .inner {
      border: 1px solid rgb(214, 233, 198);
      background-color: rgb(223, 240, 216);
    }

    .alert.success .inner,
    .alert.success .close {
      color: rgb(70, 136, 71);
    }


    @keyframes dismiss {
      0% {
        opacity: 1;
      }

      90%,
      100% {
        opacity: 0;
        font-size: 0.1px;
        transform: scale(0);
      }
    }

    @keyframes hide {
      100% {
        height: 0px;
        width: 0px;
        overflow: hidden;
        margin: 0px;
        padding: 0px;
        border: 0px;
      }
    }
  </style>
</head>

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

  <!-- Export button -->
  <br>
  <span class="btn"><a href="<?= base_url() ?>/home/export">Export</a></span>


  <br><br>
  <table>
    <!-- Header -->
    <?php foreach ($fields as $field) : ?>
    <th><?= strtoupper($field) ?></th>
    <?php endforeach; ?>

    <!-- Data -->
    <?php foreach ($buku as $bk) : ?>
    <tr>
      <?php foreach ($fields as $field) : ?>
      <td><?= $bk[$field] ?></td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>