
 // send question button 
 // this call "wp_ajax_questions_query"
	jQuery(document).ready(function(){
		jQuery("#submit_questions").click(function(e){
		
		e.preventDefault();
	    var name = jQuery("#dname").val();
	    var question = jQuery("#dquestion").val();
	    console.log(name);
	    console.log(question);
	   	 
			jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_questions_query",
					 "dname":name,
					 "dquestion":question
					},
				beforeSend: function(){
					jQuery("#wrapper-request-form").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();

					});
				},
				success: function(data){
					jQuery("#cssload-pgloading").fadeOut(300);
					jQuery("#wrapper-request-form").fadeIn();
						jQuery("#wrapper-request-form").html(`
							<div class="alert alert-success alert-dismissible">
							 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<h2>Питання відправлено успішно</h2>
							</div>
							<div class="other-way">
								<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Задати нове питання" />
								<br>
								<a id="question-last-week" href="/last-week-quesions/">Список питань та відповідей за останній тиждень</a>
							</div>


							`

															)

				}
			});
		});
	});




// send udk button 
 // this call "wp_ajax_udk_query"
	jQuery(document).ready(function(){
		jQuery("#submitudk").click(function(e){
		e.preventDefault();
	    var dfio = jQuery("#dfio").val();
	    var dkod = jQuery("#dkod").val();
	    var dname = jQuery("#dname").val();
	    var dnotat = jQuery("#dnotat").val();

	    
	   	 
			jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_udk_query",
					 "dfio":dfio,
					 "dkod":dkod,
					 "dname":dname,
					 "dnotat":dnotat
					},
				beforeSend: function(){
					jQuery("#wrapper-request-udk").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();


					});
				},
				success: function(data){
					
					jQuery("#cssload-pgloading").fadeOut(300, function(){
						jQuery("#wrapper-request-answer").fadeIn();
						jQuery("#wrapper-request-answer").html(`
							<div class="alert alert-success alert-dismissible">
							 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<h2>Запит УДК відправлено успішно</h2>
							</div>
							<div class="other-way">
								<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Створити новый запит УДК" />
								<br>
								<a id="last-udk" href="/define-udk/">Список УДК</a>
							</div>


							`

															)
					});

				}
			});
		});
	});



// action for button delete
jQuery(document).on('click','.btn-del',function(){
   
var button = jQuery(this);
         var num = button.data('id')
        
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_get_question_by_id",
					 "num":num,
					},
				beforeSend: function(){
					jQuery("#deleteQuestionForm").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();


					});
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			jQuery("#deleteQuestionForm").fadeIn();
						var obj = jQuery.parseJSON(response);
						jQuery('.modal-title').text("Питання № "+obj[0].id);
						jQuery('.modal-title').data( "id", obj[0].id );
						jQuery('#user-fio').text(obj[0].fio);
						jQuery('#question-text').text(obj[0].question);
						jQuery('#answear-text').text(obj[0].answear);
						 
						 jQuery("#deleteQuestionForm").modal();


				}
			});

         console.log(button.data('id'));

   
});

// succes button delete qustion
jQuery(document).on('click','.success-delete',function(){
var num =     jQuery('.modal-title').data( "id");
console.log(num);
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_delete_question_by_id",
					 "num":num,
					},
				beforeSend: function(){
					jQuery("#cssload-pgloading").fadeIn();
				
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			
					
						 jQuery("#deleteQuestionForm").modal('hide');
						 /*inside ajax*/
									 jQuery.ajax({
							type: 'POST',
							url: hneu.url,
							data: {
								"action": "wp_ajax_reload_questions",
								 "num":num,
								},
							beforeSend: function(){
								jQuery("#cssload-pgloading").fadeIn();
							
							},
							success: function(response){
								jQuery("#cssload-pgloading").fadeOut(300);
					 			
									

									 // jQuery("#deleteQuestionForm").modal('hide');
									jQuery(".tg").html(response);
									 


							}
						});
						/*end inside ajax*/			 	


				}
			});


});

