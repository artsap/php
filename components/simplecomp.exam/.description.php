<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => GetMessage('MY_COMPONENT'),
    'DESCRIPTION' => GetMessage('MY_COMPONENT_DESC'),
    'SORT' => 0,
    'CACHE_PATH' => 'Y',
    'PATH' => array(
        'ID' => 'exam',
        'NAME' => GetMessage('MY_COMPONENT_DESC'),
        'CHILD' => array(
            'ID' => 'exam',
            'NAME' => GetMessage('MY_COMPONENT_DESC'),
            'SORT' => 10,
        )
    ),
);

?>