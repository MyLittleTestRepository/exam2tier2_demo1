<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 70");
?>Text here....<?$APPLICATION->IncludeComponent(
	"custom:simplecomp_70.exam",
	"",
	Array(
		"PRODUCTS_IBLOCK_ID" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>