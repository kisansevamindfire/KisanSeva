$(document).ready(function (){
    myCaptcha();

    $("#refresh").click(function () {
        myCaptcha();
    });
        $("#submit").click(function () {
			validate();
        });
       
});
function validate()
{
	
            $("#alertUser").html(null);
            var firstName = $.trim($("#firstName").val());
            var msg = "";
            if (firstName.length === 0)
            { msg += "please enter firstname<br>"; }
            var lastName =  $.trim($("#lastName").val());
            if (lastName.length === 0)
            { msg += "please enter lastname<br>"; }

            var dateOfBirth = validateDateOfBirth();
            if (dateOfBirth === false)
            { msg += "please enter Date Of Birth<br>"; }
            else if (age < 0)
                msg += "please enter Date Of Birth<br>";
            var genderCheck = $("input[name='gender']:checked").val();
            if (!genderCheck)
                msg += "please enter gender<br>";
            console.log(genderCheck);
            var email = validateEmail();
            if (email === false)
                msg += "please enter valid email id<br>";
            var password = ($('#password').val());
            if (password.length < 6)
            {
                msg += "Please Enter atleast 6 characters password<br>";
            }
            var confirmPassword = $('#confirmPassword').val();
            if (confirmPassword !== password&&password!=="")
                msg += "Password mismatch<br>";
            
            
            var phone = $('#phone').val();
            if (phone.length != 10 && !isNaN(phone))
                msg += "Please enter 10 digit phone number<br>";

            var currentAddress = $('#currentAddress').val();
            var currentState=$('#currentState').val();
            var currentCountry=$('#currentCountry').val();
            if (currentAddress === "" || currentState === "default" || currentCountry === "default")
                msg += "please Enter full current Address<br>";
            var alternatePhone=$('#alternatePhone').val();
            if (alternatePhone.length !== 10 && isNaN(alternatePhone) || alternatePhone.length > 0 && alternatePhone.length <10 )
            { alternatePhone="-";
                msg += "please enter 10 digit number(alternatePhone)<br>";}
            var alternateAddress = $('#alternateAddress').val();
            var alternateState = $('#alternateState').val();
            var alternateCountry = $('#alternateCountry').val();
            if (alternateAddress === "" && alternateState === "default" && alternateCountry === "default") {
                msg += "";
                alternateAddress = "";
                alternateState = "";
                alternateCountry = "";
            }
            else if (alternateAddress === "" || alternateState === "default" || alternateCountry === "default") {
                msg += "please Enter full Alternate Address<br>";
                alternateAddress = "";
                alternateState = "";
                alternateCountry = "";
            } else
                msg += "";
            var captcha = parseInt($('#userResult').val());
            console.log(result);
            if (captcha !== result)
            { msg += "Captcha Mismatch<br>"; }

            if (msg === "")
            {
                msg += "Name : " + firstName + " " + lastName + "<br>"+
                 "Age : " + age + "<br>"+
               "Gender : "+genderCheck+"<br>"+ 
                "Email : " + $('#email').val() + "<br>"+ 
                "Phone number : " + phone + "<br>"+ 
                "Current Address : " + currentAddress + "," + currentState + "," + currentCountry + "<br>"+ 
                "Alternate Phone : " + alternatePhone + "<br>"+ 
                "Alternate Address : " + alternateAddress + "," + alternateState + "," + alternateCountry + "<br>";

                
            }

            $("#alertUser").append(msg);
}
    function validateDateOfBirth() {
       // var flag = 0;// counter variable to check error
        var dateOfBirth = $('#dateOfBirth').val();
        var day;
        var month;
        var year;
        var temp2;
        var temp1;
        if (dateOfBirth.value === "") {
            return false;
        } else {
            temp1 = dateOfBirth.indexOf('/');
            if (temp1 > 2 || !temp1) {
                return false;
            }
            else {
                temp2 = temp1;
                day = dateOfBirth.slice(0, temp2);
                temp1 = dateOfBirth.lastIndexOf('/');
                if (temp1 > 5 || !temp1) {
                    return false;
                }
                else {
                    

                    month = dateOfBirth.slice(temp2 + 1, temp1);
                    year = dateOfBirth.slice(temp1 + 1, dateOfBirth.length);
                    if (year.length === 4) {
                        age = ageCalculate(day, month, year);
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            }
        }
    }


    function ageCalculate(day, month, year) {

        var todayDate = new Date();
        var todayYear = todayDate.getFullYear();
        var todayMonth = todayDate.getMonth();
        var todayDay = todayDate.getDate();
        var Age = todayYear - year;

        if (todayMonth < (month) && (todayDay < day)) {
            Age--;

        }


        return Age;

    }

    var result;
 function myCaptcha() {
     var first = parseInt(Math.floor((Math.random() * 99) + 1));
     var second =  parseInt(Math.floor((Math.random() * 39) + 1));
     var operator = ["+","-", "*", "/"];
     var operation = operator[Math.floor(Math.random()*3)];
     if (operation === "+")
     { result = first + second; }
     else if (operation === "-"){
         result = first - second;
     }
     else if (operation === "/") {
    if (first % second !== 0) {
             myCaptcha();
         }
         else
             result = (first / second);;
     }

     else if (operation === "*")
     { result = first * second; }
     $("#captcha").text(first + ' ' + operation + ' ' + second + " =");

 }

 function validateEmail() {
     var email = $('#email').val();
     if (email === "") {
         return false;
     }
     else {
         var reg = /\w+@\w+[.]\w+$/;
         if (reg.test(email)) {
             return true;
         }
         else {
             return false;
         }
     }
 }