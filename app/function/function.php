<?php
// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer  dumpautoload

function data_tree($data,$parent_id=0,$level=0){
    $result=[];
    foreach ($data as $item){
        if($item->parent_id==$parent_id){
            $item['level']=$level;
            $result[]=$item;
            $child=data_tree($data,$item->id,$level+1);
            $result=array_merge($result,$child);
        }
    }
    return $result;
}
function formatPrice($number)
{
    $number=intval($number);

    return $number =number_format($number,0,',','.').'đ';
}

?>

