<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сервис интернет-магазина SvetSadPark.ru » Все услуги магазина");

$APPLICATION->SetPageProperty('description', 'Клиент может получить актуальные каталоги продукции O.L., дополнительные параметры светильников, зарезервировать товар на срок до 3 дней бесплатно, расчет стоимости доставки в Ваш город.');
$APPLICATION->SetPageProperty('keywords', 'сервис интернет-магазина, сервис SvetSadPark.ru, услуги интернет-магазина, услуги SvetSadPark.ru');
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "personal",
    array(
        "COMPONENT_TEMPLATE" => "personal",
        "ROOT_MENU_TYPE" => "about",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
    false
); ?>
    <div class="global-block-container">
        <div class="global-content-block">
            <div class="bx_page">
                <div class="inside_page_content">
                    <p>1. По Вашему запросу (на электронную почту или по телефону) будут  предоставлены актуальные
                        каталоги продукции <b>O.L.</b> в формате PDF. </p>

                    <p>
                        <br/>
                    </p>

                    <p>2. По Вашему запросу (на электронную почту или по телефону) Вам могут быть предоставлены <b>дополнительные
                            параметры светильника</b> (вес, форма и размер основания, дополнительные фото, инструкция и.
                        т. д.) </p>

                    <p>
                        <br/>
                    </p>

                    <p>3. По Вашему запросу (на электронную почту или по телефону) мы можем <b>зарезервировать товар на
                            срок до 3 дней бесплатно</b>. </p>

                    <p>
                        <br/>
                    </p>

                    <p>4. По Вашему запросу (на электронную почту или по телефону) может быть произведен <b>расчет
                            стоимости доставки в Ваш город</b> конкретного выбранного товара. </p>

                    <p>
                        <br/>
                    </p>

                    <p>5. Если у вас есть макет внешнего освещения Вашего загородного дома, кафе, ресторана, салона
                        красоты, магазина и т. д., и Вы не можете найти продукцию, которая там использована - мы с
                        удовольствием поможем Вам <b>подобрать аналоги из нашего ассортимента</b>. </p>

                    <p>
                        <br/>
                    </p>

                    <p>6. <b>Для корпоративных клиентов</b> (сетевых кафе, ресторанов, баров, гостиниц, салонов красоты,
                        магазинов и т. д.) <b>образцы продукции</b> могут быть доставлены <b>бесплатно</b> по указанному
                        адресу в пределах МКАД (сами образцы предоставляются под залог). </p>

                    <p>
                        <br/>
                    </p>

                    <p>7. <b>Для корпоративных клиентов</b> (сетевых кафе, ресторанов, баров, гостиниц, салонов красоты,
                        магазинов и т. д.) предусмотрены <b>индивидуальные условия работы и персональный менеджер</b>. 
                    </p>

                    <p>
                        <br/>
                    </p>

                    <p><b>Телефон для корпоративных клиентов</b>: </p>

                    <p>8-499-550-15-29  (будни с 10.00 до 19.00)</p>
                </div>
            </div>
        </div>
    <div class="global-information-block">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "AREA_FILE_SHOW" => "sect",
                "AREA_FILE_SUFFIX" => "information_block",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => ""
            ),
            false
        ); ?>
    </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>