// action for button edit
jQuery(document).on('click', '.btn-edit',function(){
   

var button = jQuery(this);
         var num = button.data('id')
        
        jQuery(".success-save").attr("data-id", num); 
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_get_question_by_id",
					 "num":num,
					},
				beforeSend: function(){
					/*jQuery("#editQuestionForm").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();


					});*/
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			jQuery("#editQuestionForm").fadeIn();
		 			var modal = jQuery("#editQuestionForm");
						var obj = jQuery.parseJSON(response);
						modal.find('.modal-title').text("Вопрос № "+obj[0].id);
						modal.find('.modal-title').data( "id", obj[0].id );
						modal.find('#user-fio').text(obj[0].fio);
						modal.find('#question-text').text(obj[0].question);
						modal.find('#answear-text').val(obj[0].answear);
						/*jQuery('#answer-text').val(obj[0].answer);*/
						  jQuery("#editQuestionForm").modal();
						


				}
			});

});

  



// success button save answer 
jQuery(document).on('click', '.success-save',function(){
 
 
var num = jQuery(".success-save").attr("data-id");
var answear = jQuery('textarea#answear-text').val();
console.log(answear);
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_save_answear_by_id",
					 "num":num,
					 "answear":answear
					},
				beforeSend: function(){
					jQuery("#cssload-pgloading").fadeIn();
				
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			
					
						 jQuery("#editQuestionForm").modal('hide');
						 /*inside ajax*/
									 jQuery.ajax({
							type: 'POST',
							url: hneu.url,
							data: {
								"action": "wp_ajax_reload_questions",
								 "num":num,
								},
							beforeSend: function(){
								jQuery("#cssload-pgloading").fadeIn();
							
							},
							success: function(response){
								jQuery("#cssload-pgloading").fadeOut(300);
					 			
									

									 // jQuery("#editQuestionForm").modal('hide');
									/*window.location.reload(true);*/
									jQuery(".tg").html(response);
									 


							}
						});
						/*end inside ajax*/			 	


				}
			});

         

   
});


/*======== Udk page ===========*/

jQuery(document).on('click','.btn-del-udk',function(){
   
var button = jQuery(this);
         var num = button.data('id')
        
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_get_udk_by_id",
					 "num":num,
					},
				beforeSend: function(){
					jQuery("#deleteUdkForm").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();


					});
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			var modalDelUdk = jQuery("#deleteUdkForm");
						var obj = jQuery.parseJSON(response);
						console.log(obj);
						modalDelUdk.find('.modal-title').text("Запит № "+obj[0].id);
						modalDelUdk.find('.modal-title').data( "id", obj[0].id );
						modalDelUdk.find('#udk-fio').text(obj[0].fio);
						modalDelUdk.find('#udk-name').text(obj[0].name);
						modalDelUdk.find('#udk-answear_udk').text(obj[0].answear_kod);
						 
						 jQuery("#deleteUdkForm").modal();


				}
			});
});

// succes button delete qustion
jQuery(document).on('click','.success-delete-udk',function(){
var num =     jQuery('.modal-title').data( "id");
console.log(num);
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_delete_udk_by_id",
					 "num":num,
					},
				beforeSend: function(){
					jQuery("#cssload-pgloading").fadeIn();
				
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			
					
						 jQuery("#deleteUdkForm").modal('hide');
						 /*inside ajax*/
									 jQuery.ajax({
							type: 'POST',
							url: hneu.url,
							data: {
								"action": "wp_ajax_reload_udk",
								 "num":num,
								},
							beforeSend: function(){
								jQuery("#cssload-pgloading").fadeIn();
							
							},
							success: function(response){
								jQuery("#cssload-pgloading").fadeOut(300);
					 			
									

									 // jQuery("#deleteUdkForm").modal('hide');
									jQuery(".tg").html(response);
									 


							}
						});
						/*end inside ajax*/			 	


				}
			});


});


