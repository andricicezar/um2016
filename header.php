<?php function print_navbar($isFirstPage) { ?>
  <nav class="navbar <?php echo ($isFirstPage?"navbar-style":"") ?>" id="main-navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
          Meniu
        </button>
        <a class="navbar-brand" href="http://liis.ro/~moisil2016"><img src="<?php echo get_template_directory_uri(); ?>/images/sigla-mica.png" alt="Urmasii lui Moisil 2016" title="Urmasii lui Moisil 2016" /></a>
      </div>

      <div class="collapse navbar-collapse navbar-right" id="navbar-collapse-1">
        <?php wp_nav_menu(array(
          'menu' => 'Meniu Principal',
          'container' => '',
          'menu_class' => 'nav navbar-nav'
        )); ?>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
<?php } ?>



<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes() ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes() ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes() ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes() ?>><!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title( '|', true, 'right' ) ?> Urmasii lui Moisil 2016</title>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-75025352-1', 'auto');
      ga('send', 'pageview');
    </script>

    <?php wp_head() ?>
  </head>

  <body <?php body_class() ?>>

    <?php if (is_front_page()): ?>
      <section class="container full-size">
        <div class="image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/sigla-mare.jpg" alt="Urmasii lui Moisil 2016" title="Urmasii lui Moisil 2016" />
        </div>

        <div class="menu">
          <?php if (have_posts()) { the_post(); ?>
            <div class="alert alert-info" role="alert"><?php the_content(); ?></div>
          <?php } ?>

          <?php echo print_navbar(true); ?>
        </div>
      </section>
  <?php else: ?>
    <?php echo print_navbar(false); ?>
  <?php endif; ?>
