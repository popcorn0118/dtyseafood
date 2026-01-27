<?php 

/* =================================

   首頁最新消息區塊（最新三篇）

  "<?php require get_theme_file_path( 'inc/custom-mews-block.php' ); ?>"
  "[astra_custom_layout id=5889]"

 * ================================== */


if ( ! defined( 'ABSPATH' ) ) exit;

$q = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);

if ( ! $q->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>

<section class="home-news" aria-label="最新消息">
    <div class="home-news__container">

        <div class="home-news__grid">
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                <article class="home-news__card">
                   

                        <div class="home-news__thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('large', [
                                    'class'   => 'home-news__img',
                                    'loading' => 'lazy',
                                    'decoding'=> 'async',
                                ]); ?>
                            <?php else : ?>
                                <div class="home-news__img-placeholder" aria-hidden="true"></div>
                            <?php endif; ?>
                        </div>

                        <div class="home-news__body">
                            <h4 class="home-news__card-title"><?php the_title(); ?></h4>

                            <div class="home-news__excerpt">
                                <?php
                                // 摘要：有 excerpt 用 excerpt，沒有就抓內容裁切
                                $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 200, '' );
                                echo esc_html( $excerpt );
                                ?>
                            </div>

                            <a class="home-news__link" href="<?php the_permalink(); ?>">
                                Read More
                            </a>
                        </div>

                    
                </article>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>
