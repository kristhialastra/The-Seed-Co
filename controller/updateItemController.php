<?php
    include_once "../config/dbconnect.php";

    $product_id=$_POST['id'];
    $p_name= $_POST['p_name'];
    $p_desc= $_POST['p_desc'];
    $p_price= $_POST['p_price'];

    if( isset($_FILES['newImage']) ){
        
        $location="image/";
        $img = $_FILES['newImage']['name'];
        $tmp = $_FILES['newImage']['tmp_name'];
        $dir = 'image/';
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','webp');
        $image =rand(1000,1000000).".".$ext;
        $final_image=$location. $image;
        if (in_array($ext, $valid_extensions)) {
            $path = UPLOAD_PATH . $image;
            move_uploaded_file($tmp, $dir.$image);
        }
    }else{
        $final_image=$_POST['existingImage'];
    }
    $updateItem = mysqli_query($conn, "UPDATE products SET 
        name='$p_name', 
        product_detail='$p_desc', 
        price=$p_price,
        image='$final_image' 
        WHERE id=$product_id");


    if($updateItem)
    {
        echo "true";
    }
    else
    {
        echo mysqli_error($conn);
    }
?>