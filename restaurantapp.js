$(document).ready(function() {
    $(".addguest").click(function(e){ //on add input button click
        e.preventDefault();
        var wrapper_name = e.target.id + "-n";
        var wrapper_name_next_element_num = $("#" + wrapper_name + ' input').length +1;
        var wrapper_origin = e.target.id + "-o";
        var wrapper_origin_next_element_num = $("#" + wrapper_origin + ' select').length +1;
        $("#" + wrapper_name).append('<p><input type="text" id="' + wrapper_name + wrapper_name_next_element_num + '" name="' + wrapper_name + wrapper_name_next_element_num + '" class="form-control"></p>'); //add input box
        $("#" + wrapper_origin).append('<p><select id="' + wrapper_origin + wrapper_origin_next_element_num + '" name="' + wrapper_origin + wrapper_origin_next_element_num + '" class="form-control">' + '</select></p>'); //add select box
    });
});
