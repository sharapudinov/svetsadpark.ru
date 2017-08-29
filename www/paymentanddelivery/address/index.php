<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Адрес магазина SvetSadPark.ru » м. Румянцево (Москва)");
$APPLICATION->SetPageProperty('description', 'Салон SvetSadPark.ru расположен по адресу: г.Москва, Киевское шоссе (500 метров за МКАД), БП Румянцево, корпус Г, второй этаж, павильон Г207 ');
$APPLICATION->SetPageProperty('keywords', 'адрес SvetSadPark.ru, адрес магазина садовых светильников, адрес магазина уличных светильников, адрес магазина парковых светильников, адрес магазина светодиодных светильников');
?><?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"COMPONENT_TEMPLATE" => "personal",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "about",
		"USE_EXT" => "N"
	)
);?>

    <div itemscope="" itemtype="http://schema.org/Organization">
        <h1 itemprop="name">Магазин садово-паркового освещения SvetSadPark.ru</h1>
        <p>В нашем салоне Вы можете познакомиться с нашей продукцией вживую, выбрать понравившейся Вам товар, получить
            консультации опытных менеджеров, оформить и оплатить заказ, заказать доставку.&nbsp;</p>
        <p>При оформлении заказа в салоне&nbsp;</p>
        <p><b style="font-size: 18px;color: red">назовите кодовое слово «САДОВЫЕ ФОНАРИ» и получите дополнительную скидку 10%</b>&nbsp;
        </p>
        <p>При расчете возможна оплата наличными или банковской картой.&nbsp;</p>
        <p>В салоне Вы можете заказать доставку как по г. Москве и Московской области, так и в любой регион России.
            Доставка до транспортной компании в этом случае производится бесплатно.&nbsp;</p>

        <ul class="contactList">
            <li>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <img alt="cont1.png" src="/bitrix/templates/dresscodeV2/images/cont1.png" title="cont1.png">
                        </td>
                        <td>
                            <p><b itemprop="telephone" class="phone_alloka">8-800-775-12-05</b></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </li>
            <li>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <img alt="cont2.png" src="/bitrix/templates/dresscodeV2/images/cont2.png" title="cont2.png">
                        </td>
                        <td>
                            <a href="mailto:info@SvetSadPark.ru"><b>info@SvetSadPark.ru</b></a><br>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </li>
            <li>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <img alt="cont3.png" src="/bitrix/templates/dresscodeV2/images/cont3.png" title="cont3.png">
                        </td>
                        <td itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                                    <b itemprop="streetAddress">г.Москва, Киевское шоссе,
                                        Бизнес парк Румянцево корпус Г, 2 этаж офис 208.    </b>&nbsp;
                        </td>
                    </tr>
                    </tbody>
                </table>
            </li>
            <li>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <img alt="cont4.png" src="/bitrix/templates/dresscodeV2/images/cont4.png" title="cont4.png">
                        </td>
                        <td>
                            <b>с 10:00 до 19:00<br>
                            без выходных</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </li>
        </ul>
    <div style="height: 450px;width: 100%">
        <script type="text/javascript" charset="utf-8"
                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=rjh2op8vRIXLG6xzT76zCJxzlC2uR107&width=100%&height=450"></script>
    </div>




       <!-- <script>
            $(function () {
                $(".fancybox2").fancybox({});
            })
        </script>-->

          <div class="wrap_imgmap"><a href="/upload/images/imgmap1.jpg" class="fancybox2"> <img width="100%" src="/upload/images/imgmap1.jpg"> </a> <a href="/upload/images/imgmap2.jpg" class="fancybox2">
                <img width="100%" src="/upload/images/imgmap2.jpg"> </a></div>
    </div><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>