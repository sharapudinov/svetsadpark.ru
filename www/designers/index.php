<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Светодиодные светильники оптом от производителя в Москве » SvetSadPark.ru ");
$APPLICATION->SetTitle("Сотрудничество с интернет-магазином уличного освещения  SvetSadPark.ru");

$APPLICATION->SetPageProperty('description', 'Купить светодиодные светильники оптом в магазине SvetSadPark.ru. Интернет-магазин СветСадПарк - оптовые продажи садовых светильников. Партнерский раздел компании SvetSadPark.ru');
$APPLICATION->SetPageProperty('keywords', 'сотрудничество по садовому освещению, сотрудничество по парковому освещению');

?>
    <div class="global-block-container">
        <div class="global-content-block">
            <p>Если Вы дизайнер, архитектор или занимаетесь розничной торговлей осветительным оборудованием - Вы можете стать нашим постоянным покупателем или партнером. Для этого
                просто позвоните по телефонам, указанным ниже.</p>
            <p>Для Вас существуют особые условия работы и система скидок, которые нужно обсудить индивидуально с нашими
                менеджерами.</p>

            <p><b>Адрес офиса и выставочного зала интернет-магазина Svetsadpark:</b></p>

            <p>г. Москва Киевское шоссе, д 1, Бизнес парк Румянцево корпус Г, 2 этаж офис 208.
                <br />
            </p>
            <p><b>Телефон оптового отдела:</b>
                <a onclick="yaCounter42154374.reachGoal('buy_one_click');return(true)"
                   class="phone_alloka" href="tel:+74995501529"
                   title="Номер телефона интернет-магазина Svetsadpark"
                   style="text-decoration:none;color:inherit">8-499-550-15-29</a>
                 </p>
            <div style="height: 450px;width: 100%">
                <script type="text/javascript" charset="utf-8"
                        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=rjh2op8vRIXLG6xzT76zCJxzlC2uR107&width=100%&height=450"></script>
            </div>
        </div>
    <div class="global-information-block">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            Array(
                "AREA_FILE_RECURSIVE" => "Y",
                "AREA_FILE_SHOW" => "sect",
                "AREA_FILE_SUFFIX" => "information_block",
                "COMPONENT_TEMPLATE" => ".default",
                "EDIT_TEMPLATE" => ""
            )
        ); ?>
    </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>