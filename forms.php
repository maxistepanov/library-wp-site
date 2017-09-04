<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="booklist.php" method="post" name="form_main">
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750">

<!--td bgcolor='#FCFCCC' valign='top'--><tbody><tr>  
<td valign="top"><br>

<!-- ******************** USH/Library BODY *************************** -->

<input name="mode" type="hidden" value="BookList">
<input name="ext" type="hidden" value="no">
<input name="lang" type="hidden" value="ukr">
<input name="theme_path" type="hidden" value="0">

<table width="100%" border="0"><tbody><tr>
<td>&nbsp;
<input style="font-size:9pt" type="submit" value="Вибрати" onclick="form_main.mode.value=&quot;BookList&quot;;">&nbsp;
<input style="font-size:9pt" type="reset" value="Очистити"><br>

</td>
<td align="right"><a href="booklist.php" onclick="form_main.mode.value=&quot;SearchHelp&quot;;form_main.submit();return false">Допомога</a></td>
</tr></tbody></table>
<table border="0"><tbody><tr>

<!-- ************************************
Query fields 
************************************ -->

<td valign="top">
<table border="0">
<tbody><tr valign="top">
	<td>Автор</td>
	<td width="250"><input name="author_fld" size="35" maxlength="250" style="font-size:9pt" value=""></td>
</tr>
<tr valign="top">
	<td>Назва документа<br>
	&nbsp;&nbsp;&nbsp;&nbsp;<select name="docname_cond" size="1" style="font-size:9pt">
		<option value="containtext">Містить текст</option>
		<option value="containword" selected="">Містить слова</option>
		<option value="start">Починається з</option>
	</select></td>
	<td width="250"><input name="docname_fld" size="35" maxlength="250" style="font-size:9pt" value=""></td>
</tr>
<tr valign="top">
	<td>Рік видання</td>
	<td valign="center">
	<input name="year_fld1" size="5" maxlength="5" style="font-size:9pt" value="">&nbsp;--&nbsp;
	<input name="year_fld2" size="5" maxlength="5" style="font-size:9pt" value=""></td>
</tr>
<tr valign="top">
	<td>Мова</td>
	<td colspan="2">
	<select name="lang_list" size="5" style="font-size:9pt">
		<option value="0" selected="">Без обмежень</option>
		<option value="100">Англійська</option>
		<option value="15">Арабська</option>
		<option value="53">Болгарська</option>
		<option value="401">Декілька мов</option>
		<option value="330">Іспанська</option>
		<option value="67">Китайська</option>
		<option value="128">Німецька</option>
		<option value="285">Польська</option>
		<option value="287">Португальська</option>
		<option value="300">Російська</option>
		<option value="369">Турецька</option>
		<option value="375">Українська</option>
		<option value="115">Французька</option>
		<option value="402">Хорватська</option>
	</select>
	</td>
