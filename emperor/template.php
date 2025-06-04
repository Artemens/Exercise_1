<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$uniqueItems = [];
?>
<div class="fire-news-container">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
    <?endif;?>
    
    <div class="fire-news-grid">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            if(isset($uniqueItems[$arItem['ID']])) continue;
            $uniqueItems[$arItem['ID']] = true;
            
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
             <div class="fire-news-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="fire-card-bg"></div>
                    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                    <div class="fire-news-image">
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                     alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                     title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"/>
                                <div class="fire-overlay"></div>
                            </a>
                        <?else:?>
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                 alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                 title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"/>
                            <div class="fire-overlay"></div>
                        <?endif;?>
                    </div>
                <?endif?>
                    <div class="fire-news-content">
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <div class="fire-news-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
                    <?endif?>
                    
                    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <h3 class="fire-news-title"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>
                        <?else:?>
                            <h3 class="fire-news-title"><?echo $arItem["NAME"]?></h3>
                        <?endif;?>
                    <?endif;?>
                    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                        <div class="fire-news-preview"><?echo $arItem["PREVIEW_TEXT"];?></div>
                    <?endif;?>
                    <?if($arItem["PROPERTIES"]["Avtor"]["VALUE"]):?>
                        <div class="fire-news-author">
                            <span class="fire-author-label">Автор:</span>
                            <span class="fire-author-name"><?=$arItem["PROPERTIES"]["Avtor"]["VALUE"]?></span>
                        </div>
                    <?endif;?>
                    
                    <div class="fire-news-meta">
                        <?foreach($arItem["FIELDS"] as $code=>$value):?>
                            <span class="fire-meta-item">
                                <?=GetMessage("IBLOCK_FIELD_".$code)?>: <?=$value;?>
                            </span>
                        <?endforeach;?>
                        
                        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                            <?if($pid != "Avtor"):?>
                                <span class="fire-meta-item">
                                    <?=$arProperty["NAME"]?>:
                                    <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                        <?=implode(", ", $arProperty["DISPLAY_VALUE"]);?>
                                    <?else:?>
                                        <?=$arProperty["DISPLAY_VALUE"];?>
                                    <?endif?>
                                </span>
                            <?endif;?>
                        <?endforeach;?>
                    </div>
                    <div class="fire-read-more-container">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="fire-read-more-btn">
                            <?=GetMessage('READ_MORE')?>
                            <svg class="fire-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
    
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="fire-pagination"><?=$arResult["NAV_STRING"]?></div>
    <?endif;?>
</div>