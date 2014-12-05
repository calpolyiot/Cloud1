var ip = "192.168.1.7/sensor";

$(document).ready(function(){
    var devices = [];
    var i = 0;

    $("#header-icon").width($("#header-icon").height());
    
    $("#dialog").dialog({
	autoOpen: false
    });
    
    $(".dropdown").prop("selectedIndex", -1);

    $("#button1").click(function(){
        $("#dialog").dialog("open");
    });

    $("#button2").click(function(){
      $("#dialog").dialog("open");
    });

    $("#button3").click(function(){
      $("#dialog").dialog("open");
    });
    
    $("#generate-code").click(function(){
      $("#code-text").append("Code GetCode(void *codeSet, int code) {<br/>   int i, j;<br/>   CodeSet *set = (CodeSet *)codeSet;<br/>   CodeEntry *entries = (CodeEntry *)set->codes;<br/><br/>   if (entries[code].numUses == 0) {<br/>      CodeEntry *index = entries + code;<br/><br/>      for (i = 1; index != NULL && index->prefix != NULL; i++)<br/>         index = index->prefix;<br/><br/>      entries[code].block.data = (UChar *) calloc(i, 1);<br/>      entries[code].block.size = i--;<br/>      index = entries + code;<br/><br/>      while (i >= 0) {<br/>         entries[code].block.data[i--] = index->final;<br/>         index = index->prefix;<br/>      }<br/><br/>   }<br/>   entries[code].numUses = 1;<br/><br/>   return entries[code].block;<br/>}");

      FB.api('/me/feed','post', {message: "I'm on Cloud1"},
    	function(response) {
          // handle the response
	}
      );

    });
    
    $("#add-device").click(function(){
      var name = $("#name").val();
      var type = $("#device").val();
      var ip = $("#ip").val();
      
      devices[i++] = name;
      
      $("#my-devices ul").append("<li>" + name + "</li>");
      $("project-device-master").append($('<option></option>').val(name).html(name));
      
      $("#name").val('');
      $("#ip").val('');
      
      $(this).closest('.ui-dialog-content').dialog('close'); 
    });
});


//FACEBOOK


// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '484782094998179',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  FB.login(function(){
    FB.api('/me/feed', 'post', {message: "I'm on Cloud1"});
  }, {scope: 'publish_actions'});

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

