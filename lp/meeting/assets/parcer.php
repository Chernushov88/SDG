<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="noindex, nofollow" />

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">

    <!-- CSS Global -->
    <link rel="stylesheet" async href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link async href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/superfish/css/superfish.css" rel="stylesheet">
    <!--
    <link href="assets/plugins/prettyPhoto/css/prettyPhoto.css" rel="stylesheet">
    <link href="assets/plugins/animate.css" rel="stylesheet">
    <link href="assets/plugins/countdown/jquery.countdown.css" rel="stylesheet">
    <link href="assets/plugins/isotope/jquery.isotope.css" rel="stylesheet">
-->
    <!--
    <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
-->
    <link rel="stylesheet" href="https://sdg-trade.com/components/com_jevents/views/alternative/assets/css/events_css.css?3.4.14">
    <link href="assets/css/theme.css" rel="stylesheet">
    <!--    <link href="assets/css/theme-blue.css" rel="stylesheet" id="css-switcher-link">-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">

    <!--[if lt IE 9]>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Wrap all content -->
    <div class="wrapper">

        <!-- Modal -->
        <section class="page-section light" id="schedule">
            <div class="container">

                <?php
                $content = file_get_contents('https://www.marathonbet.ru/su/betting/Basketball/');
$pos = strpos($content, '<div class="pure-u-1');
 $content = substr($content, $pos);
                $pos = strpos($content, '<div id="body_footer');
                $content = substr($content, 0, $pos);
                $content = str_replace('<table class="category-header">','', $content);
                echo $content;
?>



            </div>
        </section>
    </div>

    <div id="table" name="table"></div>
    <input type="button" value="Проверить" onclick="Excel()">

    <script>
        function addTable() {

            var name;
            var name2;
            var total;
            var datatime;
            var regexp = /\((\d+\.\d+)\)/;
            var str;
            var myTableDiv = document.getElementById("table");
            var table = document.createElement('TABLE');
            var tableBody = document.createElement('TBODY');
            table.appendChild(tableBody);

            for (var i = 0; i < document.getElementsByClassName("event-header").length; i++) {
                var tr = document.createElement('TR');
                var tr2 = document.createElement('TR');
                tableBody.appendChild(tr);
                tableBody.appendChild(tr2);
                name = document.getElementsByClassName("event-header")[i].getElementsByClassName("member-area-content-table")[0].getElementsByTagName("span")[0].innerHTML;
                name2 = document.getElementsByClassName("event-header")[i].getElementsByClassName("member-area-content-table")[0].getElementsByTagName("span")[1].innerHTML;
                datatime = document.getElementsByClassName("event-header")[i].getElementsByClassName("date")[0].innerHTML;
                for (var j = 0; j < document.getElementsByClassName("event-header")[i].getElementsByTagName('td').length; j++) {
                    var nametwo = document.createElement('TD');
                    var nameone = document.createElement('TD');
                    var totalpoint = document.createElement('TD');
                    totalpoint.setAttribute("rowspan", "2");
                    var datatimetd = document.createElement('TD');
                    datatimetd.setAttribute("rowspan", "2");
                    var td3 = document.createElement('TD');
                    var td4 = document.createElement('TD');
                    var td5 = document.createElement('TD');
                    var td6 = document.createElement('TD');
                    var td7 = document.createElement('TD');
                    var td8 = document.createElement('TD');
                    var td9 = document.createElement('TD');
                    var td10 = document.createElement('TD');
                    if (document.getElementsByClassName("event-header")[i].getElementsByTagName("td")[j].getAttribute('data-mutable-id') == "S6mainRow") {
                        str = document.getElementsByClassName("event-header")[i].getElementsByTagName("td")[j].innerHTML;
                        total = (regexp.exec(str))[1];
                        if (total != 'null') {
                            nameone.appendChild(document.createTextNode(name));
                            nametwo.appendChild(document.createTextNode(name2));
                            totalpoint.appendChild(document.createTextNode(total));
                            datatimetd.appendChild(document.createTextNode(datatime));
                            td3.appendChild(document.createTextNode(""));
                            td4.appendChild(document.createTextNode(""));
                            td5.appendChild(document.createTextNode(""));
                            td6.appendChild(document.createTextNode(""));
                            td7.appendChild(document.createTextNode(""));
                            td8.appendChild(document.createTextNode(""));
                            td9.appendChild(document.createTextNode(""));
                            td10.appendChild(document.createTextNode(""));
                            tr.appendChild(nameone);
                            tr.appendChild(datatimetd);
                            tr.appendChild(td3);
                            tr.appendChild(td4);
                            tr.appendChild(td5);
                            tr.appendChild(td6);
                            tr2.appendChild(nametwo);
                            tr2.appendChild(td7);
                            tr2.appendChild(td8);
                            tr2.appendChild(td9);
                            tr2.appendChild(td10);
                            tr.appendChild(totalpoint);
                        }
                    }


                }

            }
            myTableDiv.appendChild(table);
        }
        addTable();
document.getElementsByClassName("wrapper")[0].parentNode.removeChild(document.getElementsByClassName("wrapper")[0]);



        //    for (i = 0; i < 10; i++)
        //{
        //    var tr = document.createElement('tr');
        //    tr.id = 'tr' + 1;
        //    var td1 = document.createElement('td');
        //    var td2 = document.createElement('td');
        //    document.getElementById('stat').appendChild(tr);
        //    td1.innerHTML = "1";
        //    document.getElementById('tr' + i).appendChild(td1);
        //    td2.innerHTML = "2";
        //    document.getElementById('tr' + i).appendChild(td2);
        //}

    </script>
    <script>function Excel(table, name, filename){
            var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
            table = document.getElementById("table");
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
            var link = document.createElement("a");
link.download = "filename.xls";
link.href = uri + base64(format(template, ctx));
link.click();   
        }</script>
</body>

</html>
<!--,'')-->
