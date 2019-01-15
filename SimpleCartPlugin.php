<?php

/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Eric C. Weig, 2018
 * @package SimpleCart
 */

/**
 * SimpleCart plugin class
 *
 * @copyright Eric C. Weig, 2018
 * @package SimpleCart
 */
// Define Constants.
define('SIMPLE_CART_PAGE_PATH', 'cart/');
define('SIMPLE_CART_PAGE_TITLE', 'Cart');
define('SIMPLE_CART_PAGE_INSTRUCTIONS', 'Include an introduction for the page here.');
define('SIMPLE_CART_PAGE_INSTRUCTIONS_TWO', 'Include additional instructions for the page here.');
define('SIMPLE_CART_PAGE_SHOW_REQUEST', 'Include initial request text for add to requests tab here.');
define('SIMPLE_CART_PAGE_SHOW_BUTTON_TEXT', 'Add Interview to Cart');
define('SIMPLE_CART_PAGE_ACCEPT_TERMS_BUTTON_TEXT', 'I accept');
define('SIMPLE_CART_PAGE_DECLINE_TERMS_BUTTON_TEXT', 'I do not accept');
define('SIMPLE_CART_PAGE_PROCEED_BUTTON_TEXT', 'proceed to checkout');
define('SIMPLE_CART_PAGE_CBROWSE_LINK_TEXT', '<< continue browsing');
define('SIMPLE_CART_PAGE_CRETURN_LINK_TEXT', 'return to cart');
define('SIMPLE_CART_PAGE_HTERMS_LINK_TEXT', 'Terms of Use');
define('SIMPLE_CART_PAGE_HREQUEST_LINK_TEXT', 'Cart | Request Details');
define('SIMPLE_CART_PAGE_SHOW_AGREEMENT', 'Include agreement here.');
define('SIMPLE_CART_PAGE_CLICKTHRU_AGREEMENT', 'Include clickthru agreement here.');
define('SIMPLE_CART_ADD_TO_MAIN_NAVIGATION', 1);


class SimpleCartPlugin extends Omeka_Plugin_AbstractPlugin
{
    // Define Hooks
    protected $_hooks = array(
        'install',
        'uninstall',
        'define_routes',
        'config_form',
        'config',
        'public_head',
        'public_header',
        'public_items_show'
    );

    //Add filters
    protected $_filters = array(
        'public_navigation_main'
    );

   public function hookInstall()
    {
        set_option('simple_cart_page_title', SIMPLE_CART_PAGE_TITLE);
        set_option('simple_cart_page_instructions', SIMPLE_CART_PAGE_INSTRUCTIONS);  
        set_option('simple_cart_page_instructions_two', SIMPLE_CART_PAGE_INSTRUCTIONS_TWO);  
        set_option('simple_cart_page_show_request', SIMPLE_CART_PAGE_SHOW_REQUEST);    
        set_option('simple_cart_page_show_button_text', SIMPLE_CART_PAGE_SHOW_BUTTON_TEXT);    
        set_option('simple_cart_page_show_agreement', SIMPLE_CART_PAGE_SHOW_AGREEMENT);      
        set_option('simple_cart_page_clickthru_agreement', SIMPLE_CART_PAGE_CLICKTHRU_AGREEMENT);  
        set_option('simple_cart_add_to_main_navigation', SIMPLE_CART_ADD_TO_MAIN_NAVIGATION); 
        set_option('simple_cart_page_accept_terms_button_text', SIMPLE_CART_PAGE_ACCEPT_TERMS_BUTTON_TEXT);
        set_option('simple_cart_page_decline_terms_button_text', SIMPLE_CART_PAGE_DECLINE_TERMS_BUTTON_TEXT);
        set_option('simple_cart_page_proceed_button_text', SIMPLE_CART_PAGE_PROCEED_BUTTON_TEXT);
        set_option('simple_cart_page_cbrowse_link_text', SIMPLE_CART_PAGE_CBROWSE_LINK_TEXT);
        set_option('simple_cart_page_creturn_link_text', SIMPLE_CART_PAGE_CRETURN_LINK_TEXT);
        set_option('simple_cart_page_hterms_link_text', SIMPLE_CART_PAGE_HTERMS_LINK_TEXT);
        set_option('simple_cart_page_hrequest_link_text', SIMPLE_CART_PAGE_HREQUEST_LINK_TEXT);
    }

    public function hookUninstall()
    {
        delete_option('simple_cart_page_title');
        delete_option('simple_cart_page_instructions');
        delete_option('simple_cart_page_instructions_two');
        delete_option('simple_cart_page_show_request');
        delete_option('simple_cart_page_show_button_text');
        delete_option('simple_cart_page_show_agreement');
        delete_option('simple_cart_page_clickthru_agreement');
        delete_option('simple_cart_add_to_main_navigation');  
        delete_option('simple_cart_page_accept_terms_button_text');
        delete_option('simple_cart_page_decline_terms_button_text');
        delete_option('simple_cart_page_proceed_button_text');
        delete_option('simple_cart_page_cbrowse_link_text');
        delete_option('simple_cart_page_creturn_link_text');
        delete_option('simple_cart_page_hterms_link_text');
        delete_option('simple_cart_page_hrequest_link_text');
    }


