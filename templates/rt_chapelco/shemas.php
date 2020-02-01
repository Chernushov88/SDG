<?php
  $app = JFactory::getApplication();
  $menu = $app->getMenu()->getActive()->id;
   // echo $menu.'<br>';
  ?>
<?php if($menu == '101') { ?>
<!-- page main-->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
  	"@type": "Question",
  	"name": "☑️Что такое трейдинг?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Трейдинг - это процесс совершения торговых операций на специально отведенных площадках (биржах), в котором товарами выступают ценные бумаги (акции, облигации, фьючерсы, опционы) или валюты. В таком случае заработок трейдера - это разница цены покупки и цены продажи того или иного инструмента."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Что такое дейтрейдинг?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Дейтрейдинг - это стиль торговли, при котором трейдер открывает и закрывает сделки в течении одной торговой сессии."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️На каких биржах можно торговать?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "В мире существует около 200 фондовых бирж. Самыми известными и капитализированными являются американские биржи: NYSE, NASDAQ и AMEX."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Какой график работы у американских фондовых бирж?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Торговая сессия на фондовых биржах Америки начинается в 9:30 и заканчивается в 16:00 по Нью-Йорку."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Как получить доступ к бирже?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text":"Для торговли на биржах необходимо открыть счет у лицензированного американского брокера, выбрать программное обеспечение и внести средства на депозит."}
  	}, {
  	"@type": "Question",
  	"name": "☑️Как открыть счет у брокера?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Чтобы открыть счет для торговли, необходимо обратиться к компании, которая сотрудничает с лицензированными брокерами и помогает получить прямой доступ на американские фондовые биржи."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Как заработать на бирже?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Для того, чтобы заработать на бирже, необходимо иметь глубокие знания по техническому и/или фундаментальному анализу (в случае с инвестированием или swing-trading), риск-менеджменту и рабочие стратегии торговли. В идеале - работать в proprietary-компании, где есть возможность общения с другими успешными трейдерами."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Сколько зарабатывают трейдеры?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Трейдинг - это вид деятельности, который не имеет ограничений по заработку. Результат зависит от множества факторов: навыков, квалификации трейдера, величины депозита и др. Доход профессионального трейдера, в среднем за 1 месяц составляет 4-х и 5-ти значные суммы. Однако, если заниматься торговлей без должной подготовки, то риски потери депозита значительно повышаются."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Что такое проп-трейдинг (proprietary-трейдинг)?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Proprietary-трейдинг - это торговля на средства компании-инвестора (а не собственные) на условиях распределения прибыли. Prop-трейдинг часто подразумевает предоставление инфраструктуры от компании-инвестора: оборудованный офис, выгодная комиссия, бесплатный торговый терминал и др."
  	}
  }]
  }
