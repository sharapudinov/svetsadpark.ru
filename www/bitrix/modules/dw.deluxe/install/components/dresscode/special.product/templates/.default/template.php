<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(!empty($arResult["ITEMS"]) && !empty($arResult["PROPERTY_HEADING"])):?>
	<div id="specialBlock">
		<div id="specialProduct">
			<div class="specialProductHeading"><?=$arResult["PROPERTY_HEADING"]?></div>
			<div id="specialProductSlider">
				<ul class="productList slideBox">
					<?foreach ($arResult["ITEMS"] as $inx => $arNextElement):?>
						<?
							$this->AddEditAction($arNextElement["ID"], $arNextElement["EDIT_LINK"], CIBlock::GetArrayByID($arNextElement["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arNextElement["ID"], $arNextElement["DELETE_LINK"], CIBlock::GetArrayByID($arNextElement["IBLOCK_ID"], "ELEMENT_DELETE"), array());
						?>
						<li class="slideItem<?if(empty($arNextElement["SHOW_TIMER"])):?> noTimer<?endif;?>">
							<?if(!empty($arNextElement["SHOW_TIMER"])):?>
								<div class="specialTimeHeading"><?=GetMessage("SPECIAL_TIME_LEFT")?></div>
								<div class="specialTime" id="timer_<?=$this->GetEditAreaId($arNextElement["ID"]);?>_<?=$arNextElement["ID"]?>">
									<div class="specialTimeItem">
										<div class="specialTimeItemValue timerDayValue">0</div>
										<div class="specialTimeItemlabel"><?=GetMessage("TIMER_DAY_LABEL")?></div>
									</div>
									<div class="specialTimeItem">
										<div class="specialTimeItemValue timerHourValue">0</div>
										<div class="specialTimeItemlabel"><?=GetMessage("TIMER_HOUR_LABEL")?></div>
									</div>
									<div class="specialTimeItem">
										<div class="specialTimeItemValue timerMinuteValue">0</div>
										<div class="specialTimeItemlabel"><?=GetMessage("TIMER_MINUTE_LABEL")?></div>
									</div>
									<div class="specialTimeItem">
										<div class="specialTimeItemValue timerSecondValue">0</div>
										<div class="specialTimeItemlabel"><?=GetMessage("TIMER_SECOND_LABEL")?></div>
									</div>
								</div>
							<?endif;?>
							<div class="productItem item" id="<?=$this->GetEditAreaId($arNextElement["ID"]);?>" data-price-code="<?=implode("||", $arParams["PRODUCT_PRICE_CODE"])?>">
								<a href="<?=$arNextElement["DETAIL_PAGE_URL"]?>" class="picture"><img src="<?=$arNextElement["PICTURE"]["src"]?>" alt="<?=$arNextElement["NAME"]?>"><span class="getFastView" data-id="<?=$arNextElement["ID"]?>"><?=GetMessage("FAST_VIEW_PRODUCT_LABEL")?></span></a>
								<a href="<?=$arNextElement["DETAIL_PAGE_URL"]?>" class="name"><span class="middle"><?=$arNextElement["NAME"]?></span></a>
								<?if(!empty($arNextElement["PRICE"])):?>
									<?if($arNextElement["COUNT_PRICES"] > 1):?>
										<a class="price getPricesWindow" data-id="<?=$arNextElement["ID"]?>">
											<span class="priceIcon"></span><?=CCurrencyLang::CurrencyFormat($arNextElement["PRICE"]["DISCOUNT_PRICE"], $arResult["CURRENCY"], true)?>
											<?if($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arNextElement["CATALOG_MEASURE"]]["SYMBOL_RUS"])):?>
												<span class="measure"> / <?=$arResult["MEASURES"][$arNextElement["CATALOG_MEASURE"]]["SYMBOL_RUS"]?></span>
											<?endif;?>
											<?if(!empty($arNextElement["PRICE"]["DISCOUNT"])):?>
												<s class="discount"><?=CCurrencyLang::CurrencyFormat($arNextElement["PRICE"]["RESULT_PRICE"]["BASE_PRICE"], $arResult["CURRENCY"], true)?></s>
											<?endif;?>
										</a>
									<?else:?>
										<a class="price"><?=CCurrencyLang::CurrencyFormat($arNextElement["PRICE"]["DISCOUNT_PRICE"], $arResult["CURRENCY"], true)?>
											<?if($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arNextElement["CATALOG_MEASURE"]]["SYMBOL_RUS"])):?>
												<span class="measure"> / <?=$arResult["MEASURES"][$arNextElement["CATALOG_MEASURE"]]["SYMBOL_RUS"]?></span>
											<?endif;?>
											<?if(!empty($arNextElement["PRICE"]["DISCOUNT"])):?>
												<s class="discount"><?=CCurrencyLang::CurrencyFormat($arNextElement["PRICE"]["RESULT_PRICE"]["BASE_PRICE"], $arResult["CURRENCY"], true)?></s>
											<?endif;?>
										</a>
									<?endif;?>
								<?else:?>
									<a class="price"><?=GetMessage("REQUEST_PRICE_LABEL")?></a>
								<?endif;?>
								<a href="<?=$arNextElement["DETAIL_PAGE_URL"]?>" class="more" data-id="<?=$arNextElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/moreLink.png" alt="" class="icon"><?=GetMessage("MORE_LINK_LABEL")?></a>
							</div>
							<?if(!empty($arNextElement["PROPERTIES"]["TIMER_LOOP"]["VALUE"])):?>
								<script type="text/javascript">
									$(document).ready(function(){
										$("#timer_<?=$this->GetEditAreaId($arNextElement["ID"]);?>_<?=$arNextElement["ID"]?>").dwTimer({
											timerLoop: "<?=$arNextElement["PROPERTIES"]["TIMER_LOOP"]["VALUE"]?>",
											<?if(empty($arNextElement["PROPERTIES"]["TIMER_START_DATE"]["VALUE"])):?>
												startDate: "<?=MakeTimeStamp($arNextElement["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")?>"
											<?else:?>
												startDate: "<?=MakeTimeStamp($arNextElement["PROPERTIES"]["TIMER_START_DATE"]["VALUE"], "DD.MM.YYYY HH:MI:SS")?>"
											<?endif;?>
										});
									});
								</script>
							<?elseif(!empty($arNextElement["SHOW_TIMER"]) && !empty($arNextElement["PROPERTIES"]["TIMER_DATE"]["VALUE"])):?>
								<script type="text/javascript">
									$(document).ready(function(){
										$("#timer_<?=$this->GetEditAreaId($arNextElement["ID"]);?>_<?=$arNextElement["ID"]?>").dwTimer({
											endDate: "<?=MakeTimeStamp($arNextElement["PROPERTIES"]["TIMER_DATE"]["VALUE"], "DD.MM.YYYY HH:MI:SS")?>"
										});
									});
								</script>
							<?endif;?>
						</li>
					<?endforeach;?>
				</ul>
				<a href="#" class="specialSlideBtnLeft"></a>
				<a href="#" class="specialSlideBtnRight"></a>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#specialProductSlider").dwSlider({
						leftButton: ".specialSlideBtnLeft",
						rightButton: ".specialSlideBtnRight",
						autoMove: false,
						touch: false,
						delay: 5000,
						speed: 200
					});
				});
			</script>
		</div>
	</div>
<?endif;?>