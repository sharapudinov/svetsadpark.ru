<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
		die();

	if(!empty($_SESSION["VIEWED_PRODUCTS"])){
		//clear cache
		// if($_GET["clear_cache"])
		$arResult["ITEMS"] = $_SESSION["VIEWED_PRODUCTS"];
		$this->IncludeComponentTemplate();
	}

?>