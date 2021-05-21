<?php
// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer  dumpautoload

function data_tree($data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($data as $item) {
        if ($item->parent_id == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            $child = data_tree($data, $item->id, $level + 1);
            $result = array_merge($result, $child);
        }
    }

    return $result;
}

function data_tree_html($data, $parent_id = 0, $string = '')
{
    foreach ($data as $key => $item) {
        if ($item['parent_id'] == $parent_id) {
            echo '<option value="'.$item['id'].'">';
            echo $string.$item['Ten'];
            echo '</option>';
            unset($data[$key]);
            data_tree_html($data, $item['id'], $string.'|---');
        }
    }
}

function data_tree_html_option($data, $parent_id = 0, $string = '')
{
    $html = '';
    foreach ($data as $key => $item) {
        if ($item['parent_id'] == $parent_id) {
            $html .= '<option value="'.$item['id'].'">';
            $html .= $string.$item['Ten'];
            $html .= '</option>';
            unset($data[$key]);
            $html .=data_tree_html_option($data, $item['id'], $string.'&nbsp;&nbsp;&nbsp;|---');
        }
    }
    return $html;
}

function formatPrice($number)
{
    $number = intval($number);

    return $number = number_format($number, 0, ',', '.').'đ';
}

?>

