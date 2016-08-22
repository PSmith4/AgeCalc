import { Template } from 'meteor/templating';
import { ReactiveVar } from 'meteor/reactive-var';
import {Requests} from '../DB/Collection/Requests.js';
import './main.html';


Template.AgeCalc.onRendered(
function () {
                this.$('#datetimepicker1').datetimepicker( {
					viewMode: 'years', format: 'DD/MM/YYYY'
				});
				$('#ResultOutput').hide();
            }
			
);
Template.AgeCalc.onCreated(
function datepickerOnCreated(){
	this.age = new ReactiveVar(0);

}
);
Template.AgeCalc.helpers({
  age() {
	  console.log('looking for age');
    return Template.instance().age.get();
  },
});

Template.AgeCalc.events({
	'submit #AgeForm'(event,instance){

	console.log('asdf');
	event.preventDefault();
	var name=$('#name').val();
	var DOB=$('#datetimepicker1 .form-control').val();
	var DOBSplit= DOB.split('/');
	var DOB_asDate=new Date(DOBSplit[1]+'/'+DOBSplit[0]+'/'+DOBSplit[2]);
	var date=new Date();
	console.log(name);

	console.log(DOB);
	console.log(DOB_asDate);
	console.log(date);
	
	var dif= date-DOB_asDate
	instance.age.set(Math.ceil(dif/1000/60/60/24)); //convert back from millsec to days
	console.log(instance.age.get());
	//values.forEach(function(input){
	//	console.log(input.value);
	//})
	if (!isNaN(dif)){
		$('#ResultOutput').show();
		Requests.insert({Name:name,  Age:instance.age.get(), Birthday:DOB, createdAt: date});
	}
	
	},
});

Template.databaseList.helpers({
	lists() {return Requests.find({}, { sort: { createdAt: -1 } } );
	},
});


Router.route('', function () {
this.render('AgeCalc')	});
Router.route('/requestView', function () {
	this.render('databaseList')	
});