    function hookDefineRoutes($args)
    {
        $router = $args['router'];
        $router->addRoute(
            'simple_cart_form_form', 
            new Zend_Controller_Router_Route(
                SIMPLE_CART_PAGE_PATH, 
                array('module'       => 'simple-cart')
            )
        );

    }

    public function hookConfigForm() 
    {
        include 'config_form.php';
    }

    public function hookConfig($args)
    {
        $post = $args['post'];
        set_option('simple_cart_page_title', $post['cart_page_title']);
        set_option('simple_cart_page_instructions',$post['cart_page_instructions']);
        set_option('simple_cart_page_instructions_two',$post['cart_page_instructions_two']);
        set_option('simple_cart_page_show_request',$post['cart_page_show_request']);        
        set_option('simple_cart_page_show_button_text',$post['cart_page_show_button_text']);        
        set_option('simple_cart_page_show_agreement',$post['cart_page_show_agreement']);     
        set_option('simple_cart_page_clickthru_agreement',$post['cart_page_clickthru_agreement']);
        set_option('simple_cart_add_to_main_navigation', $post['add_to_main_navigation']);
        set_option('simple_cart_page_accept_terms_button_text',$post['cart_page_accept_terms_button_text']);
        set_option('simple_cart_page_decline_terms_button_text',$post['cart_page_decline_terms_button_text']);
        set_option('simple_cart_page_proceed_button_text',$post['cart_page_proceed_button_text']);
        set_option('simple_cart_page_cbrowse_link_text',$post['cart_page_cbrowse_link_text']);
        set_option('simple_cart_page_creturn_link_text',$post['cart_page_creturn_link_text']);
        set_option('simple_cart_page_hterms_link_text',$post['cart_page_hterms_link_text']);
        set_option('simple_cart_page_hrequest_link_text',$post['cart_page_hrequest_link_text']);
    }
    
    public function hookPublicHead($args){
        queue_js_file('language-en');
	    queue_js_file('aeoncart');
	    queue_css_file('simplecart'); 
    }
    
    public function hookPublicHeader($args){
        echo "  <div id=\"cartstatus\">\n";
      //  echo "  <i class=\"fas fa-shopping-cart\">\n";
        echo "  <script>GetTotal();</script>\n";
        echo "  <script>\n";
        echo "  function cartReload() {";
        echo "  location.reload();";
        echo "  }";
        echo "  </script>\n";

        echo "  </i>\n";
        echo "  </div>\n";
        echo "  <iframe name=\"hiddenFrame\" src=\"/cart\" class=\"hideiframe\"></iframe>";
    }
    
    public function hookPublicItemsShow($args){
        $req_title = metadata('item', array('Dublin Core', 'Title'));
        $req_int_accession = metadata('item', array('General','Interview Accession'));
        $req_int_date = metadata('item', array('General','Interview Date'));
        $req_int_coll = metadata('item', ('Collection Name'));
        $req_identifier = strip_formatting(metadata('item', array('Dublin Core', 'Identifier')));
        $req_restriction = strip_formatting(metadata('item', array('Dublin Core', 'Rights')));
        $req_int_usage = strip_formatting(metadata('item', array('Rights', 'Interview Usage')));
        $req_int_rights = strip_formatting(metadata('item', array('Rights', 'Interview Rights')));
        $req_identifier = str_replace("%3A/",":/",$req_identifier);
        $req_int_url = "/$req_identifier";
        $cart_add_to_button_text = get_option('simple_cart_page_show_button_text');
        $cart_add_to_request_text = get_option('simple_cart_page_show_request');
        $cart_add_to_agreement_text = get_option('simple_cart_page_show_agreement');

        echo "<p>$req_int_usage</p>";
        echo "<p>$req_int_rights</p>";
        echo "  $cart_add_to_request_text\n";
        echo "  <form name=\"order\" action=\"/requests\" onsubmit=\"AddToCart(this);\" target=\"hiddenFrame\" onclick=\"cartReload()\" id=\"cart_form\">\n";
        echo "  <input type=\"hidden\" name=\"QUANTITY\" value=\"1\">\n";
        echo "  <input type=\"submit\" id=\"cartaddto\" value=\"$cart_add_to_button_text\">\n";
        echo "  <input type=\"hidden\" name=\"NAME\" value=\"$req_title\"\>\n";
        echo "  <input type=\"hidden\" name=\"ID_NUM\" value=\"$req_int_accession\">\n";
        echo "  <input type=\"hidden\" name=\"RESTRICTION\" value=\"$req_restriction\">\n";
        echo "  <input type=\"hidden\" name=\"DATE\" value=\"$req_int_date\">\n";
        echo "  <input type=\"hidden\" name=\"LINK\" value=\"$req_int_url\">\n";
        echo "  <input type=\"hidden\" name=\"PROJECT\" value=\"$req_int_coll\">\n";
        echo "  </form>\n";
        echo "  <br>\n";

        echo "    $cart_add_to_agreement_text\n";

    }

    public function filterPublicNavigationMain($nav)
    {
        $cart_title = get_option('simple_cart_page_title');
        $cart_add_to_navigation = get_option('simple_cart_add_to_main_navigation');
        if ($cart_add_to_navigation) {
                $nav[] = array(
                    'label'   => $cart_title,
                    'uri'     => url(array(),'simple_cart_form_form'),
                    'visible' => true
                );
        }
        return $nav;
    }
}
