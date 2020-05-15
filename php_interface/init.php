<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

AddEventHandler('iblock', 'OnBeforeIBlockElementUpdate', array('UpdateProduct', 'UpdateProductActive'));

AddEventHandler("main", "OnBeforeUserAdd", array("UpdateUser", "UpdateUserManager"));
AddEventHandler("main", "OnBeforeUserUpdate", array("UpdateUser", "UpdateUserManager"));

class UpdateProduct
{
    function UpdateProductActive(&$arFields)
    {
        if ($arFields['IBLOCK_ID'] == 1 && CModule::IncludeModule('iblock')) {

            $arSelect = array('SHOW_COUNTER', 'ACTIVE');
            $arFilter = array('IBLOCK_ID' => 1, 'ID' => $arFields['ID']);
            $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arElement = $ob->GetFields();
            }

            if ($arElement['SHOW_COUNTER'] > 2 && $arFields['ACTIVE'] == 'N') {
                global $APPLICATION;
                $APPLICATION->throwException('Товар невозможно деактивировать, у него ' . $arElement['SHOW_COUNTER'] . ' просмотров');
                return false;
            }
        }
    }
}

class UpdateUser
{
    function UpdateUserManager(&$arFields)
    {
        $userContents = false;
        foreach ($arFields['GROUP_ID'] as $group) {
            if ($group['GROUP_ID'] == 5) {
                $userContents = true;
            }
        }

        if ($userContents == true) {

            require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');

            $arUserSelect = array(
                'ACTIVE' => 'Y',
                'GROUPS_ID' => array('5')
            );

            $userEmail = array();
            $rsUsers = CUser::GetList(($by = 'id'), ($order = 'asc'), $arUserSelect);
            while ($arUser = $rsUsers->Fetch()):
                $userEmai[] = $arUser['EMAIL'];
            endwhile;

            $arEventFields = array(
                'EMAIL_TO' => implode(', ', $userEmai),
                'NAME' => $arFields['NAME'],
                'LOGIN' => $arFields['LOGIN']
            );

            CEvent::Send('USER_CONTENT_MANAGER_Y', 's1', $arEventFields);
        }
    }
}

?>