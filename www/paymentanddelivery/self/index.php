<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Самовывоз заказа » SvetSadPark.ru");

$APPLICATION->SetPageProperty('description', 'Информация о самовывозе заказа интернет-магазина SvetSadPark.ru из офиса в Москве. Самовывоз из магазина м. Румянцево.');
$APPLICATION->SetPageProperty('keywords', 'самовывоз светильников, самовывоз садовых светильников, самовывоз парковых светильников, самовывоз уличных светильников');
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "personal",
    array(
        "COMPONENT_TEMPLATE" => "personal",
        "ROOT_MENU_TYPE" => "left",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
    false
);?>
<div class="inside_page_content">
	<p>Самовывоз осуществляется <b>из нашего салона</b> в часы его работы. </p>
	<p><a href="">Подробнее о салоне</a> </p>

	<p>Самовывоз осуществляется только <b>после предварительного согласования</b> со специалистом Интернет-магазина, так как заказанный Вами товар должен быть доставлен со склада в салон. </p>

	<p>При оформлении заказа указывайте в соответствующем поле, что Вы хотели бы забрать заказ самовывозом. После получения заказа Интернет-магазином, с <b>Вами свяжется наш специалист для подтверждения заказа</b> и уточнения предполагаемой даты самовывоза. </p>

	<p>При получении в точке самовывоза товар проверяется на месте. </p>
	<p><a href="">Условия возврата</a></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>