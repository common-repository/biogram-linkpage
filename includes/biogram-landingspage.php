<?php
/*
 * Template Name: Biogram Linkpage
 * Template Post Type: page
 */

get_header();

?>
<style type="text/css">
.biogram-content .content {
  color: <?php the_field('tekstkleur'); ?>;
}

.biogram-content .buttons .button {
  color: <?php the_field('button_tekstkleur'); ?>;
  border-radius: <?php the_field('button_radius'); ?>px;
}

<?php if( get_field('button_schaduw') ): ?>
  
  .biogram-content .buttons .button {
    -webkit-box-shadow: 0px 1px 10px 1px rgba(0,0,0,0.2);
    -moz-box-shadow: 0px 1px 10px 1px rgba(0,0,0,0.2);
    box-shadow: 0px 1px 10px 1px rgba(0,0,0,0.2); 
  }
  
<?php endif; ?>

<?php if( get_field('button_rand') ): ?>
  
  .biogram-content .buttons .button {
    border-style: solid;
    border-width: <?php the_field('dikte_van_rand'); ?>px;
    border-color: <?php the_field('kleur_van_rand'); ?>;
  }
  
<?php endif; ?>

.biogram-content .buttons .button:hover {
  color: <?php the_field('button_tekstkleur_hover'); ?>;
  background-color: <?php the_field('buttonkleur_hover'); ?> !important;
}

.biogram-content .buttons .button .highlight {
  width: 30px;
  height: 30px;
  border-radius: 15px;
  position: absolute;
  right: -15px;
  top: 17px;
  color: #fff;
  background-color: <?php the_field('kleur_uitlichten'); ?>;
}

</style>

<div class="biogram-content" style="background-image:url('<?php $bimage = get_field('achtergrondafbeelding'); if( !empty($bimage) ): echo $bimage['url']; endif; ?>');">

  <div class="logo">
    <img src="<?php $logo = get_field('logo'); if(!empty($logo)) : echo $logo['url']; endif; ?>">
  </div>
  <div class="content"><?php the_content(); ?></div>

    <?php if( have_rows('links') ): ?>

    <div class="buttons">

      <?php while( have_rows('links') ): the_row(); 

        $name = get_sub_field('naam');
        $url = get_sub_field('url');
        $kleur = get_sub_field('kleur_button');
        $uitlichten = get_sub_field('uitlichten');

      ?>

        <?php if( $url ): ?>
          <a class="button" href="<?php echo $url; ?>" target="_blank" style="background-color: <?php echo $kleur; ?>;">
        <?php endif; ?>
          <?php echo $name; ?>
        <?php if( $url ): ?>
          <?php if( $uitlichten ): ?>
              <div class="highlight">!</div>
          <?php endif; ?>
          </a>
        <?php endif; ?>

      <?php endwhile; ?>

    </div>

    <?php endif; ?>

  <?php if( get_field('juist_logo_weergeven') ): ?>
    <div class="juist">
      <?php if( get_field('juist_logo') == 'wit'  ): ?>
        <a href="https://juist.nl/insta-link-in-bio/"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'assets/images/juist-wit.png'?>"></a>
      <?php endif; ?>
      <?php if( get_field('juist_logo') == 'blauw'  ): ?>
        <a href="https://juist.nl/insta-link-in-bio/"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'assets/images/juist-blauw.png'?>"></a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

</div>

<?php get_footer(); ?>