<?php

class SiteController
{
    public function actionIndex()
    {
        //Получаем список Разделов
        $nodes = array();
        $nodes = Node::getNodesList();

        //Получаем список Элементов
        $elements = array();
        $elements = Element::getElementsList();

        $titlePage = "Тестовое задание ПервыйБит";
        require_once ROOT . '/views/site/index.php';

        return true;
    }
}
