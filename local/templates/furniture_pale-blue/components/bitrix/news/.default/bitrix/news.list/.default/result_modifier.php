<?
if(!empty($arResult['ITEMS'][0]['ACTIVE_FROM']))
	{
		$arResult['SPECIALDATE']=$arResult['ITEMS'][0]['ACTIVE_FROM'];
		$this->__component->setResultCacheKeys(['SPECIALDATE']);
	}