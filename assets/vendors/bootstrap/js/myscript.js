function check(event) {
	event.preventDefault();
	if(document.forms.user_registration.name.value.length < 1 )
	{
        alert("Enter User Name");
		return false;
	}
	var n_password = document.forms.user_registration.n_pass.value;//<!--code for password validation-->
	var r_password = document.forms.user_registration.r_pass.value;
	for(var i = 0 ; i < n_password.length ; i++)
	{
		if( n_password[i] != r_password[i] ){
		alert("Password Mismatch1");
		return false;}
	}
	if( n_password.length != r_password.length ){
		alert("Password Mismatch");
		return false;
	}
	if( n_password.length < 1 || r_password.length < 1)
	{
		alert("Enter Password");
		return false;
	}
	var e_mail = document.forms.user_registration.email.value;//<!--code for email validation-->
	var at_pos = e_mail.indexOf("@");
	var dot_pos = e_mail.lastIndexOf(".");
	if ( at_pos < 1 || dot_pos < at_pos+2 || dot_pos+2 >= e_mail.length ) {
		alert("Not a valid e-mail address");
		return false;
	}
    var flag = 0;
	if(document.getElementById('gender_male').checked || document.getElementById('gender_female').checked || document.getElementById('gender_other').checked)
	{
		flag = 1;
	}
	if(flag!=1)
	{
		alert("Enter Gender");
		return false;
	}
    var b_day = document.forms.user_registration.bday.value;
	if(b_day.length < 1 )
	{
        alert("Enter BirthDay");
		return false;
	}
    if((isNaN(document.user_registration.number.value)) || (document.user_registration.number.value.length !=10))//code for pincode validation
    {
        alert("Enter Correct Mobile Number");
        return false;
    }
	if(document.forms.user_registration.Address.value.length < 1 )
	{
		alert("Enter Address");
		return false;
	}
	if((isNaN(document.user_registration.Code.value)) || (document.user_registration.Code.value.length < 6))//code for mobile number validation
    {
        alert("Enter Correct Pincode");
        return false;
    }
		table_entry();
		return true;
}
function table_entry()
{
	var myName = document.getElementById("name");
	var mail = document.getElementById("e_mail");
    var gender;
    if(document.getElementById('gender_male').checked)
	{
		gender = document.getElementById("gender_male");
	}
	else if(document.getElementById('gender_female').checked)
	{
		gender = document.getElementById("gender_female");
	}
	else{
		gender = document.getElementById("gender_other");
	}
  	var birthday = document.getElementById("b_day");
    var m_number = document.getElementById("m_number");
	var address = document.getElementById("addr");
	var pincode = document.getElementById("p_code");
	var country = document.getElementById("s_country");
	var state = document.getElementById("s_state");
    var table = document.getElementById("myTableData");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.insertCell(0).innerHTML= myName.value;
    row.insertCell(1).innerHTML= mail.value;
	row.insertCell(2).innerHTML= gender.value;
	row.insertCell(3).innerHTML= birthday.value;
    row.insertCell(4).innerHTML= m_number.value;
	row.insertCell(5).innerHTML= address.value;
	row.insertCell(6).innerHTML= pincode.value;
	row.insertCell(7).innerHTML= country.value;
	row.insertCell(8).innerHTML= state.value;
	row.insertCell(9).innerHTML='<input type="button" value = "Delete" onClick="Javacsript:deleteRow(this)">';
	row.insertCell(10).innerHTML='<input type="button" value = "Update" onClick="Javacsript:updateRow(this)">';
//	row.insertCell(11).innerHTML='<input type="button" value = "Save" onClick="Javacsript:saveRow(this)">';
}
function deleteRow(obj)
{
    var index = obj.parentNode.parentNode.rowIndex;
    var table = document.getElementById("myTableData");
    table.deleteRow(index); 
}
function updateRow(obj){
	var x=obj.parentNode.parentNode.childNodes;
	name = x[0].innerHTML;
	mail = x[1].innerHTML;
	gender = x[2].innerHTML;
	b_day = x[3].innerHTML;
	m_num = x[4].innerHTML;
	addr = x[5].innerHTML;
	p_code = x[6].innerHTML;
	country = x[7].innerHTML;
	s_state = x[8].innerHTML;
	document.forms.user_registration.name.value = name;
	document.forms.user_registration.email.value = mail;
	document.forms.user_registration.gender.value = gender;
	document.forms.user_registration.bday.value = b_day;
	document.forms.user_registration.number.value = m_num;
	document.forms.user_registration.Address.value = addr;
	document.forms.user_registration.Code.value = p_code;
	document.forms.user_registration.s_country.value = country;
	document.forms.user_registration.state.value = s_state;
	var index = obj.parentNode.parentNode.rowIndex;
	var table = document.getElementById("myTableData");
    table.deleteRow(index);
}
/*	x[0].innerHTML='<input type = "text" id = "u_name" value= '+name+'>';
	x[1].innerHTML='<input type = "text" id = "u_mail" value='+mail+'>';
	x[2].innerHTML='<input type = "text" id = "u_gender" value='+gender+'>';
	x[3].innerHTML='<input type = "text" id = "u_birthday" value='+b_day+'>';
	x[4].innerHTML='<input type = "text" id = "u_m_number" value='+m_num+'>';
	x[5].innerHTML='<input type = "text" id = "u_address" value='+addr+'>';
	x[6].innerHTML='<input type = "text" id = "u_pincode" value='+p_code+'>';
	x[7].innerHTML='<input type = "text" id = "u_country" value='+country+'>';
	x[8].innerHTML='<input type = "text" id = "u_state" value='+state+'>';
}
function saveRow(obj){
	var x=obj.parentNode.parentNode.childNodes;
    x[0].innerHTML= document.getElementById("u_name").value;
    x[1].innerHTML= document.getElementById("u_mail").value;
	x[2].innerHTML= document.getElementById("u_gender").value;
	x[3].innerHTML= document.getElementById("u_birthday").value;
    x[4].innerHTML= document.getElementById("u_m_number").value;
	x[5].innerHTML= document.getElementById("u_address").value;
	x[6].innerHTML= document.getElementById("u_pincode").value;
	x[7].innerHTML= document.getElementById("u_country").value;
	x[8].innerHTML= document.getElementById("u_state").value;
}*/
