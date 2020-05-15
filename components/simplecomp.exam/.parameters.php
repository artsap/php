<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    'GROUPS' => array(),
    'PARAMETERS' => array(
        'ID_CATALOG' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('ID_CATALOG'),
            'TYPE' => 'STRING',
            'DEFAULT' => '1',
        ),
        'ID_NEWS' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('ID_NEWS'),
            'TYPE' => 'STRING',
            'DEFAULT' => '2',
        ),
        'CATALOG_LINK' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('CATALOG_LINK'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'UF_NEWS_LINK',
        ),
        'SET_TITLE' => array(),
        'CACHE_TIME' => array(),
    ),
);
?>