</script>
<?php /*} else if($menu == '198') { ?>
<!-- page besplatnoye obucheniye -->
<script type="application/ld+json">
  {
  	"@context": "https://schema.org",
  	"@type": "FAQPage",
  	"mainEntity": [{
  		"@type": "Question",
  		"name": "☑️Как начать бесплатно обучаться торговле акциями?",
  		"acceptedAnswer": {
  		"@type": "Answer",
  		"text": "Если вас интересует бесплатное обучение торговле на бирже, то мы предлагаем множество материалов, которые помогут изучить основы трейдинга.В нашем блоге представлено множество полезных статей по трейдингу на NYSE, NASDAQ и AMEX, которые написаны исходя из опыта торговли <a href='market/stati/ponyatie-prop-trejding-ili-kak-torgovat-na-kapital-kompanii'>проп-трейдеров</a> нашей компании
  		Чтобы расширить знания в трейдинге на фондовом рынке, вы можете изучить соответствующую биржевую литературу. По рекомендациям профессионального трейдера нашей команды, мы составили <a href='market/stati/luchshie-knigi-po-trejdingu-dlya-nachinayushchikh'>ТОП-26 книг по торговле на бирже</a> которые помогут составить общее представление о торговле акциями и получить дополнительную мотивацию.
  		Чтобы понимать термины и определения, которые необходимы для торговли на американских фондовых биржах, изучите статьи из раздела <a href='market/terminologiya'>“Терминология”</a>"
  		}
  	}, {
  		"@type": "Question",
  		"name": "☑️Где найти бесплатные видеоуроки по трейдингу?",
  		"acceptedAnswer": {
  		"@type": "Answer",
  		"text": "Чтобы получить необходимые знания и убедиться в экспертности наших трейдеров, посетите наш <a href='https://www.youtube.com/c/sdgtrade'>youtube-канал</a> на котором мы регулярно размещаем полезные видеоуроки по трейдингу. Для тех, кто хочет обучаться трейдингу с нуля, компания SDG Trade регулярно проводит бесплатные вебинары по трейдингу и прямые трансляции.
  		Обучайтесь трейдингу вместе с профессиональными трейдерами команды SDG Trade!"
  		}
  	}, {
  		"@type": "Question",
  		"name": "☑️Можно ли обучиться трейдингу бесплатно?",
  		"acceptedAnswer": {
  		"@type": "Answer",
  		"text": "Существует множество бесплатных курсов по трейдингу, но знание теории не приближает к заработку на биржах — необходима ежедневная практика и корректировки трейдеров, которые уже стабильно зарабатывают. Бесплатно можно научиться азам, открыть счет и какое-то время побыть в рынке. Торговля на бирже является высококонкурентным, высокодоходным бизнесом и стратегиями заработка никто не делится в открытом доступе. Бесплатный материал предоставляется с целью введения новичка в тематику данной сферы или же демонстрация своей компетентности. Не более."
  		}
  	}]
  }
</script>
<?php } else if($menu == '181') { ?>
<!-- page otkryt shchet -->
<script type="application/ld+json">
  {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
  	"@type": "Question",
  	"name": "☑️Что такое торговый счет и для чего он нужен?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Компания SDG Trade более 10 лет предоставляет прямой выход на американские фондовые биржи <a href='market/nyse-exchange'>NYSE</a>, <a href='market/nasdaq-exchange'>NASDAQ</a>, <a href='market/amex'>AMEX</a> и помогает открывать счета у лицензированных брокеров.
  	Если вы хотите зарабатывать на торговле акциями, то нужно открыть счет, определиться с торговой платформой и графиками, а также получить знания, необходимые для трейдинга на фондовых биржах."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Как открыть торговый счет?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Для того, чтобы открыть счет, необходимо оставить заявку, определиться с торговой платформой (<a href='programmnoe-obespechenie/torgovaya-platforma-rox'>ROX</a>, <a href='programmnoe-obespechenie/torgovaya-platforma-takion'>Takion</a> или <a href='programmnoe-obespechenie/torgovaya-platforma-fusion'>Fusion</a>), заполнить договор и внести депозит. Для каждого клиента предусмотрено сопровождение и консультация персонального менеджера.
  	Преимущества открытия торгового счета у лицензированного брокера:
  	<ul>
  	<li>- сопровождение клиентов и помощь в открытии счета;</li>
  	<li>- лицензированное программное обеспечение и гарантия технической надежности платформ;</li>
  	<li>- прямой вывод сделок на рынок;</li>
  	<li>- выгодные торговые условия и кредитное плечо;</li>
  	<li>- выбор из нескольких лицензированных торговых терминалов под разный профессиональный уровень;</li>
  	<li>- помощь в обслуживании торговой платформы.</li>
  	</ul>"
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Чем торговый счет отличается от демо?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Торговый счет позволяет получить доступ на американские фондовые биржи и совершать сделки в реальном времени. Демо-счет предназначен для изучения интерфейса платформы и ознакомления с функционалом. Для торговли демонстрационный счет не подходит, так как в данном режиме отсутствует симуляция очереди при исполнении заказа, а также психологический фактор, который является важнейшей особенностью торговли на реальном счете."
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Сколько времени занимает открытие торгового счета?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Открытие счета, как правило, занимает 3 рабочих дня с момента поступления денег на банковский счет компании, при наличии заключенного Клиентского Соглашения."
  	}
  }]
  }>
</script>
<?php */} else if($menu == '114') { ?>
<!-- page obucheniye -->
<script type="application/ld+json">
  {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
  	"@type": "Question",
  	"name": "☑️Как начать бесплатно обучаться торговле акциями?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Если вас интересует бесплатное обучение торговле на бирже, то мы предлагаем множество материалов, которые помогут изучить основы трейдинга.В нашем блоге представлено множество полезных статей по трейдингу на NYSE, NASDAQ и AMEX, которые написаны исходя из опыта торговли проп-трейдеров нашей компании
  	Чтобы расширить знания в трейдинге на фондовом рынке, вы можете изучить соответствующую биржевую литературу. По рекомендациям профессионального трейдера нашей команды, мы составили ТОП-26 книг по торговле на бирже которые помогут составить общее представление о торговле акциями и получить дополнительную мотивацию.
  	Чтобы понимать термины и определения, которые необходимы для торговли на американских фондовых биржах, изучите статьи из раздела “Терминология”"
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Где найти бесплатные видеоуроки по трейдингу?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Чтобы получить необходимые знания и убедиться в экспертности наших трейдеров, посетите наш youtube-канал на котором мы регулярно размещаем полезные видеоуроки по трейдингу. Для тех, кто хочет обучаться трейдингу с нуля, компания SDG Trade регулярно проводит бесплатные вебинары по трейдингу и прямые трансляции.
  	Обучайтесь трейдингу вместе с профессиональными трейдерами команды SDG Trade!"
  	}
  }, {
  	"@type": "Question",
  	"name": "☑️Можно ли обучиться трейдингу бесплатно?",
  	"acceptedAnswer": {
  	"@type": "Answer",
  	"text": "Существует множество бесплатных курсов по трейдингу, но знание теории не приближает к заработку на биржах — необходима ежедневная практика и корректировки трейдеров, которые уже стабильно зарабатывают. Бесплатно можно научиться азам, открыть счет и какое-то время побыть в рынке. Торговля на бирже является высококонкурентным, высокодоходным бизнесом и стратегиями заработка никто не делится в открытом доступе. Бесплатный материал предоставляется с целью введения новичка в тематику данной сферы или же демонстрация своей компетентности. Не более."
  	}
  }]
  }
    