</tr>
<tr valign="top">
	<td>Вид документа</td>
	<td colspan="2">
	<select name="doctype_list" size="5" style="font-size:9pt">
		<option value="0" selected="">Без обмежень</option>
		<option value="1">Книга</option>
		<option value="25">Електронні видання (книги)</option>
		<option value="24">Електронні видання (методичні)</option>
		<option value="23">Ілюстративні видання</option>
		<option value="17">Метод.вказівки</option>
		<option value="21">Матеріали конференції (з'їзду, симпозіуму)</option>
		<option value="22">Непаперовий документ</option>
		<option value="18">Дисертації</option>
		<option value="12">Журнал</option>
		<option value="13">Номер журналу</option>
		<option value="14">Газета</option>
		<option value="15">Номер газети</option>
		<option value="16">Стаття періодики</option>
		<option value="19">Автореферати</option>
		<option value="20">Стандарт</option>
		<option value="11">Періодичне видання</option>
		<option value="6">Серіальне видання</option>
		<option value="8">Складова частина документа</option>
	</select>
	</td>
</tr>
<tr valign="top">
	<td>Електронна копія</td>
	<td><input name="el_copy" type="CHECKBOX"></td>
</tr>
</tbody></table>
</td>

<!-- ************************************
Theme search 
************************************ -->

<td valign="top">

<p><font size="-1">Пошук теми</font><br>
<input name="theme_context" size="30" maxlength="100" style="font-size:9pt">
<input type="submit" value="Шукати" style="font-size:9pt" onclick="form_main.mode.value=&quot;SearchThemeForm&quot;;">
</p>

<table border="0" style="font-size:9pt">
<tbody><tr><td colspan="2"><font size="+1"><b>Класифікатори</b></font></td></tr>
<tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,27187&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Бібліотека Європейського Союзу</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,26904&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Бібліотека Світового банку</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,28820&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Надходження 2014 р.</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,28999&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Надходження 2015р.</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,29285&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Надходження 2016р.</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,29521&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Нові надходження 2017</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,19190&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Праці вчених ХНЕУ</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,11573&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Рубрикатор</a></td></tr><tr><td width="15">&nbsp;</td><td><a href="booklist.php" onclick="form_main.theme_path.value=&quot;0,27776&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Фонд рідкісної та цінної книги</a></td></tr></tbody></table>
<input type="hidden" name="theme_cond" value="all_theme">

		<input type="hidden" name="theme_id" value="0"></td>

</tr></tbody></table>
<table width="640">
<tbody><tr valign="top">
	<td colspan="3"><font size="+1">Навчальні дисципліни</font><br>
	<select name="discipline" size="8" style="font-size:9pt">
		<option value="0" selected="">Без обмежень</option>
		<option value="2478">3D- графіка</option>
		<option value="2274">Managerial Economics</option>
		<option value="596">Publik Relations</option>
		<option value="2503">WEB- дизайн</option>
		<option value="1732">Автоматизація документообігу</option>
		<option value="2032">Авторське право, інтелектуальна власність та патентознавство</option>
		<option value="829">Адміністративний менеджмент</option>
		<option value="573">Адміністрування податків</option>
		<option value="2076">Актуальні проблеми моделювання економіки</option>
		<option value="2276">Алгоритми та структури даних</option>
		<option value="2345">Альтернативні системи оподаткування</option>
		<option value="927">Аналіз банківської діяльності</option>
		<option value="2391">Аналіз безпеки ЗЕД</option>
		<option value="1893">Аналіз в галузях</option>
		<option value="782">Аналіз господарської діяльності</option>
		<option value="1526">Аналіз діяльності підприємств в туристичної галузі</option>
		<option value="2510">Аналіз ресурсного потенціалу підприємства</option>
		<option value="1913">Аналіз ринків</option>
		<option value="2295">Аналіз та оптимізація бізнес-процесів підприємств</option>
		<option value="1984">Аналіз та прогнозування рядів динаміки</option>
		<option value="2257">Аналіз у галузях народного господарства</option>
		<option value="2293">Аналітика великих даних</option>
		<option value="2515">Аналітичне забезпечення управління бізнесом</option>
		<option value="1595">Антикризова діяльність підприємства</option>
		<option value="2335">Антикризова податкова політика</option>
		<option value="2340">Антикризова фінансова діагностика</option>
		<option value="1152">Антикризовий менджмент</option>
		<option value="2301">Архітектура мультимедійного комплексу</option>
		<option value="265">Аудит</option>
		<option value="2540">Аудит державних фінансів</option>
		<option value="2401">Аудит і оцінювання управлінської діяльності</option>
		<option value="2239">Аудит персоналу</option>
		<option value="2406">Багатомірний аналіз даних</option>
		<option value="1935">Бази даних</option>
		<option value="1577">Банківська система</option>
		<option value="1955">Банківське право</option>
		<option value="2113">Банківське регулювання та нагляд</option>
		<option value="403">Банківські операції</option>
		<option value="2103">Безпека банківського бізнесу</option>
		<option value="2385">Безпека в системі корпоративного управління</option>
		<option value="237">Безпека життєдіяльності</option>
		<option value="1915">Бізнес - діагностика</option>
		<option value="2265">Бізнес - планування</option>
		<option value="985">Бренд - менеджмент</option>
		<option value="250">Бухгалтерський облік</option>
		<option value="2121">Бухгалтерський облік в управлінні підприємством</option>
		<option value="855">Бюджетна система</option>
		<option value="2545">Бюджетування у банках</option>
		<option value="1830">Веб- технології та веб-дизайн</option>
		<option value="2547">Венчурне підприємництво</option>
		<option value="2441">Венчурне підприємництво і трансфер технологій</option>
		<option value="904">Видавнича справа і технічне редагування</option>
		<option value="903">Видавничо-поліграфічні матеріали</option>
		<option value="594">Виробничий менеджмент</option>
		<option value="304">Вища математика</option>
		<option value="1532">Вища та прикладна математика</option>
		<option value="2275">Віртуальний фінансовий відділ</option>
		<option value="1481">Вступ до комп`ютерних наук</option>
		<option value="2393">Вступ до медіа-комунікацій</option>
		<option value="1871">Вступ до публічного адміністрування</option>
		<option value="2216">Вступ до фаху</option>
		<option value="1701">Географія туризму</option>
		<option value="1486">Геоінформаційні системи</option>
		<option value="2294">Геометричні фрактали в комп'ютерній графіці</option>
		<option value="2219">Геополітика</option>
		<option value="1300">Глобальна економіка</option>
		<option value="459">Господарське право</option>
		<option value="260">Гроші та кредит</option>
		<option value="2235">Датамайнінг- інтелектуальний аналіз даних</option>
		<option value="1798">Демографічна статистика</option>
		<option value="2144">Демографія</option>
		<option value="2552">Державна служба</option>
		<option value="253">Державне регулювання економіки</option>
		<option value="1880">Державне регулювання економіки та економічна політика</option>
		<option value="1511">Державне та регіональне управління</option>
		<option value="1310">Державне управління туристичною діяльністю</option>
		<option value="2350">Державний аудит</option>
		<option value="2410">Дидактичні системи та педагогічні техн-ії у вищій школі</option>
		<option value="2378">Дизайн поліграфічної продукції та візуалізація даних</option>
		<option value="2522">Дискретна математика</option>
		<option value="2351">Діагностика стану підприємства</option>
		<option value="242">Ділова іноземна мова</option>
		<option value="2264">Ділова іноземна мова (німецька)</option>
		<option value="1738">Ділова іноземна мова (російська)</option>
		<option value="919">Ділове спілкування</option>
		<option value="900">Додрукарське опрацювання інформації</option>
		<option value="2202">Дослідження операцій</option>
		<option value="2501">Дослідження операцій та методи оптимізації</option>
		<option value="1663">Дослідження поведінки споживачів</option>
		<option value="2496">Дослідницькі техніки та підходи</option>
		<option value="1095">Друга ділова іноземна мова</option>
		<option value="2008">Друга іноземна мова</option>
		<option value="2477">Екоінформатика</option>
		<option value="2022">Екологічна безпека та екологічні ризики</option>
		<option value="1734">Екологічна хімія</option>
		<option value="2475">Екологічний менеджмент</option>
		<option value="2039">Екологічний менеджмент у публічному адмініструванні</option>
		<option value="2049">Економетрика</option>
		<option value="2062">Економетрика і моделювання економічної динаміки</option>
		<option value="244">Економетрія</option>
		<option value="950">Економіка видавництв і поліграфічних підприємств</option>
		<option value="2229">Економіка галузевих ринків</option>
		<option value="2303">Економіка глобальних проблем людства</option>
		<option value="1499">Економіка знань та інновац. інфраструктура: Економіка знань</option>
		<option value="2260">Економіка знань та інновац. інфраструктура: Інноваційна інфрастр-ра
	
</option>
		<option value="1783">Економіка і організація інноваційної діяльності</option>
		<option value="2127">Економіка і оцінка нерухомості</option>
		<option value="1627">Економіка і фінанси підприємства</option>
		<option value="2442">Економіка інноваційного підприємництва</option>
		<option value="1646">Економіка машинобудівної галузі</option>
		<option value="246">Економіка підприємств</option>
		<option value="251">Економіка праці і соціально-трудові відносини</option>
		<option value="2525">Економіка рекреації та туризму</option>
		<option value="1723">Економіка та бізнес</option>
		<option value="2290">Економіка та ціноутворення у галузі туризму</option>
		<option value="2544">Економіка України</option>
		<option value="2359">Економіко-математичне моделюв. фінансового стану підпр-ва</option>
		<option value="785">Економіко-математичне моделювання</option>
		<option value="2529">Економіко-математичні методи</option>
		<option value="2542">Економіко-математичні методи в оцінці майна</option>
		<option value="1954">Економіко-математичні методи та моделі: Оптимізаційні методи та моделі</option>
		<option value="1350">Економічна безпека</option>
		<option value="1535">Економічна динаміка</option>
		<option value="2435">Економічна інтеграція та глобальні проблеми сучасності</option>
		<option value="1930">Економічна інформатика</option>
		<option value="349">Економічна історія</option>
		<option value="255">Економічна кібернетика</option>
		<option value="1953">Економічна компаративістика</option>
		<option value="2141">Економічна нормативна база підприємства</option>
		<option value="2436">Економічна політика сталого розвитку</option>
		<option value="256">Економічна статистика</option>
		<option value="812">Економічна теорія</option>
		<option value="2231">Економічне оцінювання</option>
		<option value="1081">Економічне управління підприємством</option>
		<option value="264">Економічний аналіз</option>
		<option value="1586">Економічний консалтинг</option>
		<option value="1548">Економічний розвиток</option>
		<option value="1828">Екскурсологія</option>
		<option value="2352">Експертне дослідження економічних правопорушень та злочинів</option>
		<option value="2160">Електронна комерція</option>
		<option value="2553">Електронне врядування</option>
		<option value="2505">Електронний документообіг</option>
		<option value="2266">Електронний маркетинг</option>
		<option value="952">Електронний маркетинг у поліграфічній промисловості</option>
		<option value="1847">Електронні засоби та техн. в освіті та науковій діяльності</option>
		<option value="506">Електротехніка і електроніка</option>
		<option value="1489">Етика бізнесу</option>
		<option value="2289">Етнологія</option>
		<option value="1437">Ефективність соціально-трудових процесів</option>
		<option value="2493">Загальна та соціальна психологія</option>
		<option value="1936">Загальне управління: принципи та процеси</option>
		<option value="2192">Засоби обробки графічних та текстових даних</option>
		<option value="2353">Захист інтелектуальної власності</option>
		<option value="2482">Захист інформації</option>
		<option value="2379">Захист прав інтелектуальної власності в управ. проектами</option>
		<option value="491">Звітність підприємств</option>
		<option value="288">Зовнішньоекономічна діяльність підприємств</option>
		<option value="1682">Ілюстрування</option>
		<option value="2497">Іміджологія</option>
		<option value="356">Імітаційне моделювання</option>
		<option value="2249">Інвестиційне кредитування</option>
		<option value="2250">Інвестиційний аналіз та інвестиційне кредитування</option>
		<option value="263">Інвестування</option>
		<option value="1533">Індустріальна та аграрна економіка</option>
		<option value="515">Інженерна і комп'ютерна графіка</option>
		<option value="2371">Інженерна педагогіка та навчання на робочому місці</option>
		<option value="2443">Інноваційне бізнес-моделювання</option>
		<option value="2444">Інноваційний інжиніринг</option>
		<option value="473">Інноваційний менеджмент</option>
		<option value="1664">Інноваційний розвиток підприємства</option>
		<option value="2453">Інноваційні маркетингові комунікації в освіті</option>
		<option value="1495">Інноваційні технології в логістиці</option>
		<option value="1720">Інноваційні технології в туризмі</option>
		<option value="2000">Інноваційно-інвестиц. механізм розвитку ЗЕД підприємства</option>
		<option value="224">Іноземна мова</option>
		<option value="2521">Іноземна мова (друга) (за професійним спрямуванням)</option>
		<option value="2543">Іноземна мова (російська)</option>
		<option value="1208">Іноземна мова ділового спілкування</option>
		<option value="2296">Іноземна мова для ІТ- галузі</option>
		<option value="1983">Іноземна мова за проф. спрямуванням (французька)</option>
		<option value="1107">Іноземна мова за професійним спрямуванням</option>
		<option value="1905">Іноземна мова за професійним спрямуванням (німецька)</option>
		<option value="2491">Іноземна мова спеціальності</option>
		<option value="2364">Інституційне регулювання експортної діяльності</option>
		<option value="544">Інституціональна економіка</option>
		<option value="791">Інтелектуальна власність</option>
		<option value="2425">Інтелектуальна власність та патентознавство</option>
		<option value="2459">Інтелектуальна власність та трансфер технологій</option>
		<option value="2010">Інтелектуальний аналіз даних</option>
		<option value="2323">Інтелектуальний капітал</option>
		<option value="2465">Інтелектуальні ІУС і технології їх розробки</option>
		<option value="2434">Інтелектуальні методи прогноз. соц.-економ. процесів</option>
		<option value="2466">Інтелектуальні методи та засоби обробки інформації</option>
		<option value="2336">Інтелектуальні системи обробки фінансової інформації</option>
		<option value="2302">Інтерактивні медіа та мультимедійний дизайн</option>
		<option value="2310">Інтернет- маркетингові технології в міжнародному бізнесі</option>
		<option value="2334">Інтернет - маркетинг</option>
		<option value="2500">Інтернет технології в сучасному бізнесі</option>
		<option value="1024">Інформатика</option>
		<option value="2424">Інформатика і комп'ютерна техніка</option>
		<option value="2467">Інформаційна безпека</option>
		<option value="2070">Інформаційний бізнес</option>
		<option value="1605">Інформаційний менеджмент</option>
		<option value="2508">Інформаційні системи в банках</option>
		<option value="1693">Інформаційні системи в бізнесі</option>
		<option value="527">Інформаційні системи в економіці</option>
		<option value="2240">Інформаційні системи в управлінні персоналом</option>
		<option value="1970">Інформаційні системи і технології в маркетингу</option>
		<option value="1957">Інформаційні системи і технології в обліку і аудиті</option>
		<option value="1289">Інформаційні системи і технології в туризмі</option>
		<option value="1568">Інформаційні системи і технології в управлінні</option>
		<option value="2311">Інформаційні системи міжнародного маркетингу</option>
		<option value="1497">Інформаційні системи та технології</option>
		<option value="2106">Інформаційні системи та технології в банківській сфері</option>
		<option value="2418">Інформаційні системи та технології в оподаткуванні</option>
		<option value="1517">Інформаційні технології</option>
		<option value="1840">Інформаційні технології в економіці</option>
		<option value="2438">Інформаційні технології в міжнародному бізнесі</option>
		<option value="1842">Інформаційні технології в освіті</option>
		<option value="2190">Інформаційні управляючі с-ми в інновац. діяльності підпр-в</option>
		<option value="2258">Інформаційно- комунік. забезп.: Бази даних кінцевих користувачів</option>
		<option value="2209">Інформаційно- комунік. забезп.: БД, аналіз та електронний документообіг</option>
		<option value="2417">Інформаційно- комунік. забезп.: Основи наукових досліджень</option>
		<option value="1906">Інформаційно-комунік. забезпеч.: Інформ. системи обробки фінанс. інформ. на підприємствах</option>
		<option value="1528">Інформаційно-комунікаційне забезпечення</option>
		<option value="2207">Інфраструктура товарного ринку, товарознавство</option>
		<option value="2362">ІС і технології в управлінні інноваціями</option>
		<option value="2380">ІС і технології в управлінні проектами</option>
		<option value="784">Історія економіки та економічної думки</option>
		<option value="2060">Історія економічних учень</option>
		<option value="2217">Історія розвитку медіа та реклами і зв'язків з громадськістю</option>
		<option value="1615">Історія та теорія оподаткування</option>
		<option value="219">Історія України</option>
		<option value="1404">Історія української культури</option>
		<option value="1922">Кадрова безпека</option>
		<option value="463">Кадрове діловодство</option>
		<option value="1914">Капітал підприємства: формування та використання</option>
		<option value="2212">Кількісні методи</option>
		<option value="2320">Кількісно-якісне моделювання в упр. розвитком персоналу</option>
		<option value="2142">Комерційна діяльність підприємств</option>
		<option value="2518">Комерційна логістика</option>
		<option value="1700">Комп'ютерна графіка  та візуалізація</option>
		<option value="2354">Комп'ютерний аудит</option>
		<option value="2468">Комп'ютерні ІС в організації роботи ІТ-підприємств</option>
		<option value="379">Комп'ютерні мережі</option>
		<option value="1853">Комп'ютерні мережі та захист інформації</option>
		<option value="1520">Комп`ютеризоване забезпечення видавничо-поліграф. систем</option>
		<option value="1228">Комп`ютерна анімація</option>
		<option value="1698">Комп`ютерна схемотехніка та архітектура комп`ютеров</option>
		<option value="2509">Комп`ютерні облікові системи</option>
		<option value="1873">Комунікація в публічній адміністрації</option>
		<option value="2179">Кон'юнктура світових товарних ринків</option>
		<option value="2200">Конкурентний аналіз та конкурентна розвідка</option>
		<option value="2203">Конкурентоспроможність підприємства</option>
		<option value="1879">Конституція та врядування</option>
		<option value="562">Контролінг</option>
		<option value="2355">Контроль економ. безпеки діяльності підп-ва</option>
		<option value="1450">Контроль і ревізія</option>
		<option value="2256">Контроль у бюджетних та фінансово-кредитних установах</option>
		<option value="629">Конфліктологія</option>
		<option value="405">Корпоративне управління</option>
		<option value="2487">Корпоративне управління та соціальна відповідальність</option>
		<option value="2447">Корпоративні фінанси</option>
		<option value="2213">Країнознавство</option>
		<option value="1121">Креативний менеджмент</option>
		<option value="2548">Креативність в підприємницькій діяльності</option>
		<option value="1061">Кредитний менеджмент</option>
		<option value="1377">Крос-платформне програмування</option>
		<option value="2267">Крос - культурний менеджмент</option>
		<option value="2298">Кросплатформові та багатоланкові технології</option>
		<option value="826">Культура ділового спілкування</option>
		<option value="2533">Культура та комунікації</option>
		<option value="2479">Культура цифрових медіа</option>
		<option value="2178">Культурологія</option>
		<option value="2238">Лідерство та партнерство в бізнесі</option>
		<option value="2278">Лінійна алгебра та аналітична геометрія</option>
		<option value="1911">Логіка</option>
		<option value="434">Логістика</option>
		<option value="2188">Логістика в міжнародному туризмі</option>
		<option value="2268">Логістика невиробничої сфери: Комерційна логістика</option>
		<option value="2269">Логістика невиробничої сфери: Логістичне обслуговування</option>
		<option value="2273">Логістика невиробничої сфери: Упр. ризиками в логістиці</option>
		<option value="1642">Логістичне адміністрування</option>
		<option value="2519">Логістичне обслуговування</option>
		<option value="984">Логістичний менеджмент</option>
		<option value="2458">Логістичний менеджмент та адміністрування</option>
		<option value="1302">Людський розвиток</option>
		<option value="2449">Макро і мікроекономіка</option>
		<option value="243">Макроекономіка</option>
		<option value="2325">Макроекономіка: Макроеконом. моделі аналізу соц.-економ. процесів</option>
		<option value="2063">Макроекономічна політика</option>
		<option value="1312">Макроекономічний аналіз</option>
		<option value="248">Маркетинг</option>
		<option value="1336">Маркетинг інновацій</option>
		<option value="1600">Маркетинг послуг</option>
		<option value="1972">Маркетинг промислового підприємства</option>
		<option value="1920">Маркетинг у банківській сфері</option>
		<option value="2343">Маркетинг у банку</option>
		<option value="612">Маркетингова товарна політика</option>
		<option value="1973">Маркетингове ціноутворення</option>
		<option value="591">Маркетинговий менеджмент</option>
		<option value="608">Маркетингові дослідження</option>
		<option value="1974">Маркетингові комунікації</option>
		<option value="2317">Маркетингові комунікації в міжнародному бізнесі</option>
		<option value="1716">Маркетингові комунікації в туристичній діяльності</option>
		<option value="2218">Масова комунікація та інформація</option>
		<option value="2047">Математика для економістів: Теорія ймовірності та математична статистика</option>
		<option value="1932">Математичне моделюван. в економіці та менеджменту: Дослідж. операцій</option>
		<option value="2053">Математичне моделюван. в економіці та менеджменту: Економетрія</option>
		<option value="2514">Математичне моделювання та СППР</option>
		<option value="2279">Математичний аналіз</option>
		<option value="2222">Математичний аналіз та лінійна алгебра</option>
		<option value="1837">Математичні методи дослідження операцій</option>
		<option value="2309">Математичні методи і моделі менеджменту персоналу</option>
		<option value="2308">Математичні методи і моделі фінансового менеджменту</option>
		<option value="982">Математичні методи та моделі ринкової економіки</option>
		<option value="899">Матеріалознавство</option>
		<option value="2398">Медіа-комунікації у соціальному середовищі</option>
		<option value="2394">Медіа - технології</option>
		<option value="2349">Менджмент організацій</option>
		<option value="247">Менеджмент</option>
		<option value="2161">Менеджмент в будівництві</option>
		<option value="2119">Менеджмент в податкових органах України</option>
		<option value="2556">Менеджмент в системі органів державної влади та місцевого самоврядування</option>
		<option value="2516">Менеджмент зв'язків з громадськістю</option>
		<option value="567">Менеджмент зовнішньоекономічної діяльності</option>
		<option value="1628">Менеджмент і адміністрування</option>
		<option value="1945">Менеджмент і адміністрування : Планування діяльності підпр-ва</option>
		<option value="2052">Менеджмент і адміністрування: Менеджмент</option>
		<option value="1944">Менеджмент і адміністрування: Операційний менеджмент</option>
		<option value="1950">Менеджмент і адміністрування: Самоменеджмент</option>
		<option value="2056">Менеджмент і адміністрування: Теорія організації</option>
		<option value="2054">Менеджмент і адміністрування: Управління персоналом</option>
		<option value="2292">Менеджмент міжнародного туризму</option>
		<option value="2452">Менеджмент організацій: міжнародний аспект</option>
		<option value="394">Менеджмент персоналу</option>
		<option value="2427">Менеджмент персоналу та організаційна поведінка</option>
		<option value="2511">Менеджмент підприємств малого бізнесу</option>
		<option value="1292">Менеджмент та маркетинг в туризмі</option>
		<option value="2163">Менеджмент торгівельних та посередницьких організацій</option>
		<option value="951">Менеджмент у структурі ВПК</option>
		<option value="2331">Менеджмент у сфері послуг</option>
		<option value="2332">Менеджмент якості</option>
		<option value="2481">Менеджмент якості бізнес-процесів ІТ- підприємств</option>
		<option value="868">Менеджмент якості і сертифікації продукції</option>
		<option value="2426">Мережеві технології</option>
		<option value="2506">Мережеві технології обробки інформації</option>
		<option value="1951">Методи діагностики та прогнозування розвитку підприємства</option>
		<option value="375">Методи економіко-статистичних досліджень</option>
		<option value="2368">Методи оптимізації в задачах управління</option>
		<option value="2234">Методи оцінки вартості бізнесу</option>
		<option value="886">Методи прийняття рішень</option>
		<option value="2327">Методи статист. аналізу та планування національної економ.: Система націон.  рахунків</option>
		<option value="2326">Методи статистичного аналізу бізнес-проектів</option>
		<option value="2375">Методи та моделі дослідження економ. процесів та управ. проектами у туризмі</option>
		<option value="797">Методи та моделі дослідження економічних процесів</option>
		<option value="2430">Методи та моделі кількісної економіки</option>
		<option value="2307">Методи та моделі упр. конкурентоспр. підприємств</option>
		<option value="1386">Методи та системи ППР в упрв. еколог.-економ. процессами підпр-в</option>
		<option value="2058">Методи та системи штучного інтелекту</option>
		<option value="2230">Методика викладання економічних дисциплін</option>
		<option value="2376">Методологія і організація наукових досліджень у туризмі</option>
		<option value="2507">Методологія і організація статистики</option>
		<option value="845">Методологія наукових досліджень</option>
		<option value="2078">Методологія наукових досліджень в інформ. економіці</option>
		<option value="2001">Митна справа</option>
		<option value="239">Міжнародна економіка</option>
		<option value="2080">Міжнародна економічна діяльність України</option>
		<option value="2180">Міжнародна економічна інтеграція</option>
		<option value="2081">Міжнародне економічне право</option>
		<option value="2549">Міжнародне підприємництво</option>
		<option value="1717">Міжнародне право</option>
		<option value="2082">Міжнародний інвестиційний менеджмент</option>
		<option value="2365">Міжнародний комунікативний бізнес-менеджмент</option>
		<option value="2457">Міжнародний логістичний менеджмент</option>
		<option value="283">Міжнародний маркетинг</option>
		<option value="398">Міжнародний менеджмент</option>
		<option value="1718">Міжнародний туризм</option>
		<option value="2439">Міжнародний фінансовий менеджмент</option>
		<option value="2312">Міжнародні бізнес-стратегії підприємства</option>
		<option value="2489">Міжнародні відносини та світова політика</option>
		<option value="279">Міжнародні економічні відносини</option>
		<option value="1098">Міжнародні кредитно-розрахункові та валютні операції</option>
		<option value="556">Міжнародні розрахунки і валютні операції</option>
		<option value="2541">Міжнародні стандарти аудиту</option>
		<option value="2044">Міжнародні стандарти забезпечення безпеки підприємств</option>
		<option value="2313">Міжнародні стратегії ціноутворення</option>
		<option value="2083">Міжнародні фінанси</option>
		<option value="2530">Мікро- та макроекономіка</option>
		<option value="238">Мікроекономіка</option>
		<option value="1742">Мікроекономічний аналіз</option>
		<option value="2012">Мобільні технології</option>
		<option value="332">Моделі економічної динаміки</option>
		<option value="2075">Моделі оцінки економічної безпеки</option>
		<option value="1744">Моделювання бізнес-процесів</option>
		<option value="2173">Моделювання бізнес-процесів в логістиці</option>
		<option value="2074">Моделювання економіки</option>
		<option value="1338">Моделювання інноваційних процесів</option>
		<option value="2483">Моделювання інформаційних систем</option>
		<option value="2408">Моделювання освітньої та професійної підготовки фахівця</option>
		<option value="521">Моделювання систем</option>
		<option value="1536">Моделювання та оптимізація економічних систем</option>
		<option value="2374">Моделювання та прогнозування стану довкілля</option>
		<option value="2193">Моделювання техн. с-м та сучасні технології видавничо-полігр. галузі</option>
		<option value="1383">Моніторинг екологічної та техногенної безпеки</option>
		<option value="2407">Моніторинг та педагогічний контроль у системі освіти	
</option>
		<option value="1505">Мотиваційний менеджмент</option>
		<option value="1977">Мотивування персоналу</option>
		<option value="1239">Мультимедійне видавництво</option>
		<option value="2372">Мультимедійний дизайн та візуалізація даних</option>
		<option value="1234">Мультимедійні видання</option>
		<option value="2030">Мультимедійні технології</option>
		<option value="2492">Мультимедійні технології в медіа та рекламі</option>
		<option value="2214">Навчальна дисц. технологічного спрямування</option>
		<option value="2386">Наукове та методичне забезп. діяльності фахівців з фінансово-економ. безпеки</option>
		<option value="2223">Національна економіка</option>
		<option value="2469">Нейромережеві методи прогнозування економ. часових рядів</option>
		<option value="2079">Нелінійні моделі економічної динаміки</option>
		<option value="456">Нормування праці</option>
		<option value="510">Об'єктно-орієнтоване програмування</option>
		<option value="1188">Обгрунтування господ. рішень і оцінювання ризиків</option>
		<option value="902">Обладнання видавничо-поліграфічного виробництва</option>
		<option value="1448">Облік в бюджетних установах</option>
		<option value="1325">Облік виробництва та управління витратами</option>
		<option value="2537">Облік діяльності та управління витратами підприємств</option>
		<option value="1769">Облік за видами економічної діяльності</option>
		<option value="1308">Облік зовнішньоеконом. операцій підпр-в туристичної галузі</option>
		<option value="1355">Облік і аналіз персоналу</option>
		<option value="1629">Облік і аудит</option>
		<option value="1958">Облік і звітність в оподаткуванні</option>
		<option value="2356">Облік і техніка проведення ЗЕО</option>
		<option value="2122">Облік і фінансова звітність за міжнародними стандартами</option>
		<option value="2488">Облік міжнародних операцій</option>
		<option value="2318">Облік та оподаткування малого і середнього бізнесу</option>
		<option value="2120">Облік та оподаткування суб'єктів малого підпр-ва</option>
		<option value="485">Облік у банках</option>
		<option value="286">Облік у зарубіжних країнах</option>
		<option value="2388">Обліково-аналітичне забезп. економічної безпеки</option>
		<option value="2470">Обробка нечіткої інформації</option>
		<option value="2104">Операції банків з цінними паперами</option>
		<option value="436">Операційний менеджмент</option>
		<option value="1687">Операційні системи</option>
		<option value="2096">Оподаткування виплат з оплати праці</option>
		<option value="2346">Оподаткування ЗЕД</option>
		<option value="1307">Оподаткування підпр-в туристичної галузі</option>
		<option value="2117">Оподаткування суб'єктів господарювання</option>
		<option value="2347">Оподаткування суб'єктів малого підприємництва</option>
		<option value="1859">Опрацювання відео-та аудіоінформації</option>
		<option value="1848">Оптимізація роботи програмних додатків</option>
		<option value="2232">Ораторська майстерність</option>
		<option value="444">Організаційна поведінка</option>
		<option value="1963">Організаційне проектування  підприємства</option>
		<option value="1923">Організаційні комунікації</option>
		<option value="519">Організація БД і знань</option>
		<option value="2123">Організація бухгалтерського обліку</option>
		<option value="1820">Організація в'їзного туризму</option>
		<option value="2167">Організація вироб-ва на підприємствах машинобудування</option>
		<option value="1784">Організація виробництва</option>
		<option value="2512">Організація виробництва нової продукції (робіт, послуг) на підпр.</option>
		<option value="1821">Організація готельного господарства: Готельний бізнес</option>
		<option value="2287">Організація готельного господарства: Інф.-комунікац. забезпечення</option>
		<option value="2004">Організація екскурсійної діяльності</option>
		<option value="2245">Організація і методи вибіркових обстежень</option>
		<option value="2128">Організація і методика аудиту</option>
		<option value="1978">Організація і планування виробництва</option>
		<option value="2195">Організація і техніка проведення ЗЕО у туризмі</option>
		<option value="2236">Організація міжнародних маркетингових досліджень</option>
		<option value="2360">Організація обліку діяльності суб`єктів різних форм господарювання</option>
		<option value="1765">Організація податкового процесу</option>
		<option value="457">Організація праці</option>
		<option value="1149">Організація праці менеджера</option>
		<option value="1822">Організація ресторанного господарства</option>
		<option value="2389">Організація та управ. безпекою соціальних систем</option>
		<option value="1823">Організація туризму: Організація туристичних подорожей</option>
		<option value="2286">Організація туризму: Основи туристичної діяльності</option>
		<option value="2006">Організація туризму: Туроперейтинг</option>
		<option value="1908">Організація фінансової діяльності: Фінансова діяльність суб`єктів підприємництва</option>
		<option value="2051">Організація фінансової діяльності: Фінансовий аналіз</option>
		<option value="2413">Основи бізнесу та менеджменту</option>
		<option value="2204">Основи екології</option>
		<option value="2532">Основи економіки для журналістів</option>
		<option value="1852">Основи електротехніки та електроніки</option>
		<option value="2197">Основи інформаційної економіки</option>
		<option value="895">Основи композиції та дизайну</option>
		<option value="1640">Основи логістичного консультування</option>
		<option value="2414">Основи маркетингу</option>
		<option value="415">Основи наукових досліджень</option>
		<option value="2253">Основи наукових досліджень у фінансовій сфері</option>
		<option value="955">Основи об`єктно-орієнтованного програмування</option>
		<option value="1510">Основи охорони праці</option>
		<option value="1846">Основи патентознавства</option>
		<option value="907">Основи підприємницької діяльності</option>
		<option value="1198">Основи програмування</option>
		<option value="2523">Основи проектування WEB- видань</option>
		<option value="2137">Основи технологічних систем</option>
		<option value="2285">Основи туристичної діяльності</option>
		<option value="673">Основи управлінського консультування</option>
		<option value="1212">Охорона праці в галузі</option>
		<option value="1725">Охорона праці та безпека життєдіяльності</option>
		<option value="2091">Оцінка вартості бізнесу</option>
		<option value="2205">Оцінка ефективності діяльності підприємства</option>
		<option value="848">Оцінка ефективності інновацій</option>
		<option value="1477">Оцінка майна підприємств</option>
		<option value="1587">Оцінка нематеріальних активів та корпоративних прав</option>
		<option value="2196">Оцінка та аналіз ефективності виробництва</option>
		<option value="2361">Оцінка цілісних майнових комплексів</option>
		<option value="1777">Оцінка цінних паперів</option>
		<option value="2411">Педагогіка та професійна психологія</option>
		<option value="2191">Педагогіка та психологія вищої школи</option>
		<option value="2528">Педагогічний контролінг</option>
		<option value="2357">Перевірка державних закупівель</option>
		<option value="2261">Підготовка виробництва нової продукції</option>
		<option value="1938">Підготовка виробництва нової продукції машинобудівного підприємства</option>
		<option value="1728">Підприємництво</option>
		<option value="1304">Підприємство та бізнес-культура</option>
		<option value="2262">Планування діяльності підприємства</option>
		<option value="2381">Планування і використання проектних дій</option>
		<option value="1077">Планування і контроль на підприємстві</option>
		<option value="393">Платіжні системи</option>
		<option value="1976">Поведінка споживача</option>
		<option value="954">Поглиблене вивчення іноземної мови</option>
		<option value="2114">Податкова політика</option>
		<option value="408">Податкова система</option>
		<option value="2098">Податкова статистика</option>
		<option value="2099">Податкове консультування</option>
		<option value="2535">Податкове планування та мінімізація податкових ризиків</option>
		<option value="2536">Податкове регулювання соціально-економічних процесів</option>
		<option value="574">Податковий контроль</option>
		<option value="2337">Податковий менеджмент</option>
		<option value="2097">Податковий облік та звітність</option>
		<option value="302">Політична економія</option>
		<option value="236">Політологія</option>
		<option value="2270">Порівняльний менеджмент</option>
		<option value="1078">Потенціал і розвиток підприємства</option>
		<option value="416">Право</option>
		<option value="2387">Правове забезп. безпеки суб'єктів господарської діяльності в Україні</option>
		<option value="2554">Правове забезпечення публічної служби</option>
		<option value="2007">Правове регулювання туристичної діяльності</option>
		<option value="2397">Правові основи медіа-комунікацій</option>
		<option value="2454">Правові та фінансово-економічні аспекти упр. навчальним закладом</option>
		<option value="2531">Правознавство</option>
		<option value="2498">Практики просування та споживча поведінка</option>
		<option value="2494">Практична стилістика та копірайтинг</option>
		<option value="1012">Предметні технології інформаційних систем</option>
		<option value="2045">Предметні технології ІС (метрологія та стандартизація)</option>
		<option value="1844">Прийняття рішень засобами ГІС</option>
		<option value="2517">Прийняття та реалізація управлінських рішень</option>
		<option value="1534">Прикладна економетрія</option>
		<option value="892">Прикладна математика</option>
		<option value="1196">Прикладна теорія ігор</option>
		<option value="2068">Прикладні алгоритми математичного моделювання</option>
		<option value="2502">Прикладні задачі дослідження економічних процесів</option>
		<option value="885">Принципи проектування баз даних та баз знань</option>
		<option value="2073">Прогнозування соціально-економічних процесів</option>
		<option value="2420">Програмування</option>
		<option value="2373">Програмування для мобільних пристроїв</option>
		<option value="2031">Програмування засобів мультимедіа</option>
		<option value="558">Проектне фінансування</option>
		<option value="450">Проектний аналіз</option>
		<option value="2463">Проектний менеджмент</option>
		<option value="598">Проектний менеджмент у публічному адмініструванні</option>
		<option value="1203">Проектування видавничих, друкарських і оздоб-них процесів</option>
		<option value="1832">Проектування інформаційних систем</option>
		<option value="2527">Проектування користувальницького інтерфейсу</option>
		<option value="1638">Проектування логістичних систем</option>
		<option value="1438">Проектування трудових процесів</option>
		<option value="2390">Професійна психологія</option>
		<option value="2255">Професійні цінності і етика бухгалтера</option>
		<option value="223">Психологія</option>
		<option value="2338">Психологія кризи</option>
		<option value="2416">Психологія та педагогіка</option>
		<option value="1888">Психологія управління</option>
		<option value="1760">Публічні фінанси</option>
		<option value="585">Регіональна економіка</option>
		<option value="2555">Регіональна соціально-економічна політика</option>
		<option value="999">Регіональний менеджмент</option>
		<option value="2460">Реінжинірінг бізнес-процесов</option>
		<option value="2246">Рекламний бізнес, як сфера послуг</option>
		<option value="625">Рекламний менеджмент</option>
		<option value="1824">Рекреаційні комплекси світу</option>
		<option value="1525">Релігієзнавство</option>
		<option value="2166">Ресурне забезпечення медичних установ</option>
		<option value="2263">Ресурсне забезпечення підприємств</option>
		<option value="1515">Ресурсне та місцеве оподаткування</option>
		<option value="2539">Ризик- менеджмент та страхування бізнесу</option>
		<option value="920">Ризик-менеджмент</option>
		<option value="465">Ринок праці</option>
		<option value="389">Ринок фінансових послуг</option>
		<option value="2066">Риторика</option>
		<option value="2322">Розвиток персоналу</option>
		<option value="2369">Розподіленні сховища даних</option>
		<option value="2029">Розробка Web - додатків</option>
		<option value="2299">Розробка розподілених мобільних прогр. продуктів Cloub Computing</option>
		<option value="2271">Самоменеджмент</option>
		<option value="1543">Світова економіка і глобалізація</option>
		<option value="2450">Світове господарство і міжнародні економічні відносини</option>
		<option value="2495">Семіотика медіа-тексту в контексті семантики культури (в галузі PR)</option>
		<option value="1833">Системи обробки еколого-економічної інформації</option>
		<option value="1683">Системи перетворення та обробки інформ. у видавничій справі</option>
		<option value="2175">Системи підтримки прийняття рішень</option>
		<option value="357">Системи прийняття рішень</option>
		<option value="2526">Системи технологій обслуговування</option>
		<option value="1106">Системи технологій промисловості</option>
		<option value="2484">Системи штучного інтелекту</option>
		<option value="2476">Системна екологія</option>
		<option value="1695">Системний аналіз</option>
		<option value="451">Системний аналіз в економіці</option>
		<option value="1031">Системний аналіз соціально-економ. процесів</option>
		<option value="2282">Системний аналіз та проектування інформ. систем</option>
		<option value="2409">Системний підхід у вищій школі</option>
		<option value="1854">Скриптові мови</option>
		<option value="2064">Соціальна відповідальність</option>
		<option value="2432">Соціальна економіка</option>
		<option value="2428">Соціальна економіка та політика</option>
		<option value="470">Соціальна політика</option>
		<option value="655">Соціальна психологія</option>
		<option value="1799">Соціальна статистика</option>
		<option value="2215">Соціальна та економічна історія України</option>
		<option value="2550">Соціальне підприємництво</option>
		<option value="1878">Соціальний розвиток</option>
		<option value="1861">Соціально-орієнтований менеджмент</option>
		<option value="361">Соціологія</option>
		<option value="2524">Соціологія та психологія</option>
		<option value="1850">Спортивний туризм</option>
		<option value="948">Стандартизація і метрологія у поліграфії</option>
		<option value="1788">Стандартизація і сертифікація товарів і послуг</option>
		<option value="245">Статистика</option>
		<option value="2105">Статистика банківських процесів</option>
		<option value="2324">Статистика для менеджерів</option>
		<option value="2328">Статистика міжнародних порівнянь</option>
		<option value="2288">Статистика міжнародного туризму</option>
		<option value="2242">Статистика підприємства</option>
		<option value="2154">Статистика регіонального розвитку</option>
		<option value="1029">Статистика ринків</option>
		<option value="1251">Статистика ринку товарів та послуг</option>
		<option value="343">Статистика фінансового ринку</option>
		<option value="2243">Статистика якості продукції</option>
		<option value="1987">Статистичне моделювання та прогнозування</option>
		<option value="2241">Статистичний аналіз ризиків та методи їх оцінювання
	
</option>
		<option value="2329">Статистичний моніторинг діяльності підпр-в та організацій</option>
		<option value="2244">Статистичні методи оцінки регіонального розвитку</option>
		<option value="2330">Статистичні методи прийняття управлінських рішень</option>
		<option value="1242">Створення інтерактивних медіа</option>
		<option value="2084">Стратегії інноваційно-технологічного розвитку ЗЕД підпр-ва</option>
		<option value="2043">Стратегічне та інновац. забезп. розвитку системи безпеки підпр-ва</option>
		<option value="333">Стратегічне управління</option>
		<option value="2363">Стратегічне управління інноваційним розвитком</option>
		<option value="1143">Стратегічний аналіз</option>
		<option value="624">Стратегічний маркетинг</option>
		<option value="566">Стратегічний менеджмент</option>
		<option value="452">Стратегія підприємств</option>
		<option value="2110">Страховий менеджмент</option>
		<option value="1305">Страхування</option>
		<option value="1284">Страхування у ЗЕД</option>
		<option value="1703">Страхування у міжнародному туризмі</option>
		<option value="2358">Судово-економічна експертиза</option>
		<option value="2018">Сучасна теорія керування в ІУС</option>
		<option value="2023">Сучасна теорія керування в КЕЕМ</option>
		<option value="2471">Сучасна теорія управління</option>
		<option value="2472">Сучасні евристичні алгоритми оптимізації</option>
		<option value="2429">Сучасні економічні теорії</option>
		<option value="857">Сучасні інформаційні системи і технології</option>
		<option value="2248">Сучасні методи обробки та аналізу інф. в маркетинг. дослід.</option>
		<option value="2348">Сучасні тенденції світового оподаткування</option>
		<option value="2136">Сучасні технології в економіці консалтингу</option>
		<option value="2226">Сучасні технології електрон. технолог. промисловості</option>
		<option value="2300">Сховища даних</option>
		<option value="2395">Теоретичні основи управління комунікаційними процесами</option>
		<option value="548">Теорії господарства</option>
		<option value="2305">Теорії інноваційного розвитку</option>
		<option value="2028">Теорії медіа</option>
		<option value="1696">Теорія алгоритмів</option>
		<option value="561">Теорія економічного аналізу</option>
		<option value="2071">Теорія економічного ризику</option>
		<option value="2400">Теорія і менеджмент організацій</option>
		<option value="2412">Теорія і практика вищої освіти</option>
		<option value="2499">Теорія і практика рекламної та PR- діяльності</option>
		<option value="2485">Теорія інформації і кодування</option>
		<option value="1375">Теорія ймовірностей, імовірнісні процеси та математ. ст-ка</option>
		<option value="2415">Теорія ймовірності та математична статистика</option>
		<option value="894">Теорія кольору</option>
		<option value="2306">Теорія корпор-х відносин та соціальна відповідальність бізнесу</option>
		<option value="2437">Теорія корпоративних відносин</option>
		<option value="2490">Теорія міжнародних відносин</option>
		<option value="1882">Теорія організацій</option>
		<option value="1484">Теорія прийняття рішень</option>
		<option value="2396">Теорія та практика рекламної комунікації</option>
		<option value="2377">Теорія цифрових зображень</option>
		<option value="1881">Територіальне управління</option>
		<option value="1814">Техніка і організація зовнішньоекономічних операцій</option>
		<option value="893">Технічна механіка</option>
		<option value="2165">Технічний розвиток та модернізація підприємства</option>
		<option value="1232">Технології WEB-дизайну</option>
		<option value="2159">Технології адміністрування та організації праці на підпр-ві</option>
		<option value="2050">Технології виробництва: Основи екології</option>
		<option value="1939">Технології виробництва: Системи технологій промисловості</option>
		<option value="956">Технології електронного видавництва</option>
		<option value="2014">Технології захисту інформації</option>
		<option value="775">Технології комп'ютерного дизайну</option>
		<option value="1834">Технології комп'ютерного проектування</option>
		<option value="2473">Технології обробки даних в інформ.-комунікац. системах</option>
		<option value="1231">Технології ООП</option>
		<option value="901">Технології поліграфічного виробництва</option>
		<option value="2041">Технології публічного адміністрування</option>
		<option value="2013">Технології розподілених систем та паралельних обчислень</option>
		<option value="2486">Технології розробки та тестування програмного забезпечення</option>
		<option value="1835">Технології тестування програмних продуктів</option>
		<option value="1199">Технологічні процеси видавничо-поліграф. справи</option>
		<option value="2177">Технологія аналізу та планування бізнесу</option>
		<option value="2448">Технологія ділових переговорів і партнерства</option>
		<option value="2072">Технологія проект-ня та адмініструв. баз даних і сховищ даних</option>
		<option value="1836">Технологія створення програмних продуктів</option>
		<option value="2026">Технологія фотореєстраційних процесів</option>
		<option value="2027">Типографіка</option>
		<option value="626">Товарна інноваційна політика</option>
		<option value="865">Товарознавство</option>
		<option value="2237">Транснаціоналізація бізнесу і регуляторна система СОТ</option>
		<option value="1333">Трансфер технологій</option>
		<option value="2025">Тримірне моделювання</option>
		<option value="419">Трудове право</option>
		<option value="1829">Туризмологія</option>
		<option value="417">Українська мова</option>
		<option value="1571">Українська мова (за професійним спрямуванням)</option>
		<option value="2024">Університетська освіта (вступ до фаху)</option>
		<option value="2291">Упр. конкурентоспроможністю підпр-в туристичної галузі</option>
		<option value="2344">Управління банківськими ризиками</option>
		<option value="1710">Управління бізнес-процесами</option>
		<option value="2445">Управління бізнес-процесами на підприємстві</option>
		<option value="1916">Управління вартістю підприємства</option>
		<option value="2333">Управління взаємовідносинами</option>
		<option value="1785">Управління витратами</option>
		<option value="1969">Управління витратами та прибутком</option>
		<option value="2314">Управління експортним потенціалом підприємства</option>
		<option value="2551">Управління ефективністю розвитку підприємництва</option>
		<option value="1658">Управління змінами</option>
		<option value="2461">Управління іміджем підприємства</option>
		<option value="2513">Управління інвестуванням інноваційної діяльності</option>
		<option value="1679">Управління інноваційними проектами</option>
		<option value="2272">Управління інноваціями</option>
		<option value="2404">Управління інформаційними зв'язками</option>
		<option value="2399">Управління інформаційними процесами у бізнес-середовищі</option>
		<option value="2009">Управління ІТ проектами</option>
		<option value="2315">Управління капіталом в міжнар. економ. діяльності підпр-ва</option>
		<option value="2534">Управління комунікаційними процесами у бізнес- середовищі</option>
		<option value="2446">Управління конкурентоспроможністю підприємства</option>
		<option value="1083">Управління консалтинговою діяльністю</option>
		<option value="2143">Управління конфліктами</option>
		<option value="1639">Управління ланцюгами поставок</option>
		<option value="2455">Управління людськими ресурсами</option>
		<option value="2316">Управління міжнар. маркетинговою діяльністю підпр-ва</option>
		<option value="674">Управління міжнародною конкурентноспроможністю підприємства</option>
		<option value="2402">Управління навчальною та виховною діяльністю</option>
		<option value="1999">Управління організаційними системами</option>
		<option value="2456">Управління освітньою діяльністю</option>
		<option value="466">Управління персоналом</option>
		<option value="2462">Управління потенціалом підприємства</option>
		<option value="1787">Управління проектами</option>
		<option value="376">Управління проектами інформатизації</option>
		<option value="2382">Управління проектами у сфері регіонального розвитку</option>
		<option value="2319">Управління проектною командою</option>
		<option value="1335">Управління проц. розробки й освоєння вироб-ва нових продуктів</option>
		<option value="2139">Управління рекламним бізнесом</option>
		<option value="2366">Управління ризиками в експортній діяльності підпр-ва</option>
		<option value="2520">Управління ризиками в логістиці</option>
		<option value="2440">Управління ризиками в міжнар. економічній діяльності</option>
		<option value="2057">Управління розвитком</option>
		<option value="1315">Управління розвитком експортного потенц. підпр-ва</option>
		<option value="2321">Управління розвитком персоналу</option>
		<option value="1666">Управління розвитком підприємства</option>
		<option value="1928">Управління розвитком соціально-економічних систем</option>
		<option value="2451">Управління розвитком: інноваційний аспект</option>
		<option value="2474">Управління та менеджмент якості бізнес-процесів ІТ-підприємств</option>
		<option value="2164">Управління технолог. процесами у галузі охорони здоров'я</option>
		<option value="1180">Управління трудовим потенціалом</option>
		<option value="2403">Управління трудовими ресурсами</option>
		<option value="2339">Управління фінансовою санацією</option>
		<option value="2342">Управління фінансовою санацією підприємства</option>
		<option value="1659">Управління якістю</option>
		<option value="2464">Управлінський консалтинг</option>
		<option value="483">Управлінський облік</option>
		<option value="509">Фізика</option>
		<option value="2421">Фізика, електротехніка та електроніка</option>
		<option value="226">Фізичне виховання</option>
		<option value="454">Фізіологія та психологія праці</option>
		<option value="1684">Філософія</option>
		<option value="249">Фінанси</option>
		<option value="261">Фінанси підприємств</option>
		<option value="1123">Фінанси та фінанси підприємства</option>
		<option value="1634">Фінанси, гроші та кредит</option>
		<option value="1513">Фінансова безпека підприємства</option>
		<option value="1894">Фінансова безпека України</option>
		<option value="1572">Фінансова діяльність суб`єктів підприємництва</option>
		<option value="1552">Фінансова економіка</option>
		<option value="2538">Фінансова звітність за міжнародними стандартами та її аналіз</option>
		<option value="770">Фінансова математика</option>
		<option value="2341">Фінансова стратегія</option>
		<option value="2557">Фінансове регулювання економіки</option>
		<option value="399">Фінансовий аналіз</option>
		<option value="1427">Фінансовий інженіринг</option>
		<option value="1431">Фінансовий контролінг</option>
		<option value="325">Фінансовий менеджмент</option>
		<option value="2383">Фінансовий менеджмент в управлінні проектами</option>
		<option value="555">Фінансовий менеджмент у банку</option>
		<option value="1576">Фінансовий моніторинг</option>
		<option value="2546">Фінансовий моніторинг у банку</option>
		<option value="475">Фінансовий облік</option>
		<option value="1057">Фінансовий облік у банках</option>
		<option value="367">Фінансовий ринок</option>
		<option value="1089">Фінансові потоки в логістичних системах</option>
		<option value="2405">Фінансово-економ. та правові аспекти упр. навч-ним закладом</option>
		<option value="2384">Формування проектної команди</option>
		<option value="1912">Французька мова (за професійним спрямуванням)</option>
		<option value="869">Функціональна логістика</option>
		<option value="538">Хімія</option>
		<option value="2370">Хмарні обчислення</option>
		<option value="1371">Центральний банк і грошово-кредитна система</option>
		<option value="1766">Цивільне право</option>
		<option value="2419">Цивільне та податкове право</option>
		<option value="1557">Цивільний захист</option>
		<option value="413">Ціноутворення</option>
		<option value="2431">Часові ряди</option>
		<option value="1724">Чисельні методи</option>
	</select>
	</td>
</tr></tbody></table>
<table width="640"><tbody><tr><td><font size="-1"><a href="booklist.php" onclick="form_main.ext.value=&quot;yes&quot;;form_main.mode.value=&quot;form&quot;;form_main.submit();return false">Розширений перелік полів</a></font>
</td></tr></tbody></table>

<table width="640">
<tbody><tr><td>
	Кількість документів на сторінці  
	<select name="step">
	<option value="10">10
	</option><option value="20" selected="">20
	</option><option value="30">30
	</option><option value="40">40
	</option><option value="50">50
	</option></select>


&nbsp;<input style="font-size:9pt" type="submit" value="Вибрати" onclick="form_main.mode.value=&quot;BookList&quot;;">&nbsp;
<input style="font-size:9pt" type="reset" value="Очистити"><br><br>



<input type="hidden" name="page" value="1">
</td></tr>
</tbody></table>

<!-- //******************** USH/Library BODY *************************** -->




<p></p>
</td></tr>
<tr valign="top">
<td>
<!--<br>
	<table>
	<tr>
	<td>
		<a href="http://www.ush.kiev.ua/ukr/prod_lib.html"><img src="img/ufdlogo.gif" alt="'Український Фондовий Дім'" ></a>
	</td>
	<td align=center>
		<font size = -1>
		<a href="http://www.ush.kiev.ua/ukr/prod_lib.html">Інформаційно-пошукова система<br>'УФД/Бібліотека'</a>
		</font>
	</td>
	</tr></table>-->
</td></tr></tbody></table>



				<div style="width:900px; text-align:right;"><a href="index.php">Головна сторінка</a></div>
				</form>
</body>
</html>