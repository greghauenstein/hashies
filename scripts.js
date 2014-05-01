$('.nav-tabs li').on('click', function(event) {
    $('.nav-tabs li').removeClass('active'); // remove active class from tabs
    $(this).addClass('active'); // add active class to clicked tab
});

$(document).ready(function() {

var MaxInputs       = 3; //maximum input boxes allowed
var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
var AddButton       = $("#AddMoreFileBox"); //Add button ID

var x = InputsWrapper.length; //initlal text box count
var FieldCount=1; //to keep track of text box added

$(AddButton).click(function (e)  //on add input button click
{
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++; //text box added increment
            //add input box
            $(InputsWrapper).append('<div class="screenshot_url row"><div class="col-sm-11"><input class="form-control" type="text" name="screenshot[]" id="screenshot_'+ FieldCount +'" placeholder="http://" /></div><div class="col-sm-1"><a href="#" class="removeclass"><i class="fa fa-ban"></i></a></div></div>');
            x++; //text box increment
        }
return false;
});

$("body").on("click",".removeclass", function(e){ //user click on remove text
        if( x > 1 ) {
                $(this).parent('div.screenshot_url').remove(); //remove text box
                x--; //decrement textbox
        }
return false;
}) 

});