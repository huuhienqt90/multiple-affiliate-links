<?php
/*
Plugin Name: Multiple Affiliate Links
Description: A plugin make able to create multiple buy buttons for WC Product
Author: Hamilton(Hien) H.HO
Version: 1.0.0
Author URI: https://huuhienqt.dev/
*/

class MultipleAffiliateLinks
{
    /**
     * Build the instance
     */
    public function __construct()
    {
        load_plugin_textdomain( 'multiple-affiliate-links', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        add_filter( 'woocommerce_product_data_tabs', array( $this, 'addProductTab' ), 50 );
        add_action( 'woocommerce_product_data_panels', array( $this, 'addProductTabContent' ) );
        add_action( 'woocommerce_admin_process_product_object', array( $this, 'saveAffiliateSettings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'buttons' ) );
    }

    /**
     * Register and enqueue scripts
     */
    public function scripts()
    {
        wp_enqueue_script( 'zinpee-plugin-scripts', plugin_dir_url( __FILE__ ) . 'dist/js/app.js', array('jquery'), '1.0' );
        wp_enqueue_style( 'zinpee-plugin-styles', plugin_dir_url( __FILE__ ) . 'dist/css/app.css', array(), '1.0' );
    }

    /**
     * Add production if the production is external
     *
     * @param $tabs
     * @return mixed
     */
    public function addProductTab($tabs)
    {
        $tabs['zpaffiliate_type'] = array(
            'label'    => __( 'Affiliate Links', 'multiple-affiliate-links' ),
            'target' => 'zpaffiliate_type_product_options',
            'class'  => 'show_if_external',
        );

        return $tabs;
    }

    /**
     * Display production tab content
     *
     * @return void
     */
    public function addProductTabContent()
    {
        global $product_object;
        $zData = maybe_unserialize($product_object->get_meta( '_zin_pee_data', true ));
        ?>
        <div id='zpaffiliate_type_product_options' class='panel woocommerce_options_panel'>
            <div class='options_group'>
                <table class="zinpee-table" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php _e('Company', 'multiple-affiliate-links'); ?></th>
                            <th><?php _e('Price', 'multiple-affiliate-links'); ?></th>
                            <th><?php _e('Url', 'multiple-affiliate-links'); ?></th>
                            <th><?php _e('Button Text', 'multiple-affiliate-links'); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($zData && count($zData)): ?>
                        <?php $i = 0; foreach ($zData as $item): ?>
                        <tr>
                            <td>
                                <select name="zpdata[<?php echo $i; ?>][type]">
                                    <option value="lazada" <?php selected('lazada', $item['type']); ?>>Lazada</option>
                                    <option value="tiki" <?php selected('tiki', $item['type']); ?>>Tiki</option>
                                    <option value="sendo" <?php selected('sendo', $item['type']); ?>>Sendo</option>
                                    <option value="shopee" <?php selected('shopee', $item['type']); ?>>Shopee</option>
                                    <option value="dienmayxanh" <?php selected('dienmayxanh', $item['type']); ?>>Điện máy xanh</option>
                                    <option value="thegioididong" <?php selected('thegioididong', $item['type']); ?>>Thế giới di động</option>
                                </select>
                            </td>
                            <td><input type="text" name="zpdata[<?php echo $i; ?>][price]" value="<?php echo $item['price']; ?>"></td>
                            <td><input type="text" name="zpdata[<?php echo $i; ?>][url]" value="<?php echo $item['url']; ?>"></td>
                            <td><input type="text" name="zpdata[<?php echo $i; ?>][buttonText]" value="<?php echo @$item['buttonText']; ?>"></td>
                            <td style="width: 50px;"><button class="button-delete"><?php _e('Delete', 'multiple-affiliate-links'); ?></button></td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div style="padding: 0.5rem">
                    <button class="button-add" style="color: #FFF; background: #0b97c6; padding: 0.5rem; border: none; cursor: pointer;"><?php _e('Add new', 'multiple-affiliate-links'); ?></button>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Save the product data for multiple affiliate links
     *
     * @param $post
     * @return void
     */
    public function saveAffiliateSettings($post)
    {
        $price = isset( $_POST['zpdata'] ) ? serialize($_POST['zpdata'] ) : '';
        update_post_meta( $post->id, '_zin_pee_data', $price );
    }

    /**
     * Show the buttons on the add to cart button section
     *
     * @return void
     */
    public function buttons()
    {
        global $product;
        $data = maybe_unserialize($product->get_meta( '_zin_pee_data', true ));
        $buttonText = apply_filters('woocommerce_product_single_add_to_cart_text', __('Buy Now', 'multiple-affiliate-links'));
        if ($product->get_type() === 'external' && $data && count($data)) {
        ?>
        <div style="display: flex; flex-wrap: wrap; width: 100%;">
        <?php foreach ($data as $button): $url = plugin_dir_url(__FILE__). 'dist/images/'.$button['type']. '.png'; ?>
            <div style="display: flex; width: 100%; justify-content: space-between; align-content: center; align-items: center; margin-bottom: 1rem;">
                <div style="width: 120px;"><img src="<?php echo $url; ?>" alt="<?php echo $button['type']; ?>" /></div>
                <div><?php echo wc_price($button['price']) ?></div>
                <div>
                    <a href="<?php echo $button['url']; ?>" target="_blank" class="single_add_to_cart_button button alt" style="margin-bottom: 0;"><?= isset($button['buttonText']) && !empty($button['buttonText']) ? $button['buttonText'] : $buttonText ?></a>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <?php
        }
    }
}

new MultipleAffiliateLinks();