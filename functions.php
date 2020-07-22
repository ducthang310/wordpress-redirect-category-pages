/**
 * Redirect Category link
 */
add_action('wp', 'mim_redirect_page');
function mim_redirect_page() {
    $url = get_permalink(get_option('site_page_to_redirect_categories'));
    $redirect = false;

    switch (true) {
        case get_query_var('year') || get_query_var('monthnum'):
            $url .= '?mim_year=' . get_query_var('year', '');
            $url .= '&mim_monthnum=' . get_query_var('monthnum', '');
            $redirect = true;
            break;
        case get_query_var('cat'):
            $url .= '?mim_cat=' . get_query_var('cat');
            $redirect = true;
            break;
    }

    if ($redirect) {
        header("Location: $url", true, 301);
        exit;
    }
}

/**
 * Add param for filter
 * @param $vars
 * @return array
 */
function maximus_add_query_vars_filter( $vars ){
    $mim_vars = array('mim_year', 'mim_monthnum', 'mim_cat', 'solution_step');
    $vars = array_merge($vars, $mim_vars);
    return $vars;
}
add_filter( 'query_vars', 'maximus_add_query_vars_filter' );
