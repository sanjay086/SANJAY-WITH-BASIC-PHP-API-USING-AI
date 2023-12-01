<?php

header('Access-Controller-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-controller-Allow-Methods:POST');
header('Access-controller-Allow-Headers:Content-Type,
        Access-Controller-Allow-Headers,Authorization,X-Request-With');

$data = json_decode(file_get_contents("php://input"));
include('db.php');

if($data->discount== ''){

    echo json_encode(['status'=>'failed','msg'=>'discount not provide !']); 

}elseif($data->product_name== ''){

    echo json_encode(['status'=>'failed','msg'=>'Product name not provide !']); 

}elseif($data->product_price== ''){

    echo json_encode(['status'=>'failed','msg'=>'Product Price not provide !']); 

}elseif($data->stock== ''){

    echo json_encode(['status'=>'failed','msg'=>'Product stock not provide !']); 

}else{

$query ="INSERT INTO products(product_name,product_price,stock,discount)";
$query.="VALUES('$data->product_name',$data->product_price,$data->stock,$data->discount)";
$run = mysqli_query($db,$query);
if($run){

    echo json_encode(['status'=>'success','msg'=>'product added !']);         
}else{
    echo json_encode(['status'=>'failed','msg'=>'product not added !']); 
}

}


?>

