<div >
  <h2>Messages</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Name</th>
        <th class="text-center">Email </th>
        <th class="text-center">Number</th>
        <th class="text-center">Message</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from contact";
      $result=$conn-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$row["name"]?> 
      <td><?=$row["email"]?></td>
      <td><?=$row["number"]?></td>
      <td><?=$row["message"]?></td>
    </tr>
    <?php
        }
    }
    ?>
  </table>