<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?if(!empty($arResult)):?>
<ul>
	<?foreach($arResult['NEWS'] as $news_id=>$news):?>
	<li>
		<?foreach($news['SECTIONS_ID'] as $section_id):?>
			<?$names[$section_id]=$arResult['SECTIONS'][$section_id]['NAME']?>
		<?endforeach?>
		<b><?=$news['NAME']?></b> - <?=$news['DATE_ACTIVE_FROM']?> (<?=implode(', ',$names)?>)
		<ul>
			<?foreach($news['SECTIONS_ID'] as $section_id):?>
				<?foreach($arResult['SECTIONS'][$section_id]['PRODUCTS_ID'] as $id):?>
				<li><?=implode(' - ',$arResult['PRODUCTS'][$id])?></li>
				<?endforeach?>
			<?endforeach?>
		</ul>
	</li>
	<?endforeach?>
</ul>
<?endif?>