<?php include ROOT . '/views/layouts/header.php';?>
<br>
<span class="title-name">Каталог</span>
<hr class="title-name">
<?
// рекурсивная функция, которая сформирует дерево категорий
function create_tree ($node, $element, $parent_id){

    $tree = '<ul>';

    for($i = 0; $i < count($node); $i++) {
        if($node[$i]["parent_id"] == $parent_id) {
            $tree .= "<li>"
            .$node[$i]['name']
            .' <a class="btn btn-default" href="node/edit/'
            .$node[$i]['id']
            .'">Редактировать</a> | <a class="btn btn-danger" href="node/del/'
            .$node[$i]['id']
            .'">Удалить</a>';
            $tree .=  create_tree ($node, $element, $node[$i]['id']);

            for($k = 0; $k < count($element); $k++){
                if($element[$k]["node_id"] == $node[$i]["id"]) {
                    $tree .= '<ul>'.$element[$k]["name"]
                    .' <a class="btn btn-default" href="element/edit/'
                    .$element[$k]['id']
                    .'">Редактировать</a> |  <a class="btn btn-danger" href="element/del/'
                    .$element[$k]['id']
                    .'">Удалить</a></ul>';
                }
            }
            $tree .= '</li>';
        }
        else {
            echo "  ";
        }
    }
    $tree .= '</ul>';               

    return $tree;        
}

?>
<div class="add-menu">
    <div class="row">
        <a class="btn btn-default" href="element/add">Добавить элемент</a>
        <a class="btn btn-default" href="node/add">Добавить раздел</a>
    </div>
</div>
<div class="row">
    <div class="">
        <?php 
        // вызываем функцию и строим дерево
        print_r (create_tree ($nodes, $elements, -1));
        ?>
    </div>
</div>
<hr>
<?php include ROOT . '/views/layouts/footer.php';?>