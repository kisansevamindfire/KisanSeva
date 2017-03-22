var flag, userInputValue;
$(document).ready(function () {
    $("#bt3").click(function () {
        $("#bt1").slideUp(2000).slideDown(2000);
        $("#bt2").slideUp(2000).slideDown(2000);
        $("#bt3").slideUp(2000).slideDown(2000);

    });
});


$(document).ready(function () {
    $("#Submit").click(function () {
        if (!$("#FirstName").val())
        { console.log($("#FirstName").val()) }
        else { console.log($("#FirstName").val()) }
        $(".errorMessage").hide();
        userInputValue = "";
        validateRegistration();
    });
});
$(document).ready(function () {
    ValueToSelect();
    Captcha();

});
$(document).ready(function () {
    $("#refreshCaptcha").click(function () {
        Captcha();
    });

    $("#CaptchaResult").change(function () {
        ValidateCaptcha();
    });
});


function validateRegistration() {
    flag = 0; //0 false,no validation is raised. 
    //Checking if required field is filled 
    var id, msg,rqAns;
    id = $("#FirstName");
    msg = "First Name";
    required(id, msg);

    id = $("#LastName");
    msg = "Last Name";
    required(id, msg);

    id = $("#Email");
    msg = "Email Address ";
    rqAns = required(id, msg);
    if (rqAns!=true) {
        validateEmail(id, msg);
    }
    id = $("#Gender");
    msg = "Gender";
    validateSelect(id, msg)

    id = $("#Password");
    msg = "Password ";
    rqAns=required(id, msg);
    if (rqAns != true) {
        validateLength(id, 6, msg);
    }

    id = $("#ConfirmPassword");
    msg = "Confirm Password";
    rqAns=required(id, msg);
    if (rqAns != true) {
        ValidateCPassword();
    }

    id = $("#Phone1");
    msg = "Phone number";
    rqAns = required(id, msg);
    if (rqAns != true) {
        validateLength(id, 10, msg);
    }

    id = $("#BirthDate");
    msg = "Birth Date";
    required(id, msg);

    id = $("#CurrentAddress");
    msg = "Current Address";
    required(id, msg);

    id = $("#CurrentCity");
    msg = "Current City";
    required(id, msg);

    id = $("#CurrentState");
    msg = "Current State";
    validateSelect(id, msg);

    id = $("#CurrentCountry");
    msg = "Current Country";
    validateSelect(id, msg);

    ValidateCaptcha();
    Age();

    //validate Captcha

    if (flag == 0) {
        $("#ModalHeader").html("Your information");


        id = $("#FirstName").val();
        msg = "First Name";
        ModalDisplay(msg, id);

        id = $("#LastName").val();
        msg = "Last Name";
        ModalDisplay(msg, id);

        id = $("#Email").val();
        msg = "Email Address ";
        ModalDisplay(msg, id);

        id = $("#Gender").val();
        msg = "Gender";
        ModalDisplay(msg, id);

        id = $("#Phone1").val();
        msg = "Phone number";
        ModalDisplay(msg, id);

        id = $("#CurrentAddress").val();
        msg = "Current Address";
        ModalDisplay(msg, id);

        id = $("#CurrentCity").val();
        msg = "Current City";
        ModalDisplay(msg, id);

        id = $("#CurrentState").val();
        msg = "Current State";
        ModalDisplay(msg, id);

        id = $("#CurrentCountry").val();
        msg = "Current Country";
        ModalDisplay(msg, id);
        console.log(userInputValue);

        $("#ModalParagraph").html(userInputValue);
        $('#myModal').modal('toggle');
        $("#myModal").modal("show");
    }
};

//Checks if input is blank .
function required(id, msg) {
    id.parent().removeClass('has-warning');
    id.parent().addClass('has-success');

    var userInput = id.val();
    if (userInput === "") {
        flag = 1;
        id.after('<span class="errorMessage" style=" color:red;">' + msg + ' is required </span>');
        id.parent().removeClass('has-success');
        id.parent().addClass('has-warning');
        return true;

    }

};

//checks if email is correct
function validateEmail(id, msg) {

    var emailSyntax = /^\w+@\w+[.]\w+$/;
    if ($("#Email").val() !== "") {

        if (!emailSyntax.test($("#Email").val())) {
            flag = 1;
            id.after('<span class="errorMessage" style=" color:red;">Email is in wrong format </span>');
            id.parent().removeClass('has-success');
            id.parent().addClass('has-warning');
        }

    }
}
function validateLength(id, l, msg) {
    var userInput;
    userInput = id.val();
    
        if (userInput.length < l) {
            flag = 1;
            id.after('<span class="errorMessage" style=" color:red;">' + msg + ' length should be atleast ' + l + '</span>');
            id.parent().removeClass('has-success');
            id.parent().addClass('has-warning');

        }

};
function Age() {
    var ddob;
    var dob = $("#BirthDate").val();
    ddob = new Date(dob);
    var today = new Date();


    var year = today.getFullYear() - ddob.getFullYear();
    var month = today.getMonth() - ddob.getMonth();
    if (month < 0 || (month === 0 && today.getDate() < ddob.getDate())) {
        year--;
    } else
        if (year < 18) {
            flag = 1;
            console.log(year);
            alert("Sorry you need to be 18yr first");
            userInputValue = "Sorry you need to be 18yr first";
            $("#registrationForm input").prop("disabled", true);
            $("#registrationForm select").prop("disabled", true);
        }
}
function validateSelect(id, msg) {
    var userInput;
    userInput = id.val();
    id.parent().removeClass('has-warning');
    id.parent().addClass('has-success');
    if (userInput === "default") {
        flag = 1;
        id.after('<span class="errorMessage" style=" color:red;">' + msg + ' is required.</span>');
        id.parent().removeClass('has-success');
        id.parent().addClass('has-warning');
    }
}
css bhej raha hu
.affix {
            top: 0;
            width: 100%;
        }

            .affix + .container-fluid {
                padding-top: 10px;
            }
        / Set the navbar's default z-index /
        .z_Index{
             z-index:1;
        }
        / Set height of the grid so .sidenav can be 100% (adjust as needed) /
        .row.content {
            height: 450px;
        }

        / Set gray background color and 100% height /
        .sidenav {
            background-color: #f1f1f1;
        }

        / Set black background color, white text and some padding /
        footer {
            background-color: #555;
            color: white;
            padding: 5px;
        }

        / On small screens, set height to 'auto' for sidenav and grid /
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }

        .animation {
            background-color: #4de2d9;
            position: relative;
            animation-name: example;
            animation-duration: 4s;
            transform: rotateX(360deg);
        }


        / Standard syntax /
        @keyframes example {
            0% {
                left: 0;
                top: 0;
                transform: rotateY(180deg);
            }

            50% {
                left: 200px;
                top: 0;
                transform: rotateZ(180deg);
            }

            100% {
                left: 0;
                top: 0;
            }
        }
        #jumb{
            background-color:indianred;
        }