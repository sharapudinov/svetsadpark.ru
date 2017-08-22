<?
if(CModule::IncludeModule("iblock") && CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")){
	$arPrice = CCatalogIBlockParameters::getPriceTypesList();
	$arTemplateParameters["HIDE_MEASURES"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("HIDE_MEASURES"),
		"TYPE" => "CHECKBOX",
		"REFRESH" => "Y"
	);
	$arTemplateParameters["PRODUCT_PRICE_CODE"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("IBLOCK_PRICE_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arPrice,
	);
}
?>