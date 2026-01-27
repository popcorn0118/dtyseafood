<?php 

/* =================================

   船舶日用品採購 - 新品上市（商品）

  "<?php require get_theme_file_path( 'inc/custom-products-block.php' ); ?>"
  "[astra_custom_layout id=6241]"

 * ================================== */


if ( ! defined( 'ABSPATH' ) ) exit;

$q = new WP_Query([
    'post_type'           => 'product',
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

<section class="ship-product" aria-label="最新商品">
    <div class="ship-product__container">

        <div class="ship-product__grid">
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                <?php
                $product = function_exists( 'wc_get_product' ) ? wc_get_product( get_the_ID() ) : null;
                ?>
                <article class="ship-product__card">
                   

                        <div class="ship-product__thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('large', [
                                    'class'   => 'ship-product__img',
                                    'loading' => 'lazy',
                                    'decoding'=> 'async',
                                ]); ?>
                            <?php else : ?>
                                <div class="ship-product__img-placeholder" aria-hidden="true"></div>
                            <?php endif; ?>
                        </div>

                        <div class="ship-product__body">
                            <h4 class="ship-product__card-title"><?php the_title(); ?></h4>

                            <div class="ship-product__excerpt">
                                <?php
                                // 摘要：有 excerpt 用 excerpt，沒有就抓內容裁切
                                if ( $product ) {
                                    $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( $product->get_short_description() ), 200, '' );
                                } else {
                                    $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 200, '' );
                                }
                                echo esc_html( $excerpt );
                                ?>
                            </div>

                            <?php if ( $product ) : ?>
                                <div class="ship-product__price">
                                    <?php echo wp_kses_post( $product->get_price_html() ); ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    
                </article>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>
