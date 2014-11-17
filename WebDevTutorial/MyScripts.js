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