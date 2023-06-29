<div class="container p-5">
    <h4>Edit Product Detail</h4>
    <?php
        include_once "../config/dbconnect.php";
        $ID = $_POST['record'];
        $qry = mysqli_query($conn, "SELECT * FROM products WHERE id='$ID'");
        if ($qry === false) {
            die("Query execution failed: " . mysqli_error($conn));
        }
        $numberOfRow = mysqli_num_rows($qry);
        if ($numberOfRow > 0) {
            while ($row1 = mysqli_fetch_array($qry)) {
    ?>
                <form id="update-Items" onsubmit="updateItems()" enctype='multipart/form-data'>
                    <div class="form-group">
                        <input type="text" class="form-control" id="id" value="<?=$row1['id']?>" hidden>
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="p_name" value="<?=$row1['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="desc">Product Description:</label>
                        <input type="text" class="form-control" id="p_desc" value="<?=$row1['product_detail']?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Unit Price:</label>
                        <input type="number" class="form-control" id="p_price" value="<?=$row1['price']?>">
                    </div>
                    <div class="form-group">
                        <img width='200px' height='150px' src='<?=$row1["image"]?>'>
                        <div>
                            <label for="file">Choose Image:</label>
                            <input type="hidden" id="existingImage" class="form-control" value="<?=$row1['image']?>">
                            <input type="file" id="newImage" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="height:40px" class="btn btn-primary">Update Item</button>
                    </div>
    <?php
            }
        } else {
            echo "No records found.";
        }
    ?>
                </form>
</div>