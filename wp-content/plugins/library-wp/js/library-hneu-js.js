
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
					 			
									

									 jQuery("#deleteQuestionForm").modal('hide');
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
					 			
									

									 jQuery("#editQuestionForm").modal('hide');
									/*window.location.reload(true);*/
									jQuery(".tg").html(response);
									 


							}
						});
						/*end inside ajax*/			 	


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




