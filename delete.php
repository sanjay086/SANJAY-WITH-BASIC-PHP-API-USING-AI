<?php

header('Access-Controller-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-controller-Allow-Methods:DELETE');
header('Access-controller-Allow-Headers:Content-Type,
        Access-Controller-Allow-Headers,Authorization,X-Request-With');

$data = json_decode(file_get_contents("php://input"));
include('db.php');
if($data->id){

    $query = "DELETE FROM products WHERE id =". $data->id;
    $run = mysqli_query($db,$query);
    if($run){
    
        echo json_encode(['status'=>'success','msg'=>'product Deleted']);         
    }else{
        echo json_encode(['status'=>'failed','msg'=>'product not Deleted']); 
    }
    
    
}else{
    echo json_encode(['status'=>'failed','msg'=>'Product id is not given']); 

}



?>

