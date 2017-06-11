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
  
  $data='https://api.coinmarketcap.com/v1/ticker/?limit=36';
  $data=file_get_contents($data);
  $data=json_decode($data, true);
  $html.='
    <style>
      #wpdc-headers{
        border-top:1px solid gainsboro;
      }
      #wpdc-headers .col{
        font-weight:bold;
      }
      #wpdc-rows{
        border-top:1px solid silver;
      }
    </style>
    <div class="row" id="wpdc-headers">
      <p>
        <div class="col">#</div>
        <div class="col">Name</div>
        <div class="col">Market Cap</div>
        <div class="col">Price</div>
        <div class="col">Circulating  Supply</div>
        <div class="col">Volume (24h)</div>
        <div class="col">% Change (24h)</div>
        <!--<div class="col">Price Graph (7d)</div>-->
      </p>
    </div>';
  foreach($data as $key){
    $html.='<div class="row" id="wpdc-rows">
      <p>
        <div class="col">'.$key[rank].'</div>
        <div class="col">'.$key[name].'</div>
        <div class="col usd">'.$key[market_cap_usd].'</div>
        <div class="col usd">'.$key[price_usd].'</div>
        <div class="col">'.$key[available_supply].'</div>
        <div class="col usd">'.$key['24h_volume_usd'].'</div>
        <div class="col">'.$key['percent_change_24h'].'</div>
      </p>
    </div>';
  }
  //$html='<pre>'.print_r($data,true).'</pre>';
  $html.='
    <script>
      jQuery(".usd").autoNumeric("init",{currencySymbol:"$"});
    </script>
  ';
  return $html;
  
}

wp_register_style('Gridly','https://cdnjs.cloudflare.com/ajax/libs/gridly/1.1.0/gridly-core.min.css');
wp_enqueue_style('Gridly');

function wpdc_enqueue_styles_1(){wp_enqueue_script('jQuery');}
wp_register_script('autoNumeric','https://cdn.jsdelivr.net/autonumeric/2.0.0/autoNumeric.min.js');
function wpdc_enqueue_styles_2(){wp_enqueue_script('autoNumeric');}

add_action('wp_enqueue_scripts','wpdc_enqueue_styles_1', 10 );
add_action('wp_enqueue_scripts','wpdc_enqueue_styles_2', 14 );

?>