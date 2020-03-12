$(document).ready(function () {


    // Persistent tabs
    $('.nav-tabs-comp a').each(function () {
        $(this).click(function () {

            index = $('.nav-tabs a[href="' + $(this).attr('href') + '"]').parent().index();
            sessionStorage['tab_id'] = index;

        });

    });

    if (typeof sessionStorage['tab_id'] === 'undefined') {
        sessionStorage['tab_id'] = 0;
    }

    $('#compTabs li:eq(' + parseInt(sessionStorage['tab_id']) + ') a').tab('show'); // Select tab by name

    //  end persistant tabs


    /*  $(window).on('load',function(){
          $('#modal-add-contact').modal('show');
      });*/

//https://stackoverflow.com/questions/19978600/how-to-loop-through-elements-of-forms-with-javascript
    const forms = document.querySelectorAll('form');
    const form = forms[0];
    /*

        [...form.elements].forEach((input) => {
            var name = input.name;


            var labelText = $("input[name='" + input.name + "']").parent().find('label').text();

            var fstext = $("input[name='" + input.name + "']").closest().find('.row').html();

            fstext = $("input[name='" + input.name + "']").parent().find('.row').html();

            console.log(input.name);

            console.log($("input[name='" + input.name + "']").parent().find('label').text());
            $("#opT").append(fstext + "<br>");

            //  $("#opT").append(name + ";" + labelText + ";"+fstext +"<br>");

        });
    */


    $('.row').each(function (i, obj) {

        var ht = $(this).children("div:first").html();
        var inpname = $(this).find('select').first().attr('name');


        $("#opT").append(inpname + '; ' + ht + "<br>");
    });


});


$(function () {
        $('#compGrid').dataTable({
            "iDisplayLength": 25,

        });
    }
);

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).html()).select();
    document.execCommand("copy");
    $temp.remove();
}



// ---------------------------------------------------------------------------
// visibilities
$(document).ready(function () {


    //--
    function setStates(wrapper, targSfx, toggleWrapper) {

        $(wrapper + " input[type=checkbox]").each(function () {

            valueChanged($(this), '#' + $(this).attr('id') + targSfx);

            $($(this)).change(function () {

                valueChanged($(this), '#' + $(this).attr('id') + targSfx);

                if (typeof toggleWrapper !== 'undefined') {

                    setTgWrap($(wrapper + " input[type=checkbox]"), toggleWrapper);
                }

            });


        });

        if (typeof toggleWrapper !== 'undefined') {
            setTgWrap($(wrapper + " input[type=checkbox]"), toggleWrapper);
        }

    }

    // hide/show if accordant checkbox is unchecked/checked
    function valueChanged(togSwitch, togTarget) {

        if ($(togSwitch).is(":checked")) {

            $(togTarget).show();
            $(togTarget).removeClass('hidden');
        } else {
            $(togTarget).hide();

        }


    }

    // hide wrapper e.g. row when no accordant checkbox is checked
    function setTgWrap(cb, wrapperToToggle) {

        if ($(cb).is(':checked')) {

            $(wrapperToToggle).show();

        } else {

            $(wrapperToToggle).hide();

        }


    }


    /* show element if certain value is selected
     * var selectID = id of input select .claass or #id
     * var valSelected = required value for action
     * var showOnSelected = element .class or #id that will show when valSelected is selected
    */

    function setSelectStates(selectID, valSelected, showOnSelected) {

        $(selectID).change(function () {

            setSelectStates(selectID, valSelected, showOnSelected);

        });

        $(selectID + '  > option:selected').each(function () {

            if (parseInt($(this).val()) === valSelected) {

                $(showOnSelected).show();

            } else {

                $(showOnSelected).hide();

            }


        });

    }

    // sales model
    setStates('#modSales', 'Disc', "#discountRates");


    //is plastic card
    setStates('#isPCard', '', "#showIsPCard");


    // minimum rewquirement
    setSelectStates('#minReq', 1, '.minReqY');


    setSelectStates('#multiple_country_redeeming', 1, '#countries_redeem_in');


    // commission
    setSelectStates('#payment_model', 3, "#wrpSetCom");

    // balance check
    setSelectStates('#balanceCheck', 1, ".balanceCheck");

    // validity
    setSelectStates('#hasExpDate', 1, "#validityPeriod");

    // denominations
    setSelectStates('#fixedDenom', 0, "#denomRange");
    setSelectStates('#fixedDenom', 1, "#denomFixed");
//-----
});