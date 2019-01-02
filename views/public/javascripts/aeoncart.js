//Options:
VarDivider            = '&';
DisplayNotice         = false;
CallNum               = 'CallNumber_';
ItemDate              = 'ItemDate_';
ItemTitle             = 'ItemTitle_';
ItemProject           = 'ItemSubtitle_';
ProjectDesc           = 'ItemInfo4_';
SpecialReq            = 'SpecialRequest_';
Format                = 'Format_';
ServiceLevel          = 'ServiceLevel_';
URL                   = 'ItemInfo2_';
InfoURL               = '';
InfoRestrict          = 'ItemInfo1_';
ItemAuthor            = 'ItemAuthor=';

OutputItemId           = 'ID_';
OutputItemQuantity     = 'QUANTITY_';
OutputItemDate         = 'DATE_';
OutputItemName         = 'NAME_';
OutputItemLink         = 'LINK_';
OutputItemProject      = 'PROJECT_';
OutputItemAddtlInfo    = 'RESTRICTION_';
AppendItemNumToOutput  = true;
HiddenFieldsToCheckout = false;

if ( !bLanguageDefined ) {
   strSorry  = "I'm Sorry, your list is full, please proceed and submit.";
   strAdded  = "added";
   strRemove = "Click 'Ok' to remove this photograph from your list.";
   strRButton= "Remove";
   strReqButton = "Request";
   bLanguageDefined = true;
}

function CKquantity(checkString) {
   var strNewQuantity = "";

   for ( i = 0; i < checkString.length; i++ ) {
      ch = checkString.substring(i, i+1);
      if ( (ch >= "0" && ch <= "9") || (ch == '.') )
         strNewQuantity += ch;
   }

   if ( strNewQuantity.length < 1 )
      strNewQuantity = "1";

   return(strNewQuantity);
}

function AddToCart(thisForm) {
   var iNumberOrdered = 0;
   var bAlreadyInCart = false;
   var notice = "";
   iNumberOrdered = GetCookie("NumberOrdered");

   if ( iNumberOrdered === null )
      iNumberOrdered = 0;

   if ( thisForm.ID_NUM === null )
      strID_NUM    = "";
   else
      strID_NUM    = thisForm.ID_NUM.value;

   if ( thisForm.QUANTITY === null )
      strQUANTITY  = "1";
   else
      strQUANTITY  = thisForm.QUANTITY.value;

   if ( thisForm.DATE === null )
      strDATE     = "0.00";
   else
      strDATE     = thisForm.DATE.value;

   if ( thisForm.NAME === null )
      strNAME      = "";
   else
      strNAME      = thisForm.NAME.value;

   if ( thisForm.LINK === null )
      strLINK  = "0.00";
   else
      strLINK  = thisForm.LINK.value;

   if ( thisForm.PROJECT === null )
      strPROJECT  = "0.00";
   else
      strPROJECT  = thisForm.PROJECT.value;

   if ( thisForm.RESTRICTION === null )
      strRESTRICTION    = "";
   else
      strRESTRICTION    = thisForm.RESTRICTION.value;

   //Is this interview already in the list?  If so, increment quantity instead of adding another.
   for ( i = 1; i <= iNumberOrdered; i++ ) {
      NewOrder = "Order." + i;
      database = "";
      database = GetCookie(NewOrder);

      Token0 = database.indexOf("|", 0);
      Token1 = database.indexOf("|", Token0+1);
      Token2 = database.indexOf("|", Token1+1);
      Token3 = database.indexOf("|", Token2+1);
      Token4 = database.indexOf("|", Token3+1);
      Token5 = database.indexOf("|", Token4+1);
      Token6 = database.indexOf("|", Token5+1);

      fields = new Array([]);
      fields[0] = database.substring( 0, Token0 );
      fields[1] = database.substring( Token0+1, Token1 );
      fields[2] = database.substring( Token1+1, Token2 );
      fields[3] = database.substring( Token2+1, Token3 );
      fields[4] = database.substring( Token3+1, Token4 );
      fields[5] = database.substring( Token4+1, Token5 );
      fields[6] = database.substring( Token5+1, Token6 );

      if ( fields[0] == strID_NUM &&
           fields[2] == strDATE  &&
           fields[3] == strNAME
         ) {
         bAlreadyInCart = true;
         dbUpdatedOrder = strID_NUM    + "|" +
                          (parseInt(strQUANTITY)+parseInt(fields[1]))  + "|" +
                          strDATE     + "|" +
                          strNAME      + "|" +
                          strLINK  + "|" +
                          strPROJECT  + "|" +
                          strRESTRICTION;
         strNewOrder = "Order." + i;
         DeleteCookie(strNewOrder, "/");
         SetCookie(strNewOrder, dbUpdatedOrder, null, "/");
         notice = strQUANTITY + " " + strNAME + strAdded;
         break;
      }
   }

   if ( !bAlreadyInCart ) {
      iNumberOrdered++;

      if ( iNumberOrdered > 10 )
         alert( strSorry );
      else {
         dbUpdatedOrder = strID_NUM    + "|" + 
                          strQUANTITY  + "|" +
                          strDATE     + "|" +
                          strNAME      + "|" +
                          strLINK  + "|" +
                          strPROJECT  + "|" +
                          strRESTRICTION;

         strNewOrder = "Order." + iNumberOrdered;
         SetCookie(strNewOrder, dbUpdatedOrder, null, "/");
         SetCookie("NumberOrdered", iNumberOrdered, null, "/");
         notice = strQUANTITY + " " + strNAME + strAdded;
      }
   }

   if ( DisplayNotice )
      alert(notice);
}

