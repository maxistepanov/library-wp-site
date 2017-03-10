
 // send question button 
 // this call "wp_ajax_questions_query"
	jQuery(document).ready(function(){
		jQuery("#submit").click(function(e){
		
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
					jQuery("#cssload-pgloading").fadeOut(300, function(){
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
					});

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
					jQuery("#wrapper-request-form").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();

					});
				},
				success: function(data){
					jQuery("#cssload-pgloading").fadeOut(300, function(){
						jQuery("#wrapper-request-form").fadeIn();
						jQuery("#wrapper-request-form").html(`
							<div class="alert alert-success alert-dismissible">
							 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<h2>Запит УДК відправлено успішно</h2>
							</div>
							<div class="other-way">
								<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Задати нове питання" />
								<br>
								<a id="question-last-week" href="/last-week-quesions/">Список УДК</a>
							</div>


							`

															)
					});

				}
			});
		});
	});
 




 



