<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Гарантия на садово-парковые светильники » SvetSadPark.ru");
$APPLICATION->SetPageProperty('description', 'Суммарный гарантийный срок (гарантия производителя + гарантия продавца) на продукцию составляет 5 лет. Долгосрочная гарантия на садово-парковые светильники.');
$APPLICATION->SetPageProperty('keywords', 'гарантия на садово-парковые светильники, гарантия на парковые светильники, гарантия на садовые светильники, гарантия на уличные светильники, гарантия на светодиодные светильники');
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
                    <p>Суммарный <b>гарантийный срок</b> (гарантия производителя + гарантия продавца) на продукцию
                        составляет: </p>

                    <p>- <b>5 лет</b> гарантии на изделия, изготовленные  из  алюминиевого сплава (силумина) путем
                        отливки, </p>

                    <p>- <b>2  года</b> гарантии на поршковое покрытие корпуса светильника </p>

                    <p>- <b>3 года</b>  гарантии на светодиодные чипы, электрическую  коммутационную  аппаратуру  и
                        электротехническую часть фонаря; </p>

                    <p>- <b>2 года</b> гарантии на корпус из устойчивого к УФ пластик </p>

                    <p>- <b>2 года</b> гарантии на солнечную панель </p>

                    <p>
                        <br/>
                    </p>

                    <p>При установке светильника и в процессе его эксплуатации руководствуйтесь <b>инструкцией,
                            прилагающейся к каждому светильнику</b>. Условия предоставления гарантии также указаны в
                        инструкции к светильнику. </p>

                    <p>
                        <br/>
                    </p>

                    <p>При возникновении вопросов, связанных с гарантией, Вы можете отправить письмо на электронную
                        почту <a href="mailto:agata-v@rambler.ru">agata-v@rambler.ru</a>  <b>c пометкой «Гарантия»<b> в
                                теме письма или позвонить по указанным ниже телефонам: </b></b></p>
                    <b><b>
                            <p><b>8-499-550-15-29 (будни 10.00-19.00)</b> </p>

                            <p>
                                <br/>
                            </p>

                            <p>Мы всегда идем навстречу своим покупателям и стараемся корректно и в максимально короткие
                                сроки решить возникшую проблему. </p>
                        </b></b></div>
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