// action for button edit
jQuery(document).on('click', '.btn-edit-udk',function(){
   

var button = jQuery(this);
         var num = button.data('id')
        
        jQuery(".success-save-udk").attr("data-id", num); 
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_get_udk_by_id",
					 "num":num,
					},
				beforeSend: function(){
					/*jQuery("#editQuestionForm").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();


					});*/
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			
		 			var modal = jQuery("#editUdkForm");
						var obj = jQuery.parseJSON(response);
						modal.find('.modal-title').text("Запит № "+obj[0].id);
						modal.find('.modal-title').data( "id", obj[0].id );
						modal.find('#udk-fio').text(obj[0].fio);
						modal.find('#udk-name').text(obj[0].name);
						modal.find('#udk-notat').text(obj[0].notat);
						modal.find('#udk-date').text(obj[0].date_udk);
						modal.find('#udk-answear_udk').val(obj[0].answear_kod);
						  jQuery("#editUdkForm").modal();
						


				}
			});

});


// success button save answer 
jQuery(document).on('click', '.success-save-udk',function(){
 
var num = jQuery(".success-save-udk").attr("data-id");
var answear = jQuery('textarea#udk-answear_udk').val();
console.log(answear);
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_save_udk_by_id",
					 "num":num,
					 "answear":answear
					},
				beforeSend: function(){
					jQuery("#cssload-pgloading").fadeIn();
				
				},
				success: function(response){
					jQuery("#cssload-pgloading").fadeOut(300);
		 			
					
						 jQuery("#editUdkForm").modal('toggle');
						 /*inside ajax*/
									 jQuery.ajax({
							type: 'POST',
							url: hneu.url,
							data: {
								"action": "wp_ajax_reload_udk",
								 "num":num,
								},
							beforeSend: function(){
								// jQuery("#cssload-pgloading").fadeIn();
							
							},
							success: function(response){
								// jQuery("#cssload-pgloading").fadeOut(300);
					 			
									

									 // jQuery("#editUdkForm").modal('hide');
									/*window.location.reload(true);*/
									jQuery(".tg").html(response);
									 


							}
						});
						/*end inside ajax*/			 
				}
			});

});


jQuery(document).on('click','.btn-page-udk',function(e){
   e.preventDefault();
var button = jQuery(this);
         var page = button.data('page');
         var per_page = 10;
      
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "get_udk_by_page",
					 "page": page,
					 "per_page": per_page
					},
				beforeSend: function(){
					
							
						// jQuery("#cssload-pgloading").fadeIn();
					
					
				},
				success: function(response){
					
						// jQuery("#cssload-pgloading").fadeOut(300);
		 			jQuery("#wrapper-udk").fadeIn();
					//alert('Got this from the server: ' + response);
					var obj = jQuery.parseJSON(response);
					console.log(obj);
					var	table = `
						 <table class="tg table table-striped" style="undefined;table-layout: fixed; width: 100%">
										 <colgroup>
											 <col style="width: 5%">
											 <col style="width: 15%">
											 <col style="width: 250px">
											 <col style="width: 200px">
										 </colgroup>
									 <tr>
										 <th class="tg-yw4l">№ </th>
										 <th class="tg-yw4l">Дата</th>
										 <th class="tg-yw4l">Автор, назва документа</th>
										 <th class="tg-yw4l">Індекс УДК</th>
									</tr>
									<tr>

					`;
					for (var i = 0 ; i < obj.length-1; i++) {
						table+="<tr>"
			  		table+= '<td class="tg-yw4l">' + obj[i].id +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].date_udk +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].fio +' ,' +obj[i].name+ '</td>';
				    table+='<td class="tg-yw4l">' + obj[i].answear_kod+'</td>';
				    table+="</tr>"
					}
					
					jQuery('.list-udk').html(table);
				/*	$('.list-udk').html(response);*/
					jQuery('.other-way').html(`
						<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Оновити" />
						<br>
						<a id="question-last-week" href="/add-udk/"> Подати новий запит</a>
						`);
					$total_rows = obj[obj.length-1].count;
					
					$per_page = 10;
					$num_pages = Math.ceil( $total_rows / $per_page );
					$page_list = ' ';
					
					$page_list+='<ul class="pagination">';
					for( $i = 1; $i <= $num_pages; $i++) {
  						$page_list+= '<li class="page-item"><a class="page-link btn-page-udk" href="'+ $i 	+'" data-page="' + $i +'">' + $i  +'</a></li> \n';
  					}
  					$page_list+='</ul>';
					jQuery('.pagination-wrapper').html($page_list);

