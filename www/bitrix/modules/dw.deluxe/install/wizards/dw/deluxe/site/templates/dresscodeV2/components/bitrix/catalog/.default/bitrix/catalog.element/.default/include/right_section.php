	<div class="mainTool">
		<div class="article<?if(empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])):?> hidden<?endif;?>">
			<?=GetMessage("CATALOG_ART_LABEL")?><span class="changeArticle" data-first-value="<?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span>
		</div>
		<?if(!empty($arResult["MIN_PRICE"])):?>
			<?if($arResult["COUNT_PRICES"] > 1):?>
				<a href="#" class="price changePrice getPricesWindow" data-id="<?=$arResult["ID"]?>">
					<span class="priceIcon"></span><?=$arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
					<?if($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"])):?>
						<span class="measure"> / <?=$arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"]?></span>
					<?endif;?>
					<?if(!empty($arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0):?>
						<span class="oldPriceLabel"><?=GetMessage("OLD_PRICE_LABEL")?><s class="discount"><?=$arResult["MIN_PRICE"]["PRINT_VALUE"]?></s></span>
					<?endif;?>
				</a>
			<?else:?>
				<a class="price changePrice"><?=$arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
					<?if($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"])):?>
						<span class="measure"> / <?=$arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"]?></span>
					<?endif;?>
					<?if(!empty($arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0):?>
						<span class="oldPriceLabel"><?=GetMessage("OLD_PRICE_LABEL")?><s class="discount"><?=$arResult["MIN_PRICE"]["PRINT_VALUE"]?></s></span>
					<?endif;?>
				</a>
			<?endif;?>
		<?else:?>
			<a class="price"><?=GetMessage("REQUEST_PRICE_LABEL")?></a>
		<?endif;?>
		<div class="row">
			<?if(!empty($arResult["MIN_PRICE"])):?>
				<a href="#" class="addCart changeID changeCart<?if($arResult["CAN_BUY"] === false || $arResult["CAN_BUY"] === "N"):?> disabled<?endif;?>" data-id="<?=$arResult["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/incart.png" alt="<?=GetMessage("ADDCART_LABEL")?>" class="icon"><?=GetMessage("ADDCART_LABEL")?></a>
			<?else:?>
				<a href="#" class="addCart changeID changeCart disabled requestPrice" data-id="<?=$arResult["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/request.png" alt="<?=GetMessage("REQUEST_PRICE_BUTTON_LABEL")?>" class="icon"><?=GetMessage("REQUEST_PRICE_BUTTON_LABEL")?></a>
			<?endif;?>
		</div>
	</div>
	<div class="secondTool">
		<?if(isset($arResult["PROPERTIES"]["RATING"]["VALUE"])):?>
			<div class="row">
			    <img src="<?=SITE_TEMPLATE_PATH?>/images/reviews.png" alt="" class="icon">
			    <span class="label<?if(count($arResult["REVIEWS"]) > 0):?> countReviewsTools<?endif;?>"><?=GetMessage("REVIEWS_COUNT")?> <?=count($arResult["REVIEWS"])?></span>
			    <div class="rating">
			      <i class="m" style="width:<?=($arResult["PROPERTIES"]["RATING"]["VALUE"] * 100 / 5)?>%"></i>
			      <i class="h"></i>
			    </div>
			</div>
	    <?endif;?>	
	    <?if($arParams["SHOW_REVIEW_FORM"]):?>
	   	<div class="row">
	   		<a href="#" class="reviewAddButton label"><img src="<?=SITE_TEMPLATE_PATH?>/images/addReviewSmall.png" alt="<?=GetMessage("REVIEWS_ADD")?>" class="icon"><?=GetMessage("REVIEWS_ADD")?></a>
	   	</div>
	    <?endif;?>
		<div class="row">
			<a href="#" class="fastBack label changeID<?if(empty($arResult["MIN_PRICE"]) || $arResult["CAN_BUY"] === "N" || $arResult["CAN_BUY"] === false):?> disabled<?endif;?>" data-id="<?=$arResult["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/fastBack.png" alt="<?=GetMessage("FASTBACK_LABEL")?>" class="icon"><?=GetMessage("FASTBACK_LABEL")?></a>
		</div>
		<div class="row">
			<a href="#" class="addWishlist label" data-id="<?=$arResult["~ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/wishlist.png" alt="<?=GetMessage("WISHLIST_LABEL")?>" class="icon"><?=GetMessage("WISHLIST_LABEL")?></a>
		</div>
		<div class="row">
			<a href="#" class="addCompare label changeID" data-id="<?=$arResult["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/compare.png" alt="<?=GetMessage("COMPARE_LABEL")?>" class="icon"><?=GetMessage("COMPARE_LABEL")?></a>
		</div>
		<div class="row">
			<?if($arResult["CATALOG_QUANTITY"] > 0):?>
				<?if(!empty($arResult["PRODUCT_STORES"])):?>
					<a href="#" data-id="<?=$arResult["ID"]?>" class="inStock label changeAvailable getStoresWindow"><img src="<?=SITE_TEMPLATE_PATH?>/images/inStock.png" alt="<?=GetMessage("AVAILABLE")?>" class="icon"><span><?=GetMessage("AVAILABLE")?></span></a>
				<?else:?>
					<span class="inStock label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/inStock.png" alt="<?=GetMessage("AVAILABLE")?>" class="icon"><span><?=GetMessage("AVAILABLE")?></span></span>
				<?endif;?>
			<?else:?>
				<?if($arResult["CAN_BUY"] === true || $arResult["CAN_BUY"] === "Y"):?>
					<a class="onOrder label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/onOrder.png" alt="<?=GetMessage("ON_ORDER")?>" class="icon"><?=GetMessage("ON_ORDER")?></a>
				<?else:?>
					<a class="outOfStock label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/outOfStock.png" alt="<?=GetMessage("CATALOG_NO_AVAILABLE")?>" class="icon"><?=GetMessage("CATALOG_NO_AVAILABLE")?></a>
				<?endif;?>
			<?endif;?>
		</div>
		<div class="row">
			<div class="ya-share-label"><?=GetMessage("SHARE_LABEL")?></div>
			<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,telegram"></div>
		</div>
	</div>