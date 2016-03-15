<?php get_header(); ?>
    <?php if (is_page()): the_post() ?>
      <article class="container" id="page-<?php the_ID(); ?>">
        <div class="page-header">
          <h1><?php the_title(); ?></h1>
        </div>

        <?php the_content(); ?>
      </article>
    <?php else: ?>
        <p>Nothing matches your query.</p>
    <?php endif; ?>
<?php get_footer(); ?>
