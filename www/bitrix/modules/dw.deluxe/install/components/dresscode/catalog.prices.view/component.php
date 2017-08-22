<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
		die();

	if (CModule::IncludeModule("sale") &&
		CModule::IncludeModule("catalog") &&
		CModule::IncludeModule("iblock")
	){
		
		if(!empty($arParams["PRODUCT_ID"])){
			
			if (!isset($arParams["CACHE_TIME"])){
				$arParams["CACHE_TIME"] = 1285912;
			}

			global $USER;
			$cacheID = $USER->GetGroups()." / ".$arParams["PRODUCT_ID"];

			if(!empty($arParams["PRODUCT_PRICE_CODE"])){
				$cacheID .= implode("", $arParams["PRODUCT_PRICE_CODE"]);
			}

			if ($this->StartResultCache($arParams["CACHE_TIME"], $cacheID)){

				$OPTION_CURRENCY = CCurrency::GetBaseCurrency();
				$arResult["PRICES"] = array();
				$arPriceID = array();
				$minPriceID = 0;
				$minPrice = 0;

				$arResult["PRODUCT_PRICE_ALLOW_FILTER"] = array();

				if($arParams["PRODUCT_PRICE_CODE"][0] == "undefined"){
					unset($arParams["PRODUCT_PRICE_CODE"]);
				}

				if(!empty($arParams["PRODUCT_PRICE_CODE"])){
					$dbPriceType = CCatalogGroup::GetList(
				        array("SORT" => "ASC"),
				        array("NAME" => $arParams["PRODUCT_PRICE_CODE"])
				    );
					while ($arPriceType = $dbPriceType->Fetch()){
					    $arResult["PRODUCT_PRICE_ALLOW_FILTER"][] = $arPriceType["ID"];
					}
				}

				$arPriceFilter = array("PRODUCT_ID" => $arParams["PRODUCT_ID"], "CAN_ACCESS" => "Y");
				if(!empty($arResult["PRODUCT_PRICE_ALLOW_FILTER"])){
					$arPriceFilter["CATALOG_GROUP_ID"] = $arResult["PRODUCT_PRICE_ALLOW_FILTER"];
				}

				$dbPrice = CPrice::GetList(
			        array(),
			        $arPriceFilter,
			        false,
			        false,
			        array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO", "CAN_BUY")
			    );

				while ($arPrice = $dbPrice->Fetch()){

				    $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
			            $arPrice["ID"],
			            $USER->GetUserGroupArray(),
			            "N",
			            SITE_ID
			        );
				    
				    $arPrice["DISCOUNT_PRICE"] = CCatalogProduct::CountPriceWithDiscount(
			            $arPrice["PRICE"],
			            $arPrice["CURRENCY"],
			            $arDiscounts
			        );
				   
				    //convert currency
				    $arPrice["PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["PRICE"], $arPrice["CURRENCY"], $OPTION_CURRENCY);
					$arPrice["DISCOUNT_PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["DISCOUNT_PRICE"], $arPrice["CURRENCY"], $OPTION_CURRENCY);

					//format prices
				    $arPrice["PRICE_FORMATED"] = CCurrencyLang::CurrencyFormat($arPrice["PRICE"], $OPTION_CURRENCY);
				    $arPrice["DISCOUNT_PRICE_FORMATED"] = CCurrencyLang::CurrencyFormat($arPrice["DISCOUNT_PRICE"], $OPTION_CURRENCY);

				    $arResult["PRICES"][$arPrice["CATALOG_GROUP_ID"]] = $arPrice;
				    $arPriceID[$arPrice["CATALOG_GROUP_ID"]] = $arPrice["CATALOG_GROUP_ID"];

				}	

				$dbPriceType = CCatalogGroup::GetList(array("sort" => "desc"), array("ID" => $arPriceID, "CAN_ACCESS" => "Y"));

				while ($arPriceType = $dbPriceType->Fetch()){
					$arResult["PRICES"][$arPriceType["ID"]]["NAME"] = $arPriceType["NAME_LANG"];
				}

				//check min price
				if(!empty($arResult["PRICES"])){
					foreach ($arResult["PRICES"] as $ipr => $arNextPrice){
						if(empty($minPrice) || $minPrice >= $arNextPrice["DISCOUNT_PRICE"] && $arNextPrice["CAN_BUY"] == "Y"){
							$minPrice = $arNextPrice["DISCOUNT_PRICE"];
							$minPriceID = $arNextPrice["CATALOG_GROUP_ID"];
						}
					}
				}

				if(!empty($minPriceID)){
					$arResult["PRICES"][$minPriceID]["MIN_AVAILABLE_PRICE"] = "Y";
				}

				$this->setResultCacheKeys(array());
				$this->IncludeComponentTemplate();

			}
		}
	}

?>