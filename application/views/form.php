<body>
  <h2>Form Data</h2>
  <hr>

  <form action="" method="POST">
    <div class="card">
      <br>
      <table>
        <tr>
          <td>Judul</td>
          <td><input type="text" name="judul" value="<?php if(isset($buku->judul)) echo $buku->judul ?>"></td>
        </tr>
        <tr>
          <td>Penulis</td>
          <td><input type="text" name="penulis" value="<?php if(isset($buku->penulis)) echo $buku->penulis ?>"></td>
        </tr>
        <tr>
          <td>ISBN</td>
          <td><input type="text" name="isbn" value="<?php if(isset($buku->isbn)) echo $buku->isbn ?>"></td>
        </tr>
      </table>
      <hr>
      <button class="btn blue f-right" type="submit">Submit</button>
      <!-- <span >Submit</span> -->
    </div>
  </form>
</body>