// 					<nav aria-label="Page navigation example">
//   <ul class="pagination">
//     <li class="page-item"><a class="page-link" href="#">Previous</a></li>
//     <li class="page-item"><a class="page-link" href="#">1</a></li>
//     <li class="page-item"><a class="page-link" href="#">2</a></li>
//     <li class="page-item"><a class="page-link" href="#">3</a></li>
//     <li class="page-item"><a class="page-link" href="#">Next</a></li>
//   </ul>
// </nav>

				}
			});

         

   
});


// success button save answer 
jQuery(document).on('click', '.submit-search, .search-page',function(e){
		e.preventDefault();
		 var dt =  jQuery("#search-form").serialize();
		 console.log(dt);
		 var button = jQuery(this);
         var page = button.data('page');
		console.log(page);
		jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_get_search_result",
					"data": dt,
					"current_page": page,
					},
				beforeSend: function(){
					jQuery('body').animate({ scrollTop: 1000 });

					  jQuery('.search-result').html(`			Завантаження...
					<div id="cssload-pgloading" style="display: block; position: relative; height: 132px; top: -90px;">
	<div class="cssload-loadingwrap">
		<ul class="cssload-bokeh">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>`);
					
				},
				success: function(response){
					
				 
				 var bookList = jQuery.parseJSON(response);
				 var title = '';
				 if (Array.isArray(bookList.data) && bookList.data.length){
				 	title = '<h2 id="start-result">Результати пошуку </h2> <h3> Результати ' + bookList.data[0]['row_id'] + ' - '+ bookList.data[bookList.data.length-1]['row_id'] +' від загального числа '+ bookList.data[0].total_count +'</h3>';
				 }
				var fullList =title;
				
				for (var i = 0; i < bookList.data.length; i++) {
				
var item = `
<div class="card">
  <h3 class="card-header">`+ bookList.data[i]['row_id']+'. ' +  bookList.data[i]['author'] +`</h3>

  <div class="card-block">
    <h4 class="card-title">`+ bookList.data[i]['name'] +`</h4>
    <p class="card-text">

    `
   if (bookList.data[i]['col009']) item+= `  `+ bookList.data[i]['col009'];    
   if (bookList.data[i]['publisher']) item+= `  `+ bookList.data[i]['publisher'] + `,`;    
   if (bookList.data[i]['publ_year']) item+= `  `+ bookList.data[i]['publ_year'] + `.–`;    
   if (bookList.data[i]['sizem']) item+= `  `+ bookList.data[i]['sizem'];
   if (bookList.data[i]['cipher']) item+= ` Шифр: `+ bookList.data[i]['cipher'];
   if (bookList.data[i]['author_mark']) item+= ` Авторський знак: `+ bookList.data[i]['author_mark'];
   // if (bookList.data[i]['col018']) item+= `  `+ bookList.data[i]['col018'];
   // if (bookList.data[i]['isbn']) item+= ` ISBN: `+ bookList.data[i]['isbn'];
   // if (bookList.data[i]['bbk']) item+= ` ББК: `+ bookList.data[i]['bbk'];
   // if (bookList.data[i]['issn']) item+= ` ISSN: `+ bookList.data[i]['issn'];
   // if (bookList.data[i]['publ_place']) item+= ` Місце видання: `+ bookList.data[i]['publ_place'];
   item+=`</p>`;
	
	item+= `<a href="/detail/?id=` + bookList.data[i]['doc_id'] + ` " target="blank" class="btn btn-link">Докладно</a>`;
   if (bookList.data[i]['long_filename']) 
   item+= `
   	<a href="`+ bookList.data[i]['long_filename'] +`" class="btn btn-primary">Електронна версія</a>`;
   
/*
('doc_id')
('doc_type')
('author_mark')
('author')
('name')
('publ_place')
('publisher')
('publ_year')
('sizem')
('isbn')
('issn')
('cipher')
('device_kod')
('long_filename')

*/

   var end =  `
   
  </div>
</div>
<br>
`
item+=end;

				 fullList+= item;
				}

var paggination = `

					<nav aria-label="Page navigation example">
					  <ul class="pagination">
					    `;
					    var min = Math.max(+bookList.current_page - 8,1);
					    var max = Math.min(+bookList.current_page + 8,bookList.total/ bookList.per_page);
					    console.log(min+" = =" + max);
	for (var i = min; i <= Math.round(max); i++) {
						var active = '';
					paggination+= ` <li class="page-item `+ (i == +bookList.current_page ? 'active': '') +`"><a class="page-link search-page " data-page="`+ (i) +`" href="#">`+ (i) +`</a></li>`;
					
				}


paggination+= `
					  </ul>
					</nav>
				`;
				fullList+=paggination;
				


				if (!bookList.data.length) fullList = `
						<h2>Результати пошуку: </h2>
						<div class="card card-inverse card-danger text-center">
						  <div class="card-block">
						    <h3>За даними параметрами нічего не знайдено</h3>
						  </div>
						</div>
					`

				   jQuery('.search-result').html(fullList);
				}
			});

      
});



