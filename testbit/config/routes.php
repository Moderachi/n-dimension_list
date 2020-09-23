<?php

return array(
    'element/add' => 'element/add', // actionAdd в ElementController
    'element/del/([0-9]+)' => 'element/del/$1', // actionDelElement в ElementController
    'element/edit/([0-9]+)' => 'element/edit/$1', // actionEditElement в ElementController
    
    'node/add' => 'node/add', // actionAdd в NodeController   
 	'node/del/([0-9]+)' => 'node/del/$1', // actionDelNode в NodeController 
    'node/edit/([0-9]+)' => 'node/edit/$1', // actionEditNode в NodeController 
    '' => 'site/index', // actionIndex в SiteController
    
);