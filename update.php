<?php

header('Access-Controller-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-controller-Allow-Methods:POST');
header('Access-controller-Allow-Headers:Content-Type,
        Access-Controller-Allow-Headers,Authorization,X-Request-With');

$data = json_decode(file_get_contents("php://input"));
include('db.php');
if($data->id){

    $query2 = "SELECT * FROM products WHERE id =". $data->id;
    $run2 = mysqli_query($db,$query2);
    $product = mysqli_fetch_assoc($run2);

    $product_name = $product['product_name'];
    $product_price = $product['product_price'];
    $stock = $product['stock'];
    $discount = $product['discount'];

    if($data->discount!= ''){

        $discount = $data->discount;
    
    }
    if($data->product_name!= ''){
    
        $product_name = $data->product_name;
    
    }
    if($data->product_price!= ''){
    
        $product_price = $data->product_price;
    
    }
    if($data->stock!= ''){
    
        $stock = $data->stock;
    
    }
    $query = "UPDATE products SET product_name='$product_name',product_price=$product_price,stock=$stock,discount=$discount WHERE id =" . $data->id;

    /* $query ="UPDATE products SET ";
    $query.= "product_name='$product_name',";
    $query.= "product_price=$product_price,";
    $query.= "stock=$stock,";
    $query.= "discount=$discount WHERE id =" . $data->id; */

    $run = mysqli_query($db,$query);
    if($run){
    
        echo json_encode(['status'=>'success','msg'=>'product Updated']);         
    }else{
        echo json_encode(['status'=>'failed','msg'=>'product not Updated']); 
    }
    
    
}else{
    echo json_encode(['status'=>'failed','msg'=>'Product id is not given']); 

}



?>

