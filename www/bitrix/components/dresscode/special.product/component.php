<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
		die();

		use Bitrix\Highloadblock as HL;
		use Bitrix\Main\Entity;

		if(!CModule::IncludeModule("iblock") || !CModule::IncludeModule('highloadblock') || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("sale") || !CModule::IncludeModule("dw.deluxe"))
			return false;

		if (!isset($arParams["CACHE_TIME"])){
			$arParams["CACHE_TIME"] = 1285912;
		}

		//prop gettr
		if(empty($arParams["PROP_NAME"])){
			$arParams["PROP_NAME"] = "PRODUCT_DAY";
		}

		if(empty($arParams["ELEMENTS_COUNT"])){
			$arParams["ELEMENTS_COUNT"] = 10;
		}

		$cacheID = $USER->GetGroups();

		if(!empty($arParams["PRODUCT_PRICE_CODE"])){
			$cacheID .= implode("", $arParams["PRODUCT_PRICE_CODE"]);
		}

		if(empty($arParams["PICTURE_WIDTH"])){
			$arParams["PICTURE_WIDTH"] = 200;
		}

		if(empty($arParams["PICTURE_HEIGHT"])){
			$arParams["PICTURE_HEIGHT"] = 220;
		}

		if(!empty($arParams["IBLOCK_ID"])){

			if ($this->StartResultCache($arParams["CACHE_TIME"], $cacheID)){

				//settings
				$OPTION_ADD_CART  = COption::GetOptionString("catalog", "default_can_buy_zero");
				$OPTION_CURRENCY  = $arResult["CURRENCY"] = CCurrency::GetBaseCurrency();

				$arResult["PRODUCT_PRICE_ALLOW"] = array();
				$arResult["PRODUCT_PRICE_ALLOW_FILTER"] = array();

				//arResult arrays
				$arResult["ITEMS"] = array();
				$arResult["PROPERTY_HEADING"] = array();

				//components arrays
				$arMeasureProductsID = array();

				//get property
				$rsProperty = CIBlockProperty::GetList(Array(), Array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arParams["PROP_NAME"]));
				if($arProperty = $rsProperty->GetNext()){
					$arResult["PROPERTY_HEADING"] = $arProperty["NAME"];
				}

				if(!empty($arParams["PRODUCT_PRICE_CODE"])){
					$dbPriceType = CCatalogGroup::GetList(
				        array("SORT" => "ASC"),
				        array("NAME" => $arParams["PRODUCT_PRICE_CODE"])
				    );
					while ($arPriceType = $dbPriceType->Fetch()){
						if($arPriceType["CAN_BUY"] == "Y"){
					    	$arResult["PRODUCT_PRICE_ALLOW"][] = $arPriceType;
						}
					    $arResult["PRODUCT_PRICE_ALLOW_FILTER"][] = $arPriceType["ID"];
					}
				}

				if(!empty($arResult["PROPERTY_HEADING"])){

					//get products
					$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID", "DATE_MODIFY", "*");
					$arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "!PROPERTY_".$arParams["PROP_NAME"] => false);
					$rsProducts = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => $arParams["ELEMENTS_COUNT"]), $arSelect);
					while($obProducts = $rsProducts->GetNextElement()){

						$arNextElement = array();
						$arNextElement = $obProducts->GetFields();
						$arNextElement["PROPERTIES"] = $obProducts->GetProperties();

						// если у товара есть sku
						if(CCatalogSKU::IsExistOffers($arNextElement["ID"])){

							//get sku by dw.deluxe module
							$arSkuProperties = DwSKU::getSkuPropertiesByIblockID($arParams["IBLOCK_ID"]);
							$arSkuPriceCodes = array();
							$arSkuPriceCodes["PRODUCT_PRICE_ALLOW"] = $arResult["PRODUCT_PRICE_ALLOW"];
							$arSkuPriceCodes["PRODUCT_PRICE_ALLOW_FILTER"] = $arResult["PRODUCT_PRICE_ALLOW_FILTER"];
							$arSkuPriceCodes["PARAMS_PRICE_CODE"] = $arParams["PRODUCT_PRICE_CODE"];
							$arOffers = DwSKU::getSkuByProductID($arNextElement["ID"], $arParams["IBLOCK_ID"], array(
									"HIDE_NOT_AVAILABLE" => "N",
									"OPTION_ADD_CART" => "N"
								), $arSkuPriceCodes
							);

							$arActiveProperties = DwSKU::setSkuActiveProperties($arOffers["OFFERS"], $arSkuProperties, $arParams["~PRODUCT_ID"]);
							$arActiveOffer = DwSKU::setSkuActiveOffer($arOffers["OFFERS"], $arActiveProperties["CLEAN_PROPERTIES"], $arParams["~PRODUCT_ID"]);
							$arNextElement = array_merge($arNextElement, $arActiveProperties, $arActiveOffer);

							//set price by sku
							if(!empty($arActiveOffer["SKU_ACTIVE_OFFER"])){

								$arNextElement["~ID"] = $arNextElement["ID"];
								$arNextElement["ID"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["ID"];
								// $arNextElement["NAME"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["NAME"];
								$arNextElement["PRICE"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["PRICE"];
								$arNextElement["COUNT_PRICES"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["COUNT_PRICES"];
								$arNextElement["CATALOG_AVAILABLE"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["CATALOG_AVAILABLE"];
								$arNextElement["CATALOG_QUANTITY"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["CATALOG_QUANTITY"];
								$arNextElement["CATALOG_MEASURE"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["CATALOG_MEASURE"];

								if(!empty($arActiveOffer["SKU_ACTIVE_OFFER"]["DETAIL_PICTURE"])){
									$arNextElement["DETAIL_PICTURE"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["DETAIL_PICTURE"];
								}

								if(!empty($arActiveOffer["SKU_ACTIVE_OFFER"]["PROPERTIES"]["MORE_PHOTO"]["VALUE"])){
									$arNextElement["PROPERTIES"]["MORE_PHOTO"] = $arActiveOffer["SKU_ACTIVE_OFFER"]["PROPERTIES"]["MORE_PHOTO"];
								}

								if(empty($arResult["SKU_INFO"])){
									$arResult["SKU_INFO"] = array();
									$arResult["SKU_INFO"] = CCatalogSKU::GetInfoByProductIBlock($arResult["IBLOCK_ID"]);
								}

							}

						}else{

							if(!empty($arResult["PRODUCT_PRICE_ALLOW"])){
								$arPriceCodes = array();
								foreach($arResult["PRODUCT_PRICE_ALLOW"] as $ipc => $arNextAllowPrice){
									$dbPrice = CPrice::GetList(
								        array(),
								        array(
								            "PRODUCT_ID" => $arNextElement["ID"],
								            "CATALOG_GROUP_ID" => $arNextAllowPrice["ID"]
								        )
								    );
									if($arPriceValues = $dbPrice->Fetch()){
										$arPriceCodes[] = array(
											"ID" => $arNextAllowPrice["ID"],
											"PRICE" => $arPriceValues["PRICE"],
											"CURRENCY" => $arPriceValues["CURRENCY"],
											"CATALOG_GROUP_ID" => $arNextAllowPrice["ID"]
										);
									}
								}
							}

							if(!empty($arResult["PRODUCT_PRICE_ALLOW"]) && !empty($arPriceCodes) || empty($arParams["PRODUCT_PRICE_CODE"]))
								$arNextElement["PRICE"] = CCatalogProduct::GetOptimalPrice($arNextElement["ID"], 1, $USER->GetUserGroupArray(), "N", $arPriceCodes);

							//price count
							$arPriceFilter = array("PRODUCT_ID" => $arNextElement["ID"], "CAN_ACCESS" => "Y");
							if(!empty($arResult["PRODUCT_PRICE_ALLOW_FILTER"])){
								$arPriceFilter["CATALOG_GROUP_ID"] = $arResult["PRODUCT_PRICE_ALLOW_FILTER"];
							}

							$dbPrice = CPrice::GetList(
						        array(),
						        $arPriceFilter,
						        false,
						        false,
						        array("ID")
						    );
							$arNextElement["COUNT_PRICES"] = $dbPrice->SelectedRowsCount();

						}

						$arButtons = CIBlock::GetPanelButtons(
							$arNextElement["IBLOCK_ID"],
							!empty($arNextElement["~ID"]) ? $arNextElement["~ID"] : $arNextElement["ID"],
							$arNextElement["IBLOCK_SECTION_ID"],
							array("SECTION_BUTTONS" => true,
								  "SESSID" => true,
								  "CATALOG" => true
							)
						);

						$arNextElement["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
						$arNextElement["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

						//комплекты
						$arNextElement["COMPLECT"] = array();
						$arComplectID = array();

						// $rsComplect = CCatalogProductSet::getList(
						// 	array("SORT" => "ASC"),
						// 	array(
						// 		"TYPE" => 1,
						// 		"OWNER_ID" => $arNextElement["ID"],
						// 		"!ITEM_ID" => $arNextElement["ID"]
						// 	),
						// 	false,
						// 	false,
						// 	array("*")
						// );

						// while ($arComplectItem = $rsComplect->Fetch()) {
						// 	$arNextElement["COMPLECT"]["ITEMS"][$arComplectItem["ITEM_ID"]] = $arComplectItem;
						// 	$arComplectID[$arComplectItem["ITEM_ID"]] = $arComplectItem["ITEM_ID"];
						// }

						if(!empty($arComplectID)){

							$arNextElement["COMPLECT"]["RESULT_PRICE"] = 0;
							$arNextElement["COMPLECT"]["RESULT_BASE_DIFF"] = 0;
							$arNextElement["COMPLECT"]["RESULT_BASE_PRICE"] = 0;

							$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "CATALOG_MEASURE");
							$arFilter = Array("ID" => $arComplectID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
							$rsComplectProducts = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
							while($obComplectProducts = $rsComplectProducts->GetNextElement()){

								$complectProductFields = $obComplectProducts->GetFields();
								if(!empty($arResult["PRODUCT_PRICE_ALLOW"])){
									$arPriceCodes = array();
									foreach($arResult["PRODUCT_PRICE_ALLOW"] as $ipc => $arNextAllowPrice){
										$dbPrice = CPrice::GetList(
									        array(),
									        array(
									            "PRODUCT_ID" => $complectProductFields["ID"],
									            "CATALOG_GROUP_ID" => $arNextAllowPrice["ID"]
									        )
									    );
										if($arPriceValues = $dbPrice->Fetch()){
											$arPriceCodes[] = array(
												"ID" => $arNextAllowPrice["ID"],
												"PRICE" => $arPriceValues["PRICE"],
												"CURRENCY" => $arPriceValues["CURRENCY"],
												"CATALOG_GROUP_ID" => $arNextAllowPrice["ID"]
											);
										}
									}
								}


								if(!empty($arResult["PRODUCT_PRICE_ALLOW"]) && !empty($arPriceCodes) || empty($arParams["PRODUCT_PRICE_CODE"]))
									$complectProductFields["PRICE"] = CCatalogProduct::GetOptimalPrice($complectProductFields["ID"], 1, $USER->GetUserGroupArray(), "N",  $arPriceCodes);

								$complectProductFields["PRICE"]["DISCOUNT_PRICE"] = $complectProductFields["PRICE"]["DISCOUNT_PRICE"] * $arNextElement["COMPLECT"]["ITEMS"][$complectProductFields["ID"]]["QUANTITY"];
								$complectProductFields["PRICE"]["DISCOUNT_PRICE"] -= $complectProductFields["PRICE"]["DISCOUNT_PRICE"] * $arNextElement["COMPLECT"]["ITEMS"][$complectProductFields["ID"]]["DISCOUNT_PERCENT"] / 100;
								$complectProductFields["PRICE"]["RESULT_PRICE"]["BASE_PRICE"] = $complectProductFields["PRICE"]["RESULT_PRICE"]["BASE_PRICE"] * $arNextElement["COMPLECT"]["ITEMS"][$complectProductFields["ID"]]["QUANTITY"];
								$complectProductFields["PRICE"]["PRICE_DIFF"] = $complectProductFields["PRICE"]["RESULT_PRICE"]["BASE_PRICE"] - $complectProductFields["PRICE"]["DISCOUNT_PRICE"];
								$complectProductFields["PRICE"]["BASE_PRICE_FORMATED"] = CurrencyFormat($complectProductFields["PRICE"]["RESULT_PRICE"]["BASE_PRICE"], $OPTION_CURRENCY);
								$complectProductFields["PRICE"]["PRICE_FORMATED"] = CurrencyFormat($complectProductFields["PRICE"]["DISCOUNT_PRICE"], $OPTION_CURRENCY);
								$arNextElement["COMPLECT"]["RESULT_PRICE"] += $complectProductFields["PRICE"]["DISCOUNT_PRICE"];
								$arNextElement["COMPLECT"]["RESULT_BASE_PRICE"] += $complectProductFields["PRICE"]["RESULT_PRICE"]["BASE_PRICE"];
								$arNextElement["COMPLECT"]["RESULT_BASE_DIFF"] += $complectProductFields["PRICE"]["PRICE_DIFF"];

								$complectProductFields = array_merge(
									$arNextElement["COMPLECT"]["ITEMS"][$complectProductFields["ID"]],
									$complectProductFields
								);

								$arNextElement["COMPLECT"]["ITEMS"][$complectProductFields["ID"]] = $complectProductFields;

							}

							$arNextElement["COMPLECT"]["RESULT_PRICE_FORMATED"] = CurrencyFormat($arNextElement["COMPLECT"]["RESULT_PRICE"], $OPTION_CURRENCY);
							$arNextElement["COMPLECT"]["RESULT_BASE_DIFF_FORMATED"] = CurrencyFormat($arNextElement["COMPLECT"]["RESULT_BASE_DIFF"], $OPTION_CURRENCY);
							$arNextElement["COMPLECT"]["RESULT_BASE_PRICE_FORMATED"] = CurrencyFormat($arNextElement["COMPLECT"]["RESULT_BASE_PRICE"], $OPTION_CURRENCY);

							//set price
							$arNextElement["PRICE"]["DISCOUNT_PRICE"] = $arNextElement["COMPLECT"]["RESULT_PRICE"];
							if($arNextElement["COMPLECT"]["RESULT_BASE_DIFF"] > 0){
								$arNextElement["PRICE"]["DISCOUNT"] = $arNextElement["COMPLECT"]["RESULT_BASE_DIFF"];
								$arNextElement["PRICE"]["RESULT_PRICE"]["BASE_PRICE"] = $arNextElement["COMPLECT"]["RESULT_BASE_PRICE"];
							}

						}

						//measure
						$arMeasureProductsID[$arNextElement["CATALOG_MEASURE"]] = $arNextElement["CATALOG_MEASURE"];

						//picture
						if(!empty($arNextElement["DETAIL_PICTURE"])){
							$arNextElement["PICTURE"] = CFile::ResizeImageGet($arNextElement["DETAIL_PICTURE"], array("width" => $arParams["PICTURE_WIDTH"], "height" => $arParams["PICTURE_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 80);
						}else{
							$arNextElement["PICTURE"]["src"] = SITE_TEMPLATE_PATH."/images/empty.png";
						}

						//timer
						if(!empty($arNextElement["PROPERTIES"]["TIMER_DATE"]["VALUE"])){
							$dateDiff = MakeTimeStamp($arNextElement["PROPERTIES"]["TIMER_DATE"]["VALUE"], "DD.MM.YYYY HH:MI:SS") - time();
							$arNextElement["SHOW_TIMER"] = $dateDiff > 0;
						}elseif(!empty($arNextElement["PROPERTIES"]["TIMER_LOOP"]["VALUE"])){
							$arNextElement["SHOW_TIMER"] = true;
						}else{
							$arNextElement["SHOW_TIMER"] = false;
						}

						//write item
						$arResult["ITEMS"][$arNextElement["ID"]] = $arNextElement;
					}

				}

				//коэффициент еденица измерения
				$rsMeasure = CCatalogMeasure::getList(
					array(),
					array(
						"ID" => $arMeasureProductsID
					),
					false,
					false,
					false
				);

				while($arNextMeasure = $rsMeasure->Fetch()) {
					$arResult["MEASURES"][$arNextMeasure["ID"]] = $arNextMeasure;
				}

				$this->setResultCacheKeys(array());
				$this->IncludeComponentTemplate();
			}
		}
?>