/*======== END Udk page ===========*/
// action for button edit

jQuery( "#columnchart_material").ready(function() {

      jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_get_udk_stat",
					},
				beforeSend: function(){
				
				},
				success: function(response){
					
						 var jsonData = jQuery.parseJSON(response);
						 
						 google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

       var gglData = [];
  if (jsonData.length > 0) {
    // load column headings
    var colHead = [];
    Object.keys(jsonData[0]).forEach(function (key) {
      colHead.push(key);
    });
    gglData.push(colHead);

    // load data rows
    jsonData.forEach(function (row) {
      var gglRow = [];
      Object.keys(row).forEach(function (key) {
      	if (jQuery.isNumeric(row[key]))
        {
        	gglRow.push((parseInt(row[key])));
        }

      else {
      	gglRow.push(row[key]);
      }
      });
      gglData.push(gglRow);
    });
  
  }
  console.log(gglData);
 

        
      function drawChart() {
        var data = google.visualization.arrayToDataTable(gglData);

        var options = {
          chart: {
            title: 'Статистика запитів УДК',

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
				}
			});
});


/*jQuery('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})*/





jQuery(document).on('click','.btn-page-udk-admin',function(e){
   e.preventDefault();
var button = jQuery(this);
         var page = button.data('page');
         console.log(page);
         var per_page = 10;
    
        jQuery.ajax({
				type: 'POST',
				url: hneu.url,
				data: {
					"action": "wp_ajax_reload_udk",
					 "page": page,
					 "per_page": per_page
					},
				beforeSend: function(){
					
							
						// jQuery("#cssload-pgloading").fadeIn();
					
					
				},
				success: function(response){
					jQuery(".tg").html(response);
					
						// jQuery("#cssload-pgloading").fadeOut(300);
		 			// jQuery("#wrapper-udk").fadeIn();
					//alert('Got this from the server: ' + response);
					// var obj = jQuery.parseJSON(response);

				}
			});

         

   
});


