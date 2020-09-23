<?php

class Node
{
    /*
    * Обновление значения в таблице node
    * Требуемые: nodeId (ИД раздела)
    *            name (Наименование Раздела)
    *            description (Тип Раздела)
    *            parent_id (ИД Раздела родителя)
    */
    public static function updateNode($nodeId, $name, $description, $parent_id)
    {
        $date_update = date("Y-m-d H:i:s");

        $db = Db::getConnection();

        $sql = 'UPDATE node SET name=:name, date_update=:date_update, description=:description, parent_id=:parent_id '
        . 'WHERE id=:nodeId';

        $result = $db->prepare($sql);
        $result->bindParam(':nodeId', $nodeId);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':date_update', $date_update);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':parent_id', $parent_id);

        return $result->execute();
    }


    /*
    * Вставляем значения в таблицу
    * Требуемые: name (Наименование Раздела)
    *            description (Тип Раздела)
    *            parent_id (ИД Раздела родителя)
    */
    public static function addNode($name, $description, $parent_id)
    {
        $date_create = date("Y-m-d H:i:s");
        $db = Db::getConnection();

        $sql = 'INSERT INTO node (name, date_create, date_update, description, parent_id) '
        . 'VALUES (:name, :date_create, :date_update, :description, :parent_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':date_create', $date_create);
        $result->bindParam(':date_update', $date_create);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);

        return $result->execute();
    }
    /*
    * Выборка списка Разделов из бд
    */
    public static function getNodesList()
    {

        $db = Db::getConnection();

        $nodesList = array();

        $sql = 'SELECT * FROM node';
        
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $nodesList[$i]['id'] = $row['id'];
            $nodesList[$i]['name'] = $row['name'];
            $nodesList[$i]['date_create'] = $row['date_create'];
            $nodesList[$i]['date_update'] = $row['date_update'];
            $nodesList[$i]['description'] = $row['description'];
            $nodesList[$i]['parent_id'] = $row['parent_id'];
            $i++;
        }

        return $nodesList;
    }

    /**
     * Возвращает раздел по id
     * @param integer $nodeId
     */
    public static function getNodeById($nodeId)
    {
        $id = intval($nodeId);

        if ($id) {  
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM node '
                . 'WHERE id = '.$id);

            return $result->fetch();
        }
    }

    /**
     * Возвращает дочерний раздел по id
     * @param integer $nodeId
     */
    public static function getChildNode($nodeId)
    {
        $id = intval($nodeId);

        if ($id) {  
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM node '
                . 'WHERE parent_id = '.$id);

            return $result->fetch();
        }
    }

    /**
     * Возвращает список разделов без дочерних элементов
     * @param [] $nodesList
     */
    public static function getNodeNotChild($nodesList)
    {
        $nodesNotChild = $nodesList;
        $elementList = Element::getElementsList();
        $i = 0;
        foreach ($nodesList as $node) {
            foreach ($elementList as $element) {
                if($node['id'] == $element['node_id'])
                    unset($nodesNotChild[$i]);
            }
            foreach ($nodesList as $node2) {
                if($node['id'] == $node2['parent_id'])
                    unset($nodesNotChild[$i]);
            }
            $i++;
        }
        return $nodesNotChild;
    }

    /**
     * Удаляет раздел и все дочерние элементы
     * @param integer $nodeId
     */
    public static function delNode($nodeId) {
        $id = intval($nodeId);

        $db = Db::getConnection();

        $sql = 'DELETE FROM node WHERE id=:id;';
     
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
    
        return $result->execute();
    }

}