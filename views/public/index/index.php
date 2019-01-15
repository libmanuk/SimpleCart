<?php echo head(); ?>
<script>
$(document).ready(function() {
   // Executed when select is changed
    $("select").on('change',function() {
        var x = this.selectedIndex;

        if (x == "") {
           $(".spokedb-request-hidden").hide();
        } else {
           $(".spokedb-request-hidden").show();
        }
    });
    
    // It must not be visible at first time
    $(".spokedb-request-hidden").css("display","none");
});
</script>
<div id="primary">
    <div class="carttab">
        <button class="tablinks" onclick="openTab(event, 'manage_cart')" id="defaultOpen"><?php echo html_escape(get_option('simple_cart_page_creturn_link_text')); ?></button>
        <button class="tablinks" onclick="openTab(event, 'checkout')" id="defaultClosed"><?php echo html_escape(get_option('simple_cart_page_proceed_button_text')); ?></button>
    </div>

    <input type="radio" id="toggle-1" style="display:none;">


    <div id="manage_cart" class="tabcontent">
        <h1><?php echo html_escape(get_option('simple_cart_page_title')); ?></h1>
            <p><a href="javascript:history.back()">&lt;&lt; continue browsing</a></p>
            <div id="form-instructions">
                <?php echo get_option('simple_cart_page_instructions'); // HTML ?>
            </div>
    <br/>
<script>
    PreCart( );
</script>
  
    </div>


    <div id="checkout" class="tabcontent">

        <div id="clickthru">
            <h1><?php echo html_escape(get_option('simple_cart_page_hterms_link_text')); ?></h1>
            <br/>
                <label id="fortoggle" for="toggle-1"><?php echo html_escape(get_option('simple_cart_page_accept_terms_button_text')); ?></label>
                <a href="/" id="fornotoggle"><?php echo html_escape(get_option('simple_cart_page_decline_terms_button_text')); ?></a>
                <br/>
                <br/>
                    <?php echo get_option('simple_cart_page_clickthru_agreement'); // HTML ?>
        </div>

        <div id="request-details">
            <h1><?php echo html_escape(get_option('simple_cart_page_hrequest_link_text')); ?></h1>
                <div id="form-instructions">
                    <?php echo get_option('simple_cart_page_instructions_two'); // HTML ?>
                </div>


<script>
    ManageCart( );
</script>
  
        </div>

    </div>

</div> 


<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#defaultClosed').click(function(){      //Click on navigation item
      $("#defaultOpen").show();                  //Unhide this navigation item
      });
    });
</script>



<?php echo foot();
