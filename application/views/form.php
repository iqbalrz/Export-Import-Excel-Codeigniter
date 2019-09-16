<body>
  <h2>Form Data</h2>
  <hr>

  <form action="" method="POST">
    <div class="card">
      <br>
      <table>
        <tr>
          <td>First Name</td>
          <td><input type="text" name="first_name" value="<?php if(isset($data->first_name)) echo $data->first_name ?>"></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type="text" name="last_name" value="<?php if(isset($data->last_name)) echo $data->last_name ?>"></td>
        </tr>
        <tr>
          <td>Gender</td>
          <!-- <td><input type="text" name="gender" value="<?php// if(isset($data->gender)) echo $data->gender ?>"></td> -->
          <td>
            <select> 
              <option value="Female" <?php if(isset($data->gender)=="Female") echo 'selected="selected"'; ?> >Female</option>
              <option value="Male" <?php if(isset($data->gender)=="Male") echo 'selected="selected"'; ?> >Male</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Phone</td>
          <td><input type="text" name="phone" value="<?php if(isset($data->phone)) echo $data->phone ?>"></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="text" name="email" value="<?php if(isset($data->email)) echo $data->email ?>"></td>
        </tr>
        <tr>
          <td>Skill</td>
          <td><input type="text" name="skill" value="<?php if(isset($data->skill)) echo $data->skill ?>"></td>
        </tr>
      </table>
      <hr>
      <button class="btn blue f-right" type="submit">Submit</button>
      <a href="<?= base_url() ?>"><span class="btn delete f-right"> Cancel </span></a>
    </div>
  </form>
</body>