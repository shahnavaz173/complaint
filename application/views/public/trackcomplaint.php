<div class="container-login">
   <div class="jumbotron jumbotron-main">
     <h1>Your Complaint status </h1>
   </div>
   <div class="row">
     <div class="col-md-10 col-md-offset-1" style="background-color:#ECE7E7;padding-top:3em;padding-bottom:2em;" >
       <div class="card col-md-5 col-md-offset-1" style="border:1px black solid;background-color:#fbfaf9;border-radius:5px;">
         <div class="container">
            <h4><b>Complaint Description :</b></h4>
            <p><?=$cdetails[0]->c_description;?></p>
            <h4><b>Complaint type :</b></h4>
            <p><?=$cdetails[0]->category;?></p>
            <h4><b>Location : </b></h4>
            <p><?=$cdetails[0]->location;?></p>
            <h4><b>Date :</b></h4>
            <p><?=$cdetails[0]->c_date;?></p>
         </div>
       </div>
       <div class="card col-md-5 col-md-offset-1 "  style="border:1px black solid;background-color:#fbfaf9;border-radius:5px;">
         <div class="container">
            <h4><b>Complaint Status :</b></h4>
            <p><?=$cdetails[0]->c_status;?></p>
            <h4><b>Solution Date :</b></h4>
            <p><?php
              if($cdetails[0]->s_date == NULL)
                echo "Not Solved";
              else
                echo $cdetails[0]->s_date;
            ?></p>
            <h4><b>Assigned To :</b></h4>
            <p><?php
              if($cdetails[0]->w_name == NULL)
                echo "Not Assigned";
              else
                echo $cdetails[0]->w_name;
            ?></p>
            <h4><b>Ph No :</b></h4>
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
