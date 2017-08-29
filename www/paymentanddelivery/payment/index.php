<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Как выполняется оплата садовых светильников » SvetSadPark.ru");

$APPLICATION->SetPageProperty('description', 'Информация об оплате светильников на сайте SvetSadPark.ru: наличный и безналичный расчет, оплата электронными деньгами.');
$APPLICATION->SetPageProperty('keywords', 'оплата садовых светильников, оплата парковых светильников, оплата уличных светильников, оплата светодиодных светильников, оплата садовых светильников');
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
                    <p><b>В точке самовывоза</b></p>

                    <p>- наличными при получении; </p>

                    <p>- безналичный расчет (перечисление на расчетный счет), предоплата. <a
                                href="http://svetsadpark.ru/rekvisit/voronkina.doc" title="Реквизиты для оплаты"
                                target="_blank">Реквизиты для оплаты</a>; </p>

                    <p>- банковской картой при получении. </p>
                    <b>
                        <br/>
                        При доставке заказа по Москве и области</b>
                    <p>- наличными при получении; </p>

                    <p>- безналичный расчет (счет на организацию или частное лицо). Оплата осуществляется перед
                        доставкой товара. <a href="http://svetsadpark.ru/rekvisit/voronkina.doc"
                                             title="Реквизиты для оплаты">Реквизиты для оплаты</a></p>

                    <p><b>Для региональных клиентов - безналичный расчет (счет на организацию или физическое лицо).</b> 
                    </p>

                    <p>Счет на Физическое лицо может быть оплачен on-line <b>через Интернет-банк</b> (если такая услуга
                        есть в сервисе Вашего банка) или непосредственно через отделения Сбербанка. </p>

                    <p>Оплата осуществляется перед отправкой товара. По Вашему желанию для дополнительных гарантий перед
                        оплатой возможно <b>заключение Договора купли-продажи </b>(в том числе и с Физическими лицами),
                        чтобы Вы были на 100% уверены в том, что товар будет отправлен Вам сразу после оплаты. </p>

                    <p>
                        <br/>
                    </p>

                    <p>При получении товара, оплаченного по безналичному расчету от организации или ИП, необходимо иметь
                        при себе доверенность или печать организации или ИП. При получении товара, оплаченного от
                        Физического лица, необходимо иметь при себе паспорт. </p>

                    <br/>
                    Возврат денежных средств осуществляется тем же способом, которым эти средства были получены, в
                    течение срока, регламентированного действующим законодательством. 
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