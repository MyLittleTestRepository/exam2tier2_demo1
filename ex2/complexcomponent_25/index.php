<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комплексный компонент 25");
?>Text here....<?$APPLICATION->IncludeComponent(
	"custom:complexcomp_25.exam",
	"",
	Array(

	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>