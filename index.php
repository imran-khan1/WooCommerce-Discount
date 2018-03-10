<?php

function ik_wc_discount_total_30() { 
    global $woocommerce;      
    $discount_total = 0; 
     
    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values) {          
    $_product = $values['data'];  
        if ( $_product->is_on_sale() ) {
        $regular_price = $_product->get_regular_price();
        $sale_price = $_product->get_sale_price();
        $discount = ($regular_price - $sale_price) * $values['quantity'];
        $discount_total += $discount;
        }  
    }             
    if ( $discount_total > 0 ) {
    echo '<tr class="cart-discount">
    <th>'. __( 'You Saved', 'woocommerce' ) .'</th>
    <td data-title=" '. __( 'You Saved', 'woocommerce' ) .' ">'
    . wc_price( $discount_total + $woocommerce->cart->discount_cart ) .'</td>
    </tr>';
    } 
} 
// Hook our values to the Basket and Checkout pages 
add_action( 'woocommerce_cart_totals_after_order_total', 'ik_wc_discount_total_30', 99);
add_action( 'woocommerce_review_order_after_order_total', 'ik_wc_discount_total_30', 99);




?>