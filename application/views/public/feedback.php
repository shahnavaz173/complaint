<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/emoji.css'); ?>" />
<div class="container-feedback">
   <div class="row">
     <div class="col-md-10 col-md-offset-1" style="background-color:#ECE7E7;padding-top:1em;padding-bottom:2em; box-shadow:0px 0px 7px 0px #000;" >
       <div class="col-md-10 col-md-offset-1" style="padding-bottom:1em">
         <h3 style="color:#333"><b>Your Complaint for Fan Repairing Has Been Solved. Please Give Us Feedback for improve Our service</b></h3>
       </div>
       <div class="card col-md-10 col-md-offset-1" style="box-shadow:0px 0px 5px 0px #000;background-color:#fbfaf9;">
         <div class="container">
           <form id="smileys" action="Feedback/submit" method="post">
             <div class="col-md-12">
               <h3 class=  "text-info"><b>1. Is your Complaint Solved in Time? </b></h3>
                <div class="col-md-2">
                  <center>
                    <input type="radio" name="time" value="happy" class="happy" checked="checked">
                    <h5><b>In 24 Hours</b></h5>
                  </center>
                </div>
                <div class="col-md-2 col-md-offset-1">
                <center>
                  <input type="radio" name="time" value="neutral" class="neutral">
                  <h5><b>In 48 Hours</b></h5>
                </center>
                </div>
                <div class="col-md-2 col-md-offset-1">
                  <center>
                    <input type="radio" name="time" value="sad" class="sad">
                    <h5><b>More Then 48 Hours</b></h5>
                  </center>
                </div>
              </div>
              <div class="col-md-12" style="padding-top:2em">
                <h3 class=  "text-info"><b>2. Are You Satisfy with Our work? </b></h3>
                 <div class="col-md-2">
                   <center>
                     <input type="radio" name="work" value="happy" class="happy" checked="checked">
                     <h5><b>Excellent</b></h5>
                   </center>
                 </div>
                 <div class="col-md-2 col-md-offset-1">
                 <center>
                   <input type="radio" name="work" value="neutral" class="neutral">
                   <h5><b>Good</b></h5>
                 </center>
                 </div>
                 <div class="col-md-2 col-md-offset-1">
                   <center>
                     <input type="radio" name="work" value="sad" class="sad ">
                     <h5><b>Bad</b></h5>
                   </center>
                 </div>
               </div>
               <div class="col-md-5" style="padding-top:2em;padding-bottom:3em">
                 <button alt="submit"type="submit" class="btn  btn-info" name="submit"  />Click to Send Your Feedback <i class="glyphicon glyphicon-send"></i>  </button>
               </div>
            </form>
         </div>
       </div>
     </div>
  </div>
 </div>
