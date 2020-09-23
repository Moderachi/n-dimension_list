<?php

class ElementController
{
    public function actionEdit($elementId)
    {
        //получаем элемент для предварительного заполнения формы
        $element = Element::getElementById($elementId);

        $result = false;
        if(isset($_POST['edit-element'])){
            $errors = false;

            $node_id = '';
            $name = '';
            $data = '';
            $type = '';


            $data = $_POST['data'];

            if(isset($_POST['node_id'])){
                if(Node::getChildNode($_POST['node_id'])){
                    $errors[] = 'Раздел уже занят';
                }
                else{
                    $node_id = $_POST['node_id'];
                }
            }
            else{
                $errors[] = 'Выберите раздел';
            }
            
            if($_POST['name'] == '')
                $errors[] = 'Введите название элемента';
            else
                $name = $_POST['name'];

            if(isset($_POST['type']))
                $type = $_POST['type'];
            else
                $errors[] = 'Выберите тип элемента';

            if ($errors == false) {
                $result = Element::updateElement($elementId, $node_id, $name, $type, $data);
            }
        }


        $titlePage = 'Редактирование элемента';
        require_once(ROOT . '/views/element/editElement.php');
        return true;
    }


    public function actionDel($elementId)
    {
        $element = Element::getElementById($elementId);

        $result = false;
        if(isset($_POST['del-element'])){
            $result = Element::delElement($_POST['element_id']);
        }
        $titlePage = 'Удаление элемента';
        require_once(ROOT . '/views/element/delElement.php');
        return true;
    }
    public function actionAdd()
    {

        $result = false;
        if(isset($_POST['add-element'])){
            $errors = false;

            $node_id = '';
            $name = '';
            $data = '';
            $type = '';


            $name = $_POST['name'];
            
            $data = $_POST['data'];
            if(isset($_POST['node_id'])){
                if(Node::getChildNode($_POST['node_id'])){
                    $errors[] = 'Раздел не выбран';
                }
                else{
                    $node_id = $_POST['node_id'];
                }
            }

            if(!isset($_POST['node_id']))
                $errors[] = 'Выберите раздел';
            
            if($_POST['name'] == '')
                $errors[] = 'Введите название элемента';

            if(!isset($_POST['type']))
                $errors[] = 'Выберите тип элемента';
            else
                $type = $_POST['type'];
            if ($errors == false) {
                $result = Element::addElement($node_id, $name, $type, $data);
            }
        }


        $titlePage = 'Добавление элемента';
        require_once(ROOT . '/views/element/addElement.php');
        return true;
    }
}
