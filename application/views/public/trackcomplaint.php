
<div class="container-track">
   <div class="row">
     <div class="col-md-10 col-md-offset-1" style="background-color:#ECE7E7;padding-top:1em;padding-bottom:2em; box-shadow:0px 0px 7px 0px #000;" >
			 <div class="col-md-6 col-md-offset-3" style="padding-top:1em;padding-bottom:2em;">
         <h3 style="color:#555"><b>Your Complaint Status and other Details</b></h3>
       </div>
			 <div class="card col-md-5 col-md-offset-1" style="box-shadow:0px 0px 5px 0px #000;background-color:#fbfaf9;">
         <div class="container">
            <h4 class="text-info"><b>Complaint Description :</b></h4>
            <p><?=$cdetails[0]->c_description;?></p>
            <h4 class="text-info"><b>Complaint type :</b></h4>
            <p><?=$cdetails[0]->category;?></p>
            <h4 class="text-info"><b>Location : </b></h4>
            <p><?=$cdetails[0]->location;?></p>
            <h4 class="text-info"><b>Date :</b></h4>
            <p><?=$cdetails[0]->c_date;?></p>
         </div>
       </div>
       <?php
       switch($cdetails[0]->c_status)
       {
         case 1:
           $status = "Open";
         break;
         case 2:
           $status = "Pending";
         break;
         case 3:
           $status = "Under Observation";
         break;
         case 4:
           $status = "Closed But Not Complete";
         break;
         case 5:
           $status = "Closed";
         break;
       }
       ?>
			 <div class="card col-md-5 col-md-offset-1" style="box-shadow:0px 0px 5px 0px #000;background-color:#fbfaf9;">
         <div class="container">
            <h4 class="text-info"><b>Complaint Status :</b></h4>
            <?php if($cdetails[0]->c_status == 1 || $cdetails[0]->c_status == 2): ?>
              <p class="text-danger"><?=$status;?></p>
            <?php elseif($cdetails[0]->c_status == 3 || $cdetails[0]->c_status == 4): ?>
              <p class="text-warning"><?=$status;?></p>
            <?php else: ?>
              <p class="text-success"><?=$status;?></p>
            <?php endif; ?>
            <h4 class="text-info"><b>Solution Date :</b></h4>
            <?php
              if($cdetails[0]->s_date == NULL)
                echo "<p class='text-danger'>Not Solved</p>";
              else
                echo $cdetails[0]->s_date;
            ?>
            <h4 class="text-info"><b>Assigned To :</b></h4>
            <p><?php
              if($cdetails[0]->w_name == NULL)
                echo "Not Assigned";
              else
                echo $cdetails[0]->w_name;
            ?></p>
            <h4 class="text-info"><b>Ph No :</b></h4>
            <p><?php
              if($cdetails[0]->w_name == NULL)
                echo "Not Available";
              else
                echo $cdetails[0]->ph_no;
            ?></p>

         </div>
       </div>
     </div>
  </div>
 </div>
