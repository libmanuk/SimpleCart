<?php echo js_tag('vendor/tinymce/tinymce.min'); ?>
<script type="text/javascript">
jQuery(window).load(function () {
    Omeka.wysiwyg({
        mode: 'specific_textareas',
        editor_selector: 'html-editor'
    });
});
</script>

<?php
$cart_page_title                      = get_option('simple_cart_page_title');
$cart_page_instructions               = get_option('simple_cart_page_instructions');
$cart_page_instructions_two               = get_option('simple_cart_page_instructions_two');
$cart_page_show_request               = get_option('simple_cart_page_show_request');
$cart_page_show_button_text               = get_option('simple_cart_page_show_button_text');
$cart_page_show_agreement               = get_option('simple_cart_page_show_agreement');
$cart_page_clickthru_agreement               = get_option('simple_cart_page_clickthru_agreement');
$add_to_main_navigation                  = get_option('simple_cart_add_to_main_navigation');
$cart_page_accept_terms_button_text                  = get_option('simple_cart_page_accept_terms_button_text');
$cart_page_decline_terms_button_text                  = get_option('simple_cart_page_decline_terms_button_text');
$cart_page_proceed_button_text                  = get_option('simple_cart_page_proceed_button_text');
$cart_page_cbrowse_link_text                  = get_option('simple_cart_page_cbrowse_link_text');
$cart_page_creturn_link_text                  = get_option('simple_cart_page_creturn_link_text');
$cart_page_hterms_link_text                  = get_option('simple_cart_page_hterms_link_text');
$cart_page_hrequest_link_text                  = get_option('simple_cart_page_hrequest_link_text');
$view = get_view();
?>


<div class="field">
    <?php echo $view->formLabel('cart_page_title', 'Cart Page Title'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_title', $cart_page_title, array('class' => 'textinput')); ?>
        <p class="explanation">
            The title of the cart page (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('add_to_main_navigation', 'Add to Main Navigation'); ?>
    <div class="inputs">
        <?php echo $view->formCheckbox('add_to_main_navigation', $add_to_main_navigation, null, array('1', '0')); ?>
        <p class="explanation">
            If checked, add a link to the cart to the main site
            navigation.
        </p>
    </div>
</div>

<h2>Interview Show Page Config</h2>

<div class="field">
    <?php echo $view->formLabel('cart_page_show_button_text', 'Button Text for Cart Request Page'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_show_button_text', $cart_page_show_button_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for request button (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_show_request', 'Request for Cart Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('cart_page_show_request', $cart_page_show_request, array('rows' => '10', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            Request text for interview show page, before the request button.
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_show_agreement', 'Agreement for Cart Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('cart_page_show_agreement', $cart_page_agreement, array('rows' => '50', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            Agreement text for interview show page, after the request button.
        </p>
    </div>
</div>


<h2>Initial View Cart Page Config</h2>

<div class="field">
    <?php echo $view->formLabel('cart_page_proceed_button_text', 'Button Text for Proceed to Cart'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_proceed_button_text', $cart_page_proceed_button_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for proceed to cart button (not HTML).
        </p>
    </div>
</div>
<div class="field">
    <?php echo $view->formLabel('cart_page_cbrowse_link_text', 'Link Text for Continue to Browse'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_cbrowse_link_text', $cart_page_cbrowse_link_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for link to continue browsing (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_instructions', 'Introduction for Cart Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('cart_page_instructions', $cart_page_instructions, array('rows' => '50', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            View Cart Page introduction text.
        </p>
    </div>
</div>


<h2>Usage Terms/Conditions Page Config</h2>

<div class="field">
    <?php echo $view->formLabel('cart_page_hterms_link_text', 'Heading Text for Cart Terms Page'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_hterms_link_text', $cart_page_hterms_link_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for request sub-page terms heading (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_accept_terms_button_text', 'Button Text for Accept Terms'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_accept_terms_button_text', $cart_page_accept_terms_button_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for accept terms button (not HTML).
        </p>
    </div>
</div>
<div class="field">
    <?php echo $view->formLabel('cart_page_decline_terms_button_text', 'Button Text for Decline Terms'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_decline_terms_button_text', $cart_page_decline_terms_button_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for decline terms button (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_clickthru_agreement', 'Agreement for Clickthru Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('cart_page_clickthru_agreement', $cart_page_clickthru_agreement, array('rows' => '50', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            Clickthru agreement text for requests page.
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_creturn_link_text', 'Link Text for Cart Request Page Return to Cart'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_creturn_link_text', $cart_page_creturn_link_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for link to return to cart (not HTML).
        </p>
    </div>
</div>


<h2>View Cart Request Page Config</h2>


<div class="field">
    <?php echo $view->formLabel('cart_page_hrequest_link_text', 'Heading Text for Cart Request Sub Page'); ?>
    <div class="inputs">
        <?php echo $view->formText('cart_page_hrequest_link_text', $cart_page_hrequest_link_text, array('class' => 'textinput')); ?>
        <p class="explanation">
            Text for request sub-page heading (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('cart_page_instructions_two', 'Introduction for Request Cart Sub Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('cart_page_instructions_two', $cart_page_instructions_two, array('rows' => '50', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            View Cart Sub Page introduction text.
        </p>
    </div>
</div>



