<?php
require('constant.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Хочешь работать в команде професcионалов?</title>
    <link rel="canonical" href="https://sdg-trade.com/lp/salesmanager/"/>
    <meta name="description" content="Мы ищем талантливых менеджеров по продажам">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://www.google.com/recaptcha/api.js?hl=ru" async defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $("#frmContact").on('submit', (function(e) {
                e.preventDefault();
                $("#mail-status").hide();
                $('#send-message').hide();
                $('#loader-icon').show();
                $.ajax({
                    url: "contact.php",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        "name": $('input[name="name"]').val(),
                        "email": $('input[name="email"]').val(),
                        "phone": $('input[name="phone"]').val(),
                        "content": $('textarea[name="content"]').val(),
                        "g-recaptcha-response": $('textarea[id="g-recaptcha-response"]').val()
                    },
                    success: function(response) {
                        $("#mail-status").show();
                        $('#loader-icon').hide();
                        if (response.type == "error") {
                            $('#send-message').show();
                            $("#mail-status").attr("class", "error");
                        } else if (response.type == "message") {
                            $('#send-message').hide();
                            $("#mail-status").attr("class", "success");
                        }
                        $("#mail-status").html(response.text);
                    },
                    error: function() {}
                });
            }));
        });

    </script>
    <style>
        input,
        textarea {
            width: 100%;
            padding: 15px;
            font-size: 1em;
            border: 1px solid #A1A1A1;
        }

        button {
            border: none;
            color: rgb(255, 255, 255);
            font-family: "RobotoHeavy";
            letter-spacing: 0.6px;
            font-size: 1.1rem;
            cursor: pointer;
        }


        #mail-status {
            padding: 12px 20px;
            width: 100%;
            display: none;
            font-size: 1rem;
            font-family: "RobotoBook";
            color: rgb(40, 40, 40);
        }

        .error {
            background-color: #ffb6b3;
        }

        .success {
            background-color: #67b0ff;
        }

        .sh_btn {
            background-color: #007bff!important;
            border-radius: 3px!important;
        }

        .sh_btn_top .sh_title_text,
        .sh_btn_bottom .sh_title_text {
            border: none!important;
        }

        .sh_header {
            background-color: #007bff!important;
        }

        .sh_chat {
            border: none!important;
        }

    </style>
    <script>
  dataLayer = [];
