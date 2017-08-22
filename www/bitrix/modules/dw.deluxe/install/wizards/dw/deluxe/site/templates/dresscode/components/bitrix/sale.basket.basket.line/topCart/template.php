<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$frame = $this->createFrame()->begin();
?>
<div class="wrap">
	<a<?if(!empty($arResult["NUM_PRODUCTS"])):?> href="<?=SITE_DIR?>personal/cart/"<?endif;?> class="icon<?if(!empty($arResult["NUM_PRODUCTS"])):?> active<?endif;?>"></a>
		<div class="nf">
			<a<?if(!empty($arResult["NUM_PRODUCTS"])):?> href="<?=SITE_DIR?>personal/cart/"<?endif;?> class="heading"><?=GetMessage("CART")?><ins<?if(!empty($arResult["NUM_PRODUCTS"])):?> class="active"<?endif;?>><?=$arResult["NUM_PRODUCTS"]?></ins></a>
			<?if(!empty($arResult["NUM_PRODUCTS"])):?>
				<a href="<?=SITE_DIR?>personal/cart/#order" class="link"><?=GetMessage("ORDER");?></a>
			<?else:?>
				<span class="text"><?=GetMessage("EMPTY")?></span>
			<?endif;?>
		</div>
</div>
<?$frame->end();?>