function getCookieVal (offset) {
   var endstr = document.cookie.indexOf (";", offset);

   if ( endstr == -1 )
      endstr = document.cookie.length;
   return(unescape(document.cookie.substring(offset, endstr)));
}

function FixCookieDate (date) {
   var base = new Date(0);
   var skew = base.getTime();

   date.setTime (date.getTime() - skew);
}

function GetCookie (name) {
   var arg = name + "=";
   var alen = arg.length;
   var clen = document.cookie.length;
   var i = 0;

   while ( i < clen ) {
      var j = i + alen;
      if ( document.cookie.substring(i, j) == arg ) return(getCookieVal (j));
      i = document.cookie.indexOf(" ", i) + 1;
      if ( i == 0 ) break;
   }

   return(null);
}

function SetCookie (name,value,expires,path,domain,secure) {
   document.cookie = name + "=" + escape (value) +
                     ((expires) ? "; expires=" + expires.toGMTString() : "") +
                     ((path) ? "; path=" + path : "") +
                     ((domain) ? "; domain=" + domain : "") +
                     ((secure) ? "; secure" : "");
}

function DeleteCookie (name,path,domain) {
   if ( GetCookie(name) ) {
      document.cookie = name + "=" +
                        ((path) ? "; path=" + path : "") +
                        ((domain) ? "; domain=" + domain : "") +
                        "; expires=Thu, 01-Jan-70 00:00:01 GMT";
   }
}

function RemoveFromCart(RemOrder) {
   if ( confirm( strRemove ) ) {
      NumberOrdered = GetCookie("NumberOrdered");
      for ( i=RemOrder; i < NumberOrdered; i++ ) {
         NewOrder1 = "Order." + (i+1);
         NewOrder2 = "Order." + (i);
         database = GetCookie(NewOrder1);
         SetCookie (NewOrder2, database, null, "/");
      }
      NewOrder = "Order." + NumberOrdered;
      SetCookie ("NumberOrdered", NumberOrdered-1, null, "/");
      DeleteCookie(NewOrder, "/");
      location.href=location.href;
   }
}

function ClearCart(RemOrder) {
   if ( ( strRemove ) ) {
      NumberOrdered = GetCookie("NumberOrdered");
      for ( i=RemOrder; i < NumberOrdered; i++ ) {
         NewOrder1 = "Order." + (i+1);
         NewOrder2 = "Order." + (i);
         database = GetCookie(NewOrder1);
         SetCookie (NewOrder2, database, null, "/");
      }
      NewOrder = "Order." + NumberOrdered;
      SetCookie ("NumberOrdered", 0, null, "/");
      DeleteCookie(NewOrder, "/");
      location.href=location.href;
   }
}

function RemoveAll() {
   ClearCart(2);
   ClearCart(3);
   ClearCart(4);
   ClearCart(5);
   ClearCart(6);
   ClearCart(7);
   ClearCart(8);
   ClearCart(9);
   ClearCart(10);
   ClearCart(11);
}

