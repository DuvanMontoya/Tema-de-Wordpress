<?php
if (!defined('ABSPATH')) { exit; }
if (post_password_required()) { return; }
?>
<section id="comentarios" class="comentarios">
  <?php if (have_comments()) : ?>
  <h2>
      <?php
        $count = get_comments_number();
        printf(_n('%s Comentario', '%s Comentarios', $count, 'academia-pro'), number_format_i18n($count));
      ?>
    </h2>
  <ol class="lista-comentarios">
      <?php
        wp_list_comments([
          'style' => 'ol',
          'avatar_size' => 48,
          'short_ping' => true,
          'reply_text' => __('Responder','academia-pro')
        ]);
      ?>
    </ol>
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
  <nav class="navegacion-comentarios">
        <?php paginate_comments_links(); ?>
      </nav>
    <?php endif; ?>
  <?php endif; ?>
  <?php if (!comments_open() && get_comments_number()) : ?>
    <p><?php _e('Los comentarios están cerrados.','academia-pro'); ?></p>
  <?php endif; ?>
  <?php comment_form([
    'title_reply' => __('Deja un comentario','academia-pro'),
    'comment_notes_before' => '',
    'comment_field' => '<p><label for="comment" class="oculto">' . __('Comentario','academia-pro') . '</label><textarea id="comment" name="comment" rows="6" required></textarea></p>',
    'class_submit' => 'boton'
  ]); ?>
</section>
