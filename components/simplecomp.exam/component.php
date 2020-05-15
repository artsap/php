<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */

/** @global CMain $APPLICATION */

use Bitrix\Iblock;
use Bitrix\Main;
use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError(GetMessage('IBLOCK_MODULE_NOT_INSTALLED'));
    return;
}

$IBLOCK_ID = trim($arParams['ID_CATALOG']);
$IBLOCK_ID_NEWS = trim($arParams['ID_NEWS']);
$CATALOG_LINK = trim($arParams['CATALOG_LINK']);

$arResult = array();
$el = 0;
$count = 0;

$arSelectNews = array('ID', 'IBLOCK_ID', 'NAME', 'DATE_ACTIVE_FROM');
$arFilterNews = array('IBLOCK_ID' => $IBLOCK_ID_NEWS, 'ACTIVE' => 'Y');

$res = CIBlockElement::GetList(array(), $arFilterNews, false, array(), $arSelectNews);
while ($ob = $res->GetNextElement()) {

    $arFields = $ob->GetFields();
    $arResult['NEWS'][$el] = $arFields;

    $aectionArr = array();
    $arSelect = array('IBLOCK_ID', 'ID', 'NAME');
    $arSectionFiltr = array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y', $CATALOG_LINK => $arFields['ID']);

    $arrSection = CIBlockSection::GetList(array(), $arSectionFiltr, false, $arSelect);
    while ($arSection = $arrSection->GetNext()) {

        $arResult['NEWS'][$el]['SECTIONS'][] = $arSection['NAME'];
        $aectionArr[] = $arSection['ID'];
    }

    $arSelectProduct = array('ID', 'IBLOCK_ID', 'NAME', 'DATE_ACTIVE_FROM', 'PROPERTY_*');
    $arFilterProduct = array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y', 'SECTION_ID' => $aectionArr);
    $el1 = 0;

    $res1 = CIBlockElement::GetList(array(), $arFilterProduct, false, array(), $arSelectProduct);
    while ($ob1 = $res1->GetNextElement()) {
        $arFields1 = $ob1->GetFields();
        $arProps1 = $ob1->GetProperties();
        $arResult['NEWS'][$el]['ELEMENTS'][$el1] = $arFields1;
        $arResult['NEWS'][$el]['ELEMENTS'][$el1]['PROPERTYS'] = $arProps1;
        $el1++;
        $count++;
    }

    $el++;
}

if ($arParams['SET_TITLE'] == 'Y') {
    $APPLICATION->SetTitle(GetMessage('TITLE') . $count);
}

$this->includeComponentTemplate();

?>