<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div id="simplecomp">
    <ul>
        <? foreach ($arResult['NEWS'] as $news): ?>
            <li>
                <strong><?= $news['NAME']; ?></strong> - <?= $news['DATE_ACTIVE_FROM']; ?> (<?= implode(', ', $news['SECTIONS']); ?>)
                <? if (is_array($news['ELEMENTS'])): ?>
                    <ul>
                        <? foreach ($news['ELEMENTS'] as $product): ?>
                            <li><?= $product['NAME']; ?> - <?= $product['PROPERTYS']['ARTICLE']['VALUE']; ?> - <?= $product['PROPERTYS']['MATERIAL']['VALUE']; ?> - <?= $product['PROPERTYS']['PRICE']['VALUE']; ?></li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?></li>
        <? endforeach; ?>
    </ul>
</div>