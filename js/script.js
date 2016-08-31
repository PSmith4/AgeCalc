
window.addEventListener("load", startup,false);
function startup(){
	myform= document.forms[0];
	myform.addEventListener("submit", formCheck,false);	
$( "#birthday" ).datepicker({ changeYear: true ,dateFormat: 'dd/mm/yy'});
$("#ResultOutput").hide();
}

function formCheck(e) {
	var warning = "";
	e.preventDefault();
	console.log("outputting");
	//check first name has something
	if ($("#name").val()=="")
	 {
		 warning=warning+"You haven't entered you name. <br/>";
	 }
	
	if ($("#birthday").val()=="")
	{
		warning=warning+"You haven't entered you birthday <br/>";
	}
	console.log(warning);
	if (warning =="")
	{
		var date = new Date();
		var birthday = $("#birthday").val()
		
		var DOBSplit= birthday.split('/');
		var DOB_asDate=new Date(DOBSplit[1]+'/'+DOBSplit[0]+'/'+DOBSplit[2]);
		$("#birthday").val(Math.floor(DOB_asDate.getTime()/1000)); // Turn into unix time for php reciving
		console.log(birthday);
		console.log(DOB_asDate);
		console.log(date);
	
		var dif= date-DOB_asDate
		var age = $("<input>").attr({
									type: 'hidden',
									id:   'ageRecorded',
									name:   'ageRecorded',
									value: Math.ceil(dif/1000/60/60/24)}) //convert back from millsec to days
								.appendTo('#AgeForm');
		date = $("<input>").attr({
							type: 'hidden',
							id: 'timestamp',
							name: 'timestamp',
							value: Math.floor(date.getTime()/1000)}) // turn timestamp into an input for sending to server. Also save it as a second count since unix timestamp
							.appendTo('#AgeForm');
		
		
		$("#ResultOutput").text("You have been alive "+age.val()+ " days.");
		
		var $form = $('form');
		$form.submit( function (){	 console.log(  $.post($(this).attr({action: 'sqlinsert.php'})); );
		return false;
		});
		
		$("#birthday").val(birthday); // put birthday back to date formate
		//myform.submit();
	}
	else
	{
		$("#ResultOutput").html(warning);
	}
	$("#ResultOutput").show();
 }
