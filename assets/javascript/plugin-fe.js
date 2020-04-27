

$(document).ready(function () {

    // test form submit hintergrund wenn model form is saved
    submitForms = function(){
        $('#formAddContact')[0].checkValidity();
        document.getElementById("formAddContact").submit();
        document.getElementById("feCapture").submit();

    }

    $("#tester").on("click", function () {
        // Navigate previous
        submitForms();
        return true;
    });
// ende submit test

    // Set selected theme on page refresh
    $("#theme_selector").change();


    // set form to readonly if data is locked
    if ($("#feCapture").data("is-locked") === 1) {

        $("#feCapture :input").attr("disabled", true);
        $("#addContact, #sbmBtn, .rm-if-confirmed").remove();


    }



    // Step show event
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //alert("You are on step "+stepNumber+" now");
        if (stepPosition === 'first') {
            $("#prev-btn").addClass('disabled');
        } else if (stepPosition === 'final') {
            $("#next-btn").addClass('disabled');
        } else {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
        }
    });

    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info')
        .on('click', function () {
            alert('Finish Clicked');
        });
    var btnCancel = $('<button></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function () {
            $('#smartwizard').smartWizard("reset");
        });


    // set current step id when not in session storage
    if (typeof sessionStorage['step_id'] === 'undefined') {
        sessionStorage['step_id'] = 0;
    }

    // Smart Wizard
    var wizz = $('#smartwizard').smartWizard({
        selected: sessionStorage['step_id'],
        keyNavigation: false,
        theme: 'arrows',
        transitionEffect: 'fade',
        showStepURLhash: false,
        cycleSteps: true,
        toolbarSettings: {
            showNextButton: false,
            showPreviousButton: false,
            toolbarPosition: 'bottom',
            toolbarButtonPosition: 'end'
        },
        anchorSettings: {
            enableAllAnchors: 'true',
            removeDoneStepOnNavigateBack: 'true'
        }
    });


    // save current step to session storage
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {

        sessionStorage['step_id'] = stepNumber;

    })


    // External Button Events
    $("#reset-btn").on("click", function () {
        // Reset wizard
        $('#smartwizard').smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function () {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function () {
        // Navigate next
        $('#smartwizard').smartWizard("next");
        return true;
    });

    $("#theme_selector").on("change", function () {
        // Change theme
        $('#smartwizard').smartWizard("theme", $(this).val());
        return true;
    });


});


// ---------------------------------------------------------------------------
// "How to complete"-Tooltips
$(document).ready(function () {


    $('[data-toggle="tooltip"]').addClass('toolTip');
    $('[data-toggle="tooltip"]').tooltip();
});

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

/*


    $("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
// stepDirection === 'forward' :- this condition allows to do the form validation
// only on forward navigation, that makes easy navigation on backwards still do the validation when going next
        if (stepDirection === 'forward' && elmForm) {

            elmForm.validator('validate');

            var elmErr = elmForm.children('.has-error');
            var elmDanger = elmForm.children('.has-error');

            if (elmErr && elmErr.length > 0 || elmDanger && elmErr.length > 0) {
// Form validation failed
                alert(elmErr.length);
                return false;


            }
        }
        return true;
    });
*/


    //$('#modal-add-contact').modal('show')
});


