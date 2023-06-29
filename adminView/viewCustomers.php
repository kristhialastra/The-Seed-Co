<div >
  <h2>All Accounts</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Username </th>
        <th class="text-center">Email</th>
        <th class="text-center">Password</th>
        <th class="text-center">User Type</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from users";
      $result=$conn-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$row["id"]?>
      <td><?=$row["name"]?> 
      <td><?=$row["email"]?></td>
      <td><?=substr(password_hash($row["password"], PASSWORD_DEFAULT), 0, 10)?></td>
      <td><?=$row["user_type"]?></td>
    </tr>
    <?php
        }
    }
    ?>
  </table>