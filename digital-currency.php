<?php
/**
 * @package WP Digital Currency
 * @version 1.0
 */
/*
Plugin Name: WP Digital Currency
Plugin URI: https://wordpress.org/plugins/wp-digital-currency/
Description: A WordPress plugin to display digital currency market prices.
Author: ~
Version: 1.0
Author URI: #
Text Domain: wp-digital-currency
*/

if(!defined('ABSPATH'))exit;

add_shortcode('major_currencies','wpdc_currencies_shortcode');

function wpdc_currencies_shortcode(){
  
  $data='https://api.coinmarketcap.com/v1/ticker/?limit=10';
  $data=file_get_contents($data);
  $data=json_decode($data, true);
  $html.='<div class="row" style="border-top:1px solid gainsboro;">
    <div class="col">#</div>
    <div class="col">Name</div>
    <div class="col">Market Cap</div>
    <div class="col">Price</div>
    <div class="col">Circulating  Supply</div>
    <div class="col">Volume (24h)</div>
    <div class="col">% Change (24h)</div>
    <!--<div class="col">Price Graph (7d)</div>-->
  </div>';
  foreach($data as $key){
    $html.='<div class="row">
      <div class="col">'.$key[rank].'</div>
      <div class="col">'.$key[name].'</div>
    </div>';
  }
  //$html='<pre>'.print_r($data,true).'</pre>';
  return $html;
  
}

wp_register_style('Gridly','https://cdnjs.cloudflare.com/ajax/libs/gridly/1.1.0/gridly-core.min.css');
wp_enqueue_style('Gridly');

?>