<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

//clear params
foreach($arParams as $key=>$val)
{
	$val=trim($val);
	if(is_numeric($val))
		$val=intval($val);
	$arParams[$key]=$val;
}

if($this->StartResultCache())
{
	
	//get sections
	$arFilter=['IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID'],
			   $arParams['PRODUCTS_LINK_CODE'],
			   'ACTIVE' => 'Y'];
	$arSelect=[$arParams['PRODUCTS_LINK_CODE'],
			   'ID',
			   'NAME'];
	
	$Res=CIBlockSection::GetList('',$arFilter,false,$arSelect,false);
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}
	
	while($section=$Res->Fetch())
	{
		$arResult['SECTIONS'][$section['ID']]['NAME']=$section['NAME'];
		foreach($section[$arParams['PRODUCTS_LINK_CODE']] as $news_id)
			$arResult['NEWS'][$news_id]['SECTIONS_ID'][]=$section['ID'];
	}

	//get news
	$arFilter=['IBLOCK_ID' => $arParams['NEWS_IBLOCK_ID'],
			   'ID' => array_keys($arResult['NEWS']),
			   'ACTIVE' => 'Y'];
	$arSelect=['ID',
			   'NAME',
			   'DATE_ACTIVE_FROM'];
	
	$Res=CIBlockElement::GetList('',$arFilter,false,false,$arSelect);
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}
	
	while($news=$Res->Fetch())
	{
		$arResult['NEWS'][$news['ID']]['NAME']=$news['NAME'];
		$arResult['NEWS'][$news['ID']]['DATE_ACTIVE_FROM']=$news['DATE_ACTIVE_FROM'];
	}
	
	//get products
	$arFilter=['IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID'],
			   'SECTION_ID' => array_keys($arResult['SECTIONS']),
			   'ACTIVE' => 'Y'];
	$arSelect=['ID',
			   'IBLOCK_SECTION_ID',
			   'NAME',
			   'PROPERTY_MATERIAL',
			   'PROPERTY_ARTNUMBER',
			   'PROPERTY_PRICE'];
	
	$Res=CIBlockElement::GetList('',$arFilter,false,false,$arSelect);
	
	if(!$Res->SelectedRowsCount())
	{
		$this->AbortResultCache();
		return;
	}
	
	while($product=$Res->Fetch())
	{
		$arResult['PRODUCTS'][$product['ID']]['NAME']=$product['NAME'];
		$arResult['PRODUCTS'][$product['ID']]['PROPERTY_PRICE']=$product['PROPERTY_PRICE_VALUE'];
		$arResult['PRODUCTS'][$product['ID']]['PROPERTY_MATERIAL']=$product['PROPERTY_MATERIAL_VALUE'];
		$arResult['PRODUCTS'][$product['ID']]['PROPERTY_ARTNUMBER']=$product['PROPERTY_ARTNUMBER_VALUE'];
		$arResult['SECTIONS'][$product['IBLOCK_SECTION_ID']]['PRODUCTS_ID'][$product['ID']]=$product['ID'];
		
	}
	
	if(count($arResult['PRODUCTS']))
	{
		$arResult['COUNT']=count($arResult['PRODUCTS']);
		$this->setResultCacheKeys(['COUNT']);
	}
	
	$this->includeComponentTemplate();
}
if($arResult['COUNT'])
	$APPLICATION->SetTitle(GetMessage('COUNT').$arResult['COUNT']);