<div id="ordersBtn" >
  <h2>Order Details</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Transaction ID</th>
        <th>Customer Name</th>
        <th>Contact Number</th>
        <th>Order Date</th>
        <th>Payment Method</th>
        <th>Order Status</th>
       
     </tr>
    </thead>
     <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from orders";
      $result=$conn-> query($sql);
      
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
       <tr>
          <td><?=$row["id"]?></td>
          <td><?=$row["name"]?></td>
          <td><?=$row["number"]?></td>
          <td><?=$row["date"]?></td>
          <td><?=$row["method"]?></td>       
          
         
          <?php 
                if($row["status"]==0){
                            
            ?>
                  <td><button class="btn btn-success" onclick="ChangeOrderStatus('<?=$row['id']?>')">Delivered</button></td>
            <?php
                        
                }else{
            ?>
              
                <td><button class="btn btn-danger" onclick="ChangeOrderStatus('<?=$row['id']?>')">In Progress </button></td>
                
              
       
        </tr>
    <?php
            
        }
      }
      }
    ?>
     
  </table>
   
    </div>
   
 
<!-- Modal -->
<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Order Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="order-view-modal modal-body">
        
        </div>
      </div><!--/ Modal content-->
    </div><!-- /Modal dialog-->
  </div>
<script>
     //for view order modal  
    $(document).ready(function(){
      $('.openPopup').on('click',function(){
        var dataURL = $(this).attr('data-href');
    
        $('.order-view-modal').load(dataURL,function(){
          $('#viewModal').modal({show:true});
        });
      });
    });
 
 </script>