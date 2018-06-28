

function validateField(element)
{
  //alert("called 2");
  var eventsource = $("#"+element.id);
  var regex,errmsg;
  switch(element.id)
  {
    case 'fullname':
      regex = /^['a-zA-Z\.'\s]{6,60}$/;
      //regex=/^([a-zA-Z]{2,})(\s|\-)([a-zA-Z]{2,})?(\s|\-)?([a-zA-Z]{2,})?$/;
      errmsg = "First Name should contain Characters and spaces Only!";
      $label = "First Name";
      validate(eventsource,regex,errmsg,$label);
    break;
    case 'empnumber':
      regex =/^[0-9]{3,4}$/;
      errmsg = "Employee Number Should Contain 3 or 4 digits";
      $label = "Employee Number";
      validate(eventsource,regex,errmsg,$label);
    break;
    case 'email':
      regex=/^\w\d*[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;
      errmsg = "Enter valid email address";
      $label = "E-mail";
      validate(eventsource,regex,errmsg,$label);
    break;
    case 'contact':
      regex=/^\d{10}$/;
      errmsg = "Mobile Number should contain 10 digits";
      $label = "Mobile Number";
      validate(eventsource,regex,errmsg,$label);
    break;
    case 'password':
      regex=/^.{6,14}$/;
      errmsg ="Length of Password must be  greater then 6 and less then 14";
      $label = "Password";
      validate(eventsource,regex,errmsg,$label);
    break;
    default:
  }
}
function validate(eventsource,regex,errmsg,$label)
{
  var val = eventsource.val();

  if(val == "")
  {
    eventsource.parentsUntil('.form-group').removeClass('has-success');
    eventsource.parentsUntil('.form-group').addClass('has-error');
    eventsource.next('span').addClass('glyphicon-warning-sign');
    eventsource.parent().next('.validation-error').html($label+" Field is Required");
    eventsource.next('span').removeClass('glyphicon-ok');
    return false;
  }
  else if(regex.test(val))
  {
    eventsource.parentsUntil('.form-group').removeClass('has-error');
    eventsource.next('span').removeClass('glyphicon-warning-sign');
    eventsource.parentsUntil('.form-group').addClass('has-success');
    eventsource.next('span').addClass('glyphicon-ok');
    eventsource.parent().next('.validation-error').html(null);
    return true;
  }
  else
  {
    eventsource.parentsUntil('.form-group').removeClass('has-success');
    eventsource.parentsUntil('.form-group').addClass('has-error');
    eventsource.next('span').addClass('glyphicon-warning-sign');
    eventsource.parent().next('.validation-error').html(errmsg);
    eventsource.next('span').removeClass('glyphicon-ok');
    return false;
  }
}
function validate_pwd()
{
  var pwd=$("#password").val();
  var cpwd=$("#cpassword").val();
  if(pwd.localeCompare(cpwd)==0)
  {
      $("#cpassword").parentsUntil('.form-group').removeClass('has-error');
      $("#cpassword").next('span').removeClass('glyphicon-warning-sign');
      $("#cpassword").parentsUntil('.form-group').addClass('has-success');
      $("#cpassword").next('span').addClass('glyphicon-ok');
      $("#cpassword").parent().next('.validation-error').html(null);
  }
  else
  {
    $("#cpassword").parentsUntil('.form-group').removeClass('has-success');
    $("#cpassword").parentsUntil('.form-group').addClass('has-error');
    $("#cpassword").next('span').addClass('glyphicon-warning-sign');
    $("#cpassword").parent().next('.validation-error').html("Password And Confirm Password Should be same");
    $("#cpassword").next('span').removeClass('glyphicon-ok');
  }
}
