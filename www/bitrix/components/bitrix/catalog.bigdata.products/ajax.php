<?php
define("STOP_STATISTICS", true);
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("DisableEventsCheck", true);
define('BX_SECURITY_SESSION_READONLY', true);
define("PUBLIC_AJAX_MODE", true);

if (empty($_POST['parameters']))
{
	echo 'no parameters found';
	return;
}

if (isset($_REQUEST['site_id']) && !empty($_REQUEST['site_id']))
{
	if (!is_string($_REQUEST['site_id']))
		die();
	if (preg_match('/^[a-z0-9_]{2}$/i', $_REQUEST['site_id']) === 1)
		define('SITE_ID', $_REQUEST['site_id']);
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$signer = new \Bitrix\Main\Security\Sign\Signer;

$parameters = $signer->unsign($_POST['parameters'], 'bx.bd.products.recommendation');
$template = $signer->unsign($_POST['template'], 'bx.bd.products.recommendation');

$APPLICATION->IncludeComponent(
	"bitrix:catalog.bigdata.products", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"RCM_TYPE" => "any_personal",
		"ID" => $_REQUEST["PRODUCT_ID"],
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "",
		"SHOW_FROM_SECTION" => "N",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ELEMENT_CODE" => "",
		"DEPTH" => "2",
		"HIDE_NOT_AVAILABLE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"PAGE_ELEMENT_COUNT" => "30",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"PRICE_CODE" => array(
		),
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action_cbdp",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"SHOW_PRODUCTS_10" => "N",
		"PROPERTY_CODE_10" => array(
			0 => ",",
		),
		"CART_PROPERTIES_10" => array(
			0 => ",",
		),
		"ADDITIONAL_PICT_PROP_10" => "MORE_PHOTO",
		"LABEL_PROP_10" => "-",
		"PROPERTY_CODE_11" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_11" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_11" => "",
		"OFFER_TREE_PROPS_11" => "",
		"SHOW_PRODUCTS_12" => "N",
		"PROPERTY_CODE_12" => array(
			0 => ",",
		),
		"CART_PROPERTIES_12" => array(
			0 => ",",
		),
		"ADDITIONAL_PICT_PROP_12" => "MORE_PHOTO",
		"LABEL_PROP_12" => "-"
	),
	false
);