</script>


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PS2B68K');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PS2B68K"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div id="message">
            <form id="frmContact" action="" method="POST" novalidate="novalidate">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title display-4-heavy mx-auto" id="exampleModalLabel">Заполните форму</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" id="name" name="name" required pattern="^[A-Za-zА-Яа-яЁёІіЇїЄє\s]+$" class="form-control" placeholder="* Введите имя" data-bv-field="Name" required>
                            </div>
                            <div class="input-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="* Введите email" data-bv-field="Email" required>
                            </div>
                            <div class="input-group">
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="* Введите телефон" required>
                            </div>
                            <div class="input-group">
                                <textarea id="Message" name="content" class="form-control" rows="5" data-bv-field="Message" placeholder="* Напишите коротко о себя или приложите ссылку на ваше резюме."></textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY; ?>"></div>
                            <div id="mail-status"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="Submit" class="btn-new btn btn-primary btn-lg btn-white mx-auto display-4-heavy" value="Submit" id="send-message" style="clear:both;">Отправить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <section id="home">
        <div class="wrapper slide1">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white header-text">
                        <p><img src="img/webisoft.png" alt=""></p>
                        <h1 class="display-3-big">Хочешь работать в команде професcионалов?</h1>
                        <h2 class="display-3-heavy">Мы ищем талантливых менеджеров по продажам</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="slide2">
        <div class="container-fluid">
            <div class="row flex-md-row flex-column-reverse who-are-we">
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto">
                            <h2 class="display-3-big">Кто мы?</h2>
                            <p class="display-4-book">
                                <span class="display-4-heavy">Вебисофт </span> - компания профессионалов с многолетним опытом в сфере IT-технологоий, инвестирования и инфо-бизнеса.
                            </p>
                            <p class="display-4-heavy">Наша компания ищет молодых и амбициозных сотрудников. </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 image">

                </div>
            </div>
            <div class="row what-do-you-stud">
                <div class="col-12 col-md-6 image ">
                </div>
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto ">
                            <h2 class="display-3-big">Чему вы научитесь</h2>
                            <p class="display-4-book">
                                В нашей компании Вы получите отличную школу продаж, возможность почувствовать себя финансово независимым.<br><br>Компания также дает много возможностей для личностного и карьерного роста.<br><br>Сплочённый коллектив, работа в интенсивном режиме и результат, который Вы увидите с первого месяца работы.
                            </p>
                            <p class="display-4-heavy">Мы собираем талантливую команду для реализации идей компании.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-md-row flex-column-reverse who-we-find">
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto ">
                            <h2 class="display-3-big">Кого мы ищем</h2>
                            <p class="display-4-book">
                                Для данной вакансии мы ищем энергичного, амбициозного, позитивного сотрудника, который хочет работать в режиме непрерывного профессионального роста и добиться желаемого результата.
                            </p>
                            <p class="display-4-book">Если Вы любите достигать целей, готовы к вызовам у Вас есть желание найти стабильную работу, которая позволит стать финансово независимым, реализовать себя и построить желаемую карьеру – тебе к нам!</p>
                            <p class="display-4-heavy">Если у Вас небольшой опыт в продажах, но Вы уверенны в своих силах и готовы добиться большего успеха – мы готовы рассмотреть Вашу кандидатуру! </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 image">
                </div>
            </div>
            <div class="row our-wish">
                <div class="col-12 col-md-6 image">
                    <div class="podlozka-image">

                    </div>
                </div>
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto ">
                            <h2 class="display-3-big">Наши пожелания к кандидатам</h2>
                            <ul class="display-4-book">
                                <li>желание обучаться и развиваться в направлении продаж</li>
                                <li>активная жизненная позиция</li>
                                <li>желание стать профессионалом в своем деле и добиться финансового успеха</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-md-row flex-column-reverse what-do-you-do">
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto ">
                            <h2 class="display-3-big">Чем нужно будет заниматься</h2>
                            <ul class="display-4-book">
                                <li>вести переговоры с потенциальными и действующими клиентами в телефонном режиме по всему миру</li>
                                <li>обрабатывать все входящие заявки</li>
                                <li>вести клиентскую базу в CRM-системе</li>
                                <li>выполнять план продаж</li>
                                <li>обучаться и улучшать себя каждый день</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 image">
                </div>
            </div>
            <div class="row prof">
                <div class="col-12 col-md-6 image">
                    <div class="podlozka-image">

                    </div>
                </div>
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto ">
                            <h2 class="display-3-big">Профессиональные качества</h2>
                            <ul class="display-4-book">
                                <li>у вас грамотная речь и вы легко находите общий язык</li>
                                <li>для вас не составит труда взять трубку и закрыть сделку по телефону, вы не боитесь отказов и возражений</li>
                                <li>вашей концентрации с лихвой хватает, для того, чтобы переключаться между несколькими сделками, которые у вас на контроле в данный момент</li>
                                <li>вы умеете планировать свое время</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-md-row flex-column-reverse what-we-offer">
                <div class="col-12 col-md-6 text">
                    <div class="row h-100">
                        <div class="col-12 col-md-8 offset-md-2 my-auto ">
                            <h2 class="display-3-big">Что мы предлагаем</h2>
                            <ul class="display-4-book">
                                <li>работу в комфортном офисе с теплой клиентской базой, которую мы предоставляем</li>
                                <li>достойную систему вознаграждения. Сумма заработанных денег зависит исключительно от Ваших результатов, «потолка» нет</li>
                                <li>профессиональную адаптацию и обучение</li>
                                <li>работа в офисе г.Киев (менее 5 минут от линии скоростного трамвая, остановок общественного транспорта и остановки городской электрички, ул. Семьи Сосниных, бесплатная парковка на территории)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 image">
                </div>
            </div>
        </div>
    </section>
    <section id="slide3">
        <div class="wrapper slide3">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h2 class="display-3-small pt-3 pb-3">Если Вы готовы много учиться и познавать для себя новые грани данной сферы, тогда мы ждем Вас! </h2>
                        <button type="button" class="display-3-small btn-new btn btn-primary mb-4" data-toggle="modal" data-target="#myModal">
  Хочу работать с вами
</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        (function() {
            var widget_id = 708416;
            _shcp = [{
                widget_id: widget_id
            }];
            var lang = (navigator.language || navigator.systemLanguage ||
                    navigator.userLanguage || "en")
                .substr(0, 2).toLowerCase();
            var url = "widget.siteheart.com/widget/sh/" + widget_id + "/" + lang + "/widget.js";
            var hcc = document.createElement("script");
            hcc.type = "text/javascript";
            hcc.async = true;
            hcc.src = ("https:" == document.location.protocol ? "https" : "http") +
                "://" + url;
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hcc, s.nextSibling);
        })();

    </script>
</body>

</html>
