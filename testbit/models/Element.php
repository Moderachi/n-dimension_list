<?php

class Element
{
    /*
    * Вставляем значения в таблицу
    * Требуемые: node_id (ИД раздела)
    *            name (Наименование Элемента)
    *            type (Тип Элемента)
    *            data (Произвольные данные в виде строки Элемента)
    */
    public static function addElement($node_id, $name, $type, $data)
    {
        $date_create = date("Y-m-d H:i:s");
        $db = Db::getConnection();

        $sql = 'INSERT INTO element (node_id, name, date_create, date_update, type, data) '
        . 'VALUES (:node_id, :name, :date_create, :date_update, :type, :data)';

        $result = $db->prepare($sql);
        $result->bindParam(':node_id', $node_id);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':date_create', $date_create);
        $result->bindParam(':date_update', $date_create);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->bindParam(':data', $data, PDO::PARAM_STR);

        return $result->execute();
    }

    /*
    * Выборка списка Элементов из бд
    */
    public static function getElementsList()
    {

        $db = Db::getConnection();

        $nodesList = array();

        $sql = 'SELECT * FROM element';
        
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $nodesList[$i]['id'] = $row['id'];
            $nodesList[$i]['node_id'] = $row['node_id'];
            $nodesList[$i]['name'] = $row['name'];
            $nodesList[$i]['date_create'] = $row['date_create'];
            $nodesList[$i]['date_update'] = $row['date_update'];
            $nodesList[$i]['type'] = $row['type'];
            $nodesList[$i]['data'] = $row['data'];
            $i++;
        }

        return $nodesList;
    }
    /*
    * Обновление значения в таблицу
    * Требуемые: elementId (ИД элемента)
    *            node_id (ИД раздела)
    *            name (Наименование Элемента)
    *            type (Тип Элемента)
    *            data (Произвольные данные в виде строки Элемента)
    */
    public static function updateElement($elementId, $node_id, $name, $type, $data)
    {
        $date_update = date("Y-m-d H:i:s");

        $db = Db::getConnection();

        $sql = 'UPDATE element SET node_id=:node_id, name=:name, date_update=:date_update, type=:type, data=:data '
        . 'WHERE id=:elementId';

        $result = $db->prepare($sql);
        $result->bindParam(':elementId', $elementId);
        $result->bindParam(':node_id', $node_id);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':date_update', $date_update);
        $result->bindParam(':type', $type);
        $result->bindParam(':data', $data, PDO::PARAM_STR);

        return $result->execute();
    }

    
    /**
     * Возвращает элемент по id
     * @param integer $elemntId
     */
    public static function getElementById($elemntId)
    {
        $id = intval($elemntId);

        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM element WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }

    /**
     * Возвращает элемент по id раздела
     * @param integer $nodeId
     */
    public static function getElementByNodeId($nodeId)
    {
        $id = intval($nodeId);

        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM element WHERE node_id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }
    /**
     * Удаляет элемент по id
     * @param integer $elemntId
     */
    public static function delElement($elemntId) {
        $id = intval($elemntId);
        $db = Db::getConnection();

        $sql = 'DELETE FROM element WHERE id=:id';
     
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
    
        return $result->execute();
    }

    /**
     * Возвращает строку вида <option selected value="{type}">{typeName}</option>
     * @param [] $element
     */
    public static function getTypeElement($element)
    {
        $array = array(
            'n' => 'Новость',
            'a' => 'Статья',
            'r' => 'Отзыв',
            'c' => 'Комментарий',
        );
        $html = '';
        foreach ($array as $key => $value) {
            $html .= '<option ';

            if($element['type'] == $key){
                $html .= 'selected ';
            }

            $html .= 'value="'.$key.'">'.$value.'</option>';
        }
        return $html;
    }

}