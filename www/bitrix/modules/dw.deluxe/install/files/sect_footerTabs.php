<div id="footerTabsCaption">
	<div class="wrapper">
		<div class="items">
			<?$APPLICATION->ShowViewContent("sale_viewed_product_view_content_tab");?>
			<?$APPLICATION->ShowViewContent("catalog_top_view_content_tab");?>

		</div>
	</div>
</div>
<div id="footerTabs">
	<div class="wrapper">
		<div class="items">
			<?$APPLICATION->IncludeComponent(
	"bitrix:sale.viewed.product", 
	".default", 
	array(
		"VIEWED_COUNT" => "8",
		"VIEWED_NAME" => "Y",
		"VIEWED_IMAGE" => "Y",
		"VIEWED_PRICE" => "Y",
		"VIEWED_CANBUY" => "N",
		"VIEWED_CANBUSKET" => "N",
		"VIEWED_IMG_HEIGHT" => "200",
		"VIEWED_IMG_WIDTH" => "240",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"VIEWED_CURRENCY" => "default",
		"VIEWED_CANBASKET" => "N",
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
			<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "#CURRENT_IBLOCK_TYPE_ID#",
		"IBLOCK_ID" => "#CURRENT_IBLOCK_ID#",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "",
		"HIDE_NOT_AVAILABLE" => "Y",
		"ELEMENT_COUNT" => "12",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"VIEW_MODE" => "SECTION",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"SEF_MODE" => "N",
		"SEF_RULE" => "",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"ROTATE_TIMER" => "30"
	),
	false
);?>



		</div>
	</div>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.bigdata.products", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"RCM_TYPE" => "personal",
		"ID" => $_REQUEST["PRODUCT_ID"],
		"IBLOCK_TYPE" => "#CURRENT_IBLOCK_TYPE_ID#",
		"IBLOCK_ID" => "#CURRENT_IBLOCK_ID#",
		"SHOW_FROM_SECTION" => "N",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ELEMENT_CODE" => "",
		"DEPTH" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"PAGE_ELEMENT_COUNT" => "10",
		"LINE_ELEMENT_COUNT" => "3",
		"TEMPLATE_THEME" => "blue",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "OPT1",
			2 => "OPT_1",
			3 => "OPT_2",
		),
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action_cbdp",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"SHOW_PRODUCTS_#CURRENT_IBLOCK_ID#" => "Y",
		"PROPERTY_CODE_#CURRENT_IBLOCK_ID#" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_#CURRENT_IBLOCK_ID#" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_#CURRENT_IBLOCK_ID#" => "MORE_PHOTO",
		"LABEL_PROP_#CURRENT_IBLOCK_ID#" => "-",
		"PROPERTY_CODE_18" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_18" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_18" => "MORE_PHOTO",
		"OFFER_TREE_PROPS_18" => array(
		),
		"CURRENCY_ID" => "RUB"
	),
	false
);?>