</script>
<?php } else if($menu == '139' || $menu == '289' || $menu == '167' || $menu == '178' || $menu == '179' || $menu == '141') { 
  $categoryId=JRequest::getInt('id');
  // echo $categoryId;
  if ($categoryId == 26  || $categoryId == 22 || $categoryId == 23 || $categoryId == 24 || $categoryId == 37) {
    
  }
  else{
      $params = JFactory::getApplication()->getParams();
      // echo $params->get('page_heading', '');
      // echo $params->get('page_title', '');
      
      $app = JFactory::getApplication();
      $menuId =  $app->getMenu()->getActive()->id;
      
      
      // echo $categoryId.'<br>';

      // $dataAtr =  $app->getMenu()->getActive()->publish_up;
      // echo = $dataAtr;
      $db = JFactory::getDbo(); 
      
      $query = $db->getQuery(true)->select(
        $db->quoteName(
        array('id', 'publish_up')
        )
      )->from($db->quoteName('m4vzc_content'))
      ->where($db->quoteName('id'). ' = ' . (int) $categoryId);
      $db->setQuery($query);
      $articles = $db->loadObjectList();
      $arrsy = (array) $articles;
      // echo $arrsy[0]->publish_up;
      
      $queryModified = $db->getQuery(true)->select(
        $db->quoteName(
        array('id', 'modified')
        )
      )->from($db->quoteName('m4vzc_content'))
      ->where($db->quoteName('id'). ' = ' . (int) $categoryId);
      $db->setQuery($queryModified);
      $artModified = $db->loadObjectList();
      $arrayModified = (array) $artModified;
       
      
      $queryImg = $db->getQuery(true)->select(
        $db->quoteName(
        array('id', 'fulltext','images','introtext')
        )
      )->from($db->quoteName('m4vzc_content'))
      ->where($db->quoteName('id'). ' = ' . (int) $categoryId);
      // print_r($queryImg);
      $db->setQuery($queryImg);
      $Images = $db->loadObjectList();
      $ima= $Images[0]->images;
      $arrImg10 = (array)$ima;
    if (!empty($arrImg10)) {
      $arrImg100 = (array)$arrImg10[0];
      $js=json_decode($arrImg100[0]);      
      if (strlen($js->image_fulltext)>2){
        $urlImg = $js->image_fulltext;  
      }else{    
        $fullTEXT = $Images[0]->fulltext;
        $arrImg0 = (array)$fullTEXT ;
        preg_match_all("/\s*src\s*=\s*[\"\']{0,1}([^\s\"\']+)[\"\'\s]+/ims",$arrImg0[0],$aResult5);
        $imga=array();
        if (!empty($aResult5[1])) {
          foreach ($aResult5[1] as $prob) {
            $str = $prob;
            $substr = "image";
            if (strstr($str, $substr)) {
              $imga[]=$prob;
            }   
          }
          if (!empty($imga)) {
           $urlImg =$imga[0]; 
          }     
        } 
      }
    }else{
      $fullTEXT = $Images[0]->fulltext;
      $arrImg0 = (array)$fullTEXT ;
      preg_match_all("/\s*src\s*=\s*[\"\']{0,1}([^\s\"\']+)[\"\'\s]+/ims",$arrImg0[0],$aResult5);    
      $imga=array();
      if (!empty($aResult5[1])) {
        foreach ($aResult5[1] as $prob) {
          $str = $prob;
          $substr = "image";
          if (strstr($str, $substr)) {
            $imga[]=$prob;
          }   
        }
        if (!empty($imga)) {
          $urlImg =$imga[0];  
        }    
      }   
    }?>
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
          "@type": "WebPage",
          "@id": "<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>"
        },
        "headline": "<?= $params->get('page_heading', '');?>",
        "image": [
          "<?='https://' . $_SERVER['HTTP_HOST'] .'/'.$urlImg;?>"
         ],
        "datePublished": "<?=$arrsy[0]->publish_up; ?>",
        "dateModified": "<?=$arrayModified[0]->modified; ?>",
        "author": {
          "@type": "Person",
          "name": "Super User"
        },
         "publisher": {
          "@type": "Organization",
          "name": "Google",
          "logo": {
            "@type": "ImageObject",
            "url": "https://sdg-trade.com/images/banners/logo.png"
          }
        },
        "description": "<?=$params->get('page_description', '');?>"
      }
        
    </script><?
  }
    
  // echo $urlImg;
  
  ?>

<?php }  ?>