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
//function data_tree($data,$parent_id=0,$level=0)
//{
//    $cate_child = [];
//    foreach ($data as $key=> $item) {
//        if ($item->parent_id == $parent_id) {
//            $cate_child[] = $item;
//        }
//    }
//    if ($cate_child) {
//        if($level==0){
//
//        }
//        foreach ($cate_child as $key => $item) {
//            echo '<li>
//                <a>'.$item['Ten'].'</a>';
//                echo '<ul class="submenu">';
//                data_tree($data, $item['id'],$level+1);
//                echo '</ul>';
//            echo '</li>';
//        }
//    }
//}
function formatPrice($number)
{
    $number=intval($number);

    return $number =number_format($number,0,',','.').'đ';
}

?>

