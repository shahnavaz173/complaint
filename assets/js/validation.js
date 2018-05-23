function validateField(element)
{
  var eventsource = $("#"+element.id);
  var regex,errmsg;
  switch(element.id)
  {
    case 'fullname':
      regex=/^([a-zA-Z]{2,})(\s|\-)([a-zA-Z]{2,})?(\s|\-)?([a-zA-Z]{2,})?$/;
      errmsg = "Name is invalid";
      validate(eventsource,regex,errmsg);
    break;
    case 'empnumber':
      regex =/^[0-9]{3,4}$/;
      errmsg = "Employee Number Should Contain 3 or 4 digits";
      validate(eventsource,regex,errmsg);
    break;
    case 'email':
      regex=/^\w\d*[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;
      errmsg = "Enter valid email address";
      validate(eventsource,regex,errmsg);
    break;
    case 'contact':
      regex=/^\d{10}$/;
      errmsg = "Mobile number should contain only digits";
      validate(eventsource,regex,errmsg);
    break;
    case 'password':
      regex=/^.{6,14}$/;
      errmsg ="Password must be between 6 to 14 characters ";
      validate(eventsource,regex,errmsg);
    break;
    default:
  }
}
function validate(eventsource,regex,errmsg)
{
  var val = eventsource.val();
  if(regex.test(val))
  {
    eventsource.parentsUntil('.form-group').removeClass('has-error');
    eventsource.next('span').removeClass('glyphicon-warning-sign');
    eventsource.parentsUntil('.form-group').addClass('has-success');
    eventsource.next('span').addClass('glyphicon-ok');
    eventsource.parent().next('.validation-error').html(null);
  }
  else
  {
    eventsource.parentsUntil('.form-group').removeClass('has-success');
    eventsource.parentsUntil('.form-group').addClass('has-error');
    eventsource.next('span').addClass('glyphicon-warning-sign');
    eventsource.parent().next('.validation-error').html(errmsg);
    eventsource.next('span').removeClass('glyphicon-ok');
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
    $("#cpassword").parent().next('.validation-error').html("password does not match");
    $("#cpassword").next('span').removeClass('glyphicon-ok');
  }
}
