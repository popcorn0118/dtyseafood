<?php 

/* =================================

   首頁｜商品分類（WooCommerce product_cat）
	- 分類圖：Woo 後台分類縮圖（thumbnail_id）
	- 標題：term name
	- 連結：get_term_link()

  "<?php require get_theme_file_path( 'inc/custom-products-categories.php' ); ?>"
  "[astra_custom_layout id=5848]"

 * ================================== */


 
if ( ! defined( 'ABSPATH' ) ) exit;

$terms = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'parent'     => 0,        // 只抓第一層分類
    'orderby'    => 'menu_order',
    'order'      => 'ASC',
]);

if ( is_wp_error( $terms ) || empty( $terms ) ) {
    return;
}
?>

<section class="home-product-categories" aria-label="商品分類">
    <div class="home-product-categories__grid">

        <?php foreach ( $terms as $term ) :

            // 排除未分類（slug = uncategorized）
            if ( $term->slug === 'uncategorized' ) {
                continue;
            }

            $link = get_term_link( $term, 'product_cat' );
            if ( is_wp_error( $link ) ) {
                continue;
            }

            // 1) 分類圖（Woo 分類縮圖）
            $thumb_id  = (int) get_term_meta( $term->term_id, 'thumbnail_id', true );
            $thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';

            ?>
            <div class="home-product-categories__card" >
                <div class="home-product-categories__inner">

                    <div class="home-product-categories__icon-wrap">
                        <?php if ( $thumb_url ) : ?>
                            <img
                                class="home-product-categories__icon"
                                src="<?php echo esc_url( $thumb_url ); ?>"
                                alt="<?php echo esc_attr( $term->name ); ?>"
                                loading="lazy"
                                decoding="async"
                            >
                        <?php else : ?>
                            <span class="home-product-categories__icon-placeholder" aria-hidden="true"></span>
                        <?php endif; ?>
                    </div>

                    <h4 class="home-product-categories__name">
                        <?php echo esc_html( $term->name ); ?>
					</h4>

                    <a href="<?php echo esc_url( $link ); ?>" class="home-product-categories__cta" aria-hidden="true">
                        查看商品
                    </a>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>