QueryString.keys = new Array();
QueryString.values = new Array();
function QueryString(key) {
   var value = null;
   for (var i=0;i<QueryString.keys.length;i++) {
      if (QueryString.keys[i]==key) {
         value = QueryString.values[i];
         break;
      }
   }
   return value;
} 

function QueryString_Parse() {
   var query = window.location.search.substring(1);
   var pairs = query.split("&"); for (var i=0;i<pairs.length;i++) {
      var pos = pairs[i].indexOf('=');
      if (pos >= 0) {
         var argname = pairs[i].substring(0,pos);
         var value = pairs[i].substring(pos+1);
         QueryString.keys[QueryString.keys.length] = argname;
         QueryString.values[QueryString.values.length] = value;
      }
   }
}

//GET TOTAL

function GetTotal() {
   var strOutput2      = "";   //String to be written to page
   iNumberOrdered = GetCookie("NumberOrdered");
   if ( iNumberOrdered == null )
      iNumberOrdered = 0;
      
      if ( iNumberOrdered > 0 )
      strOutput2 = "<span><a href=\"/cart\">&nbsp;" + iNumberOrdered + "&nbsp;interviews</a></span>";
       document.write(strOutput2);
}

//MANAGE CART 

function ManageCart() {
   var iNumberOrdered = 0;    //Number of products ordered
   var strOutput      = "";   //String to be written to page
   var bDisplay       = true; //Whether to write string to the page (here for programmers)

   iNumberOrdered = GetCookie("NumberOrdered");
   if ( iNumberOrdered === null )
      iNumberOrdered = 0;


   if ( iNumberOrdered > 0 )
      strOutput = 
       "<span class=\"int_use\"><p><span style=\"color:#000000;font-size:-1;float:left;\"><label style=\"font-weight:normal;\" for=\"ServiceLevel\">Intended Use (<span style=\"color:red;\">required</span>):&nbsp;&nbsp;<select class=\"fa-request-reproductions-input\" id=\"fa-service-level\" name=\"ServiceLevel\" required onchange=\"enableButton()\"><option value=\"\">Select one</option><option value=\"Broadcast\">Broadcast</option><option value=\"Commercial/For-profit\">Commercial/For-profit</option><option value=\"Documentary\">Documentary</option><option value=\"Educational/Non-profit\">Educational/Non-profit</option><option value=\"Other\">Other</option><option value=\"Personal Use\">Personal Use</option><option value=\"Press/Journalism/Public Relations\">Press/Journalism/Public Relations</option><option value=\"Print Publication\">Print Publication</option><option value=\"Social Media\">Social Media</option></select></label></span></p><br/><br/>" +
                  "<p><span style=\"color:#000000;\">Project Description: (Provide details about how the interview will be used in your project).</span><br/><textarea rows=\"2\" cols=\"50\" id=\"ItemInfo4\" name=\"ItemInfo4\"></textarea></p>" +
                  "<p><span style=\"color:#000000;\">Special Request: (Indicate any special requirements)</span><br/><textarea rows=\"2\" cols=\"50\" id=\"SpecialRequest\" name=\"SpecialRequest\"></textarea></p></span>" +    
                         
      "<form id=\"spokedb\" class=\"fa-request-fieldset\" action=\"https://requests-libraries.uky.edu/logon\" method=\"post\" target=\"_blank\">" +
                  "<input type=\"hidden\" name=\"RequestType\" value=\"Copy\">" +
                  "<input type=\"hidden\" name=\"AeonForm\" value=\"EADRequest\">" +
                  "<input type=\"hidden\" id=\"ItemTitle\" name=\"FormDataField\" value=\"Nunn Center Interviews\">" +
                  "<input type=\"hidden\" name=\"SkipOrderEstimate\" value=\"Yes\">" +
                  "<input type=\"hidden\" id=\"GroupRequestsByLocation\" name=\"FormDataField\" value=\"Yes\">" +
                  "<input type=\"hidden\" id=\"GroupingIdentifier\" name=\"FormDataField\" value=\"ItemVolume\">" +
                  "<input type=\"hidden\" id=\"GroupingOption_ItemTitle\" name=\"FormDataField\" value=\"FirstValue\">";

   if ( iNumberOrdered == 0 ) {
      strOutput += "<p><span style=\"color:#337ab7;\">There are no interviews in your list.</span></p><style>#defaultClosed {display:none;}#form-instructions {display:none;}</style><br/>";
   }

   for ( i = 1; i <= iNumberOrdered; i++ ) {
      NewOrder = "Order." + i;
      database = "";
      database = GetCookie(NewOrder);

      Token0 = database.indexOf("|", 0);
      Token1 = database.indexOf("|", Token0+1);
      Token2 = database.indexOf("|", Token1+1);
      Token3 = database.indexOf("|", Token2+1);
      Token4 = database.indexOf("|", Token3+1);
      Token5 = database.indexOf("|", Token4+1);
      Token6 = database.indexOf("|", Token5+1);

      fields = new Array;
      fields[0] = database.substring( 0, Token0 );                 // Accession
      fields[1] = database.substring( Token0+1, Token1 );          // Quantity
      fields[2] = database.substring( Token1+1, Token2 );          // Date
      fields[3] = database.substring( Token2+1, Token3 );          // Interview Name
      fields[4] = database.substring( Token3+1, Token4 );          // Link
      fields[5] = database.substring( Token4+1, Token5 ); // Project
      fields[6] = database.substring( Token5+1, database.length ); // Restriction

      var restrictStr = fields[6];
      var titleStr = fields[3];

function myLevel() {
    var xlevel = document.getElementsByName("ServiceLevel")[0].value;
}

      if ( iNumberOrdered > 0 ) {

         if ( fields[6] == "" )
            strOutput += "<input type=\"hidden\" name=\"Request\" value=\""+ fields[0] + "\">&nbsp;&nbsp;"  + titleStr + "_" + fields[0] + "<br/><br/>";
         else
            strOutput += 
           
            "<div class=\"divTable\"><div class=\"divTableBody\"><div class=\"divTableRow\"><div class=\"divTableCell\"><input type=\"hidden\" name=\"Request\" value=\""+ fields[0] + "\" checked>&nbsp;&nbsp;"  + titleStr + "&nbsp;&nbsp;" + "-" + fields[6] + "<br/><br/>" +
                         "<input type=\"hidden\" name=\""+ ItemDate + fields[0] + "\" value=\"" + fields[2] + "\">" +
                         "<input type=\"hidden\" name=\""+ URL + fields[0] + "\" value=\"" + InfoURL  + fields[4] + "\">" +
                         "<input type=\"hidden\" name=\""+ ItemTitle + fields[0] + "\" value='" + titleStr + "'>" +
                         "<input type=\"hidden\" name=\""+ InfoRestrict + fields[0] + "\" value=\"" + fields[6] + "\">" +
                         "<input type=\"hidden\" name=\""+ Format + fields[0] + "\" value=\"Oral History Interview\">" +
                         "<input type=\"hidden\" name=\""+ ServiceLevel + fields[0] + "\" onchnage=\"myLevel()\" required=\"required\">" +
                         "<input type=\"hidden\" name=\""+ ItemProject + fields[0] + "\" value=\"" + fields[5] + "\">" +
                         "<input type=\"hidden\" name=\""+ CallNum + fields[0] + "\" value=\"" + fields[0] + "\">" + 
                         "</div><div class=\"divTableCell\"><input type=\"reset\" value=\"X\" onClick=\"RemoveFromCart("+i+")\"></div></div></div></div>";

      }

   }

   if ( iNumberOrdered > 0 )
            strOutput += "<span class=\"int_use\"><div id=\"sendrequest\" class=\"spokedb-request-hidden\"><br/><!--<input type=\"button\" value=\"Clear List\" id=\"cartsubmit\" onClick=\"RemoveAll()\">--><input type=\"hidden\" name=\"SubmitButton\" value=\"Submit Request\"/><input id=\"cartsubmit\" type=\"submit\" onclick=\"RemoveAll()\" /></div>" +
                          "<br/><br/><br/></span><br/>" +
                     
                         "</form><p><span id=\"intlimit\" style=\"color:#337ab7;font-size:-1;float:right;\">*This list only holds up to 10 interviews.</span></p>";
   
   document.write(strOutput);
     
   document.close();

}
