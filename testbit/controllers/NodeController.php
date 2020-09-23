<?php

class NodeController
{
    public function actionEdit($nodeId)
    {
        //получаем раздел для предварительного заполнения формы
        $node = Node::getNodeById($nodeId);

        $result = false;
        if(isset($_POST['edit-node'])){
            $errors = false;

            $name = '';
            $description = '';
            $parent_id = '';


            $description = $_POST['description'];
            $parent_id = $_POST['parent_id'];

            if($_POST['name'] == '')
                $errors[] = 'Введите название раздела';
            else
                $name = $_POST['name'];

            //если все верно обновляем Раздел
            if ($errors == false) {
                $result = Node::updateNode($nodeId, $name, $description, $parent_id);
            }
        }


        $titlePage = 'Редактирование раздела';
        require_once(ROOT . '/views/node/editNode.php');
        return true;
    }

    public function actionDel($nodeId)
    {   
        $node = Node::getNodeById($nodeId);

        $result = false;
        if(isset($_POST['del-node'])){
            $result = Node::delNode($_POST['node_id']);
        }
        $titlePage = 'Удаление раздела';
        require_once(ROOT . '/views/node/delNode.php');
        return true;
    }

    public function actionAdd()
    {
        $nodes = array();
        $nodes = Node::getNodesList();

        $result = false;
        if(isset($_POST['add-node'])){
            $errors = false;

            $name = '';
            $description = '';
            $parent_id = '';


            $name = $_POST['name'];
            $description = $_POST['description'];
            
            if(isset($_POST['parent_id']))
                $parent_id = $_POST['parent_id'];
            else
                $errors[] = 'Раздел не выбран';
            
            if($_POST['name'] == '')
                $errors[] = 'Введите название раздела';

            if ($errors == false) {
                $result = Node::addNode($name, $description, $parent_id);
            }
        }


        $titlePage = 'Добавление раздела';
        require_once(ROOT . '/views/node/addNode.php');
        return true;
    }
}
