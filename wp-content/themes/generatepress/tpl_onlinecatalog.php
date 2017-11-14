
<?php
/**
	Template Name: Електронний каталог
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
 */
 

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			
			<?php do_action('generate_before_main_content'); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
				
				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

			<?php do_action('generate_after_main_content'); ?>
			<!--   my custom code block-->

			<article id="post-158" class="post-158 page type-page status-publish" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
	<div class="inside-article">
					<header class="entry-header">
					</header><!-- .entry-header -->
				
				<div class="entry-content" itemprop="text">
					<?php 
    // $serverName = "DESKTOP-IJOBITJ\SQLEXPRESS"; 
// $connectionInfo = array( "Database"=>"library", "CharacterSet" => "UTF-8");
// $serverName = "10.2.81.252";
$serverName = "library.ch5bf5k9ozoc.us-east-2.rds.amazonaws.com";
$connectionInfo = array( "Database"=>"library",'UID'=>'maxi', 'PWD'=>'novatel720', "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT code, name FROM doctype order by name	";
$stmt = sqlsrv_query( $conn, $sql );
$discipline = sqlsrv_query( $conn, "SELECT id, name from discipline order by name" );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

	 ?>
<div id="wrapper-search-form">

	
	
</div>

<!-- loader -->

<!-- end loader -->

<form id="search-form" class="form-horizontal">

  <div class="form-group">
    <label for="author" class=" control-label">Автор</label>
    <div class="">
      <input type="text" class="form-control" id="author" name="author">
    </div>
  </div>

   <div class="form-group">
	   <label for="name" class=" control-label">Назва документа</label>
	
    <div class="">
            <input type="text" class="form-control" id="name" name="namedoc" >
    </div>
  </div>
 
 <div class="form-group">
    <label for="publish-year" class=" control-label">Рік видання</label>
    <div class="">
	     <div class="form-inline">
			 
			    <div id="sandbox-container">
				  	<div class="input-daterange input-group" id="datepicker">
				    <input type="text" class="input-sm form-control" name="dateFrom" />
				    <span class="input-group-addon"> по </span>
				    <input type="text" class="input-sm form-control" name="dateTo" />
				</div>
		
			</div>
    </div>
  </div>

   <div class="form-group">
    <label for="lang" class=" control-label">Мова</label>
    <div class="">
      <select name="lang" class="form-control" >
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
    </div>
  </div>

   <div class="form-group">
    <label for="typedoc" class=" control-label">Вид документа</label>
    <div class="">
    <select name="doctype"  class="form-control">
				<option value="0" selected="">Без обмежень</option>
		
				<?php while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		      echo '<option value="'.$row['code'].'">'.$row['name'].'</option> ';
				} ?>
			</select>

    </div>
  </div>

   <div class="form-group">
    <div class="-4 ">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="el_copy"> Електронная копія
        </label>
      </div>
    </div>
  </div>

	<div class="form-group">
	 <label for="typedoc" class=" control-label">Навчальні дисципліни</label>
		<div class="-2 "">
				<select name="discipline" size="8" class="form-control"  >
					<option value="0" selected="">Без обмежень</option>
					<?php while( $row = sqlsrv_fetch_array( $discipline, SQLSRV_FETCH_ASSOC) ) {
			      echo '<option value="'.$row['id'].'">'.$row['name'].'</option> ';
					} ?>
			</select>
		</div>
	</div>
	   <div class="form-group">
    <label for="per_page" class=" control-label">Кількість результатів на сторінку</label>
    <div class="">
      <select name="per_page" class="form-control" >
		<option value="20" selected="">20</option>
		<option value="50">50</option>
		<option value="100">100</option>
	</select>
    </div>
  </div>
  <div class="form-group">

    <div class=" ">
     <button type="submit" class="btn btn-success submit-search">Вибрати</button>
	<button type="button" class="btn btn-primary">Очистити</button>
    </div>
  </div>

  </div>
  
</form>
<hr>
				<div class="search-result">	

	
				</div>


						</div><!-- .entry-content -->
			</div><!-- .inside-article -->
</article>
<script>
jQuery(document).ready(function(){

	var options_title = {

  url: function(phrase) {
    return hneu.url;
  },

  getValue: function(element) {
    return element.name;
  },
  list: {
		match: {
			enabled: true
		}
	},
template: {
		type: "description",
		fields: {
			description: "author"
		}
	},
  ajaxSettings: {
    method: "POST",
    data: {
      "action": "wp_ajax_get_title",
    }
  },

  preparePostData: function(data) {
    data.phrase = jQuery("#name").val();
    return data;
  },

  requestDelay: 400
};
	var options_author = {

  url: function(phrase) {
    return hneu.url;
  },

  getValue: function(element) {
    return element.author;
  },
  list: {
		match: {
			enabled: true
		}
	},
	

  ajaxSettings: {
    method: "POST",
    data: {
      "action": "wp_ajax_get_author",
    }
  },

  preparePostData: function(data) {
    data.phrase = jQuery("#author").val();
    return data;
  },

  requestDelay: 10
};

	jQuery("#name").easyAutocomplete(options_title);
	jQuery("#author").easyAutocomplete(options_author);

})
</script>
<script>
	jQuery('#sandbox-container .input-daterange').datepicker({
    endDate: "today",
    format: 'yyyy',
    startView: 2,
    minViewMode: 2,
    maxViewMode: 2,
    todayBtn: "linked",
    clearBtn: true,
    language: "uk",
    multidate: false,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    beforeShowDay: function (date){
                  if (date.getMonth() == (new Date()).getMonth())
                    switch (date.getDate()){
                      case 4:
                        return {
                          tooltip: 'Example tooltip',
                          classes: 'active'
                        };
                      case 8:
                        return false;
                      case 12:
                        return "green";
                  }
                },
    beforeShowYear: function (date){
                  if (date.getFullYear() == 2007) {
                    return false;
                  }
                },
    toggleActive: true
});
</script>
<!-- end  my custom code block-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 

do_action('generate_sidebars');
get_footer();