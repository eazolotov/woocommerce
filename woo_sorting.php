// Сортировка по наличию

add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );

function custom_woocommerce_get_catalog_ordering_args( $args ) {
$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

if ( 'stock_list_asc' == $orderby_value ) {
    $args['orderby'] = 'meta_value_num wp_posts.ID';
    $args['order'] = 'ASC';
    $args['meta_key'] = '_stock';
}
elseif ( 'stock_list_desc' == $orderby_value ) {
    $args['orderby'] = 'meta_value_num wp_posts.ID';
    $args['order'] = 'DESC';
    $args['meta_key'] = '_stock';
}

return $args;
}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );

function custom_woocommerce_catalog_orderby( $sortby ) {
$sortby['stock_list_desc'] = 'Остаток: по убыванию';
$sortby['stock_list_asc'] = 'Остаток: по возрастанию';
return $sortby;
}

add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');

// Сортировка по наличию по умолчанию

function custom_default_catalog_orderby() {
     return 'stock_list_desc'; // Can also use title and price
}
