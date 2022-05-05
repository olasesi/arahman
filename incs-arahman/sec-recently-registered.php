<div class="card-body">
 <h4 class="card-title">Recently registered (Secondary)</h4>
 <div class="table-responsive">
   <table class="table">
     <thead>
       <tr>
      
         <th> Firstname </th>
         <th> Surname </th>
         <th> Email address </th>
         <th> Phone number </th>
       
         <th> Entrance exam payment</th>
        <th>Date paid </th>
     </tr>
     </thead>
     <tbody>

<?php


if (mysqli_num_rows($results) != 0){
while ($row = mysqli_fetch_array($results)) {
 echo '<tr>
 
 <td>'.$row['sec_firstname'].'</td>
 <td>'.$row['sec_surname'].' </td>
 <td>'.$row['sec_email'].'</td>
 <td>'.$row['sec_phone'].'</td>';

if($row['secondary_common_e_status'] == 1){echo '<td>Paid</td>';}else{echo '<td>Not Paid</td>';}

 echo '<td> '.date('M j Y g:i A', strtotime($row['sec_timestamp'])).' </td>
 <td>
 <form action="'.GEN_WEBSITE.'/admin/sec-confirm-data.php?id='.$row['secondary_id'].'" method="POST">

 <button type="submit" class="btn btn-success me-2" name="paid_students">View</button>
 </form>




 </td>
 <td>
 <form action="" method="POST">
 <div class="dropdown">
 <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reject</button>
 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
   <h6 class="dropdown-header">Admmission action</h6>
   
   <button type="submit" class="btn btn-danger me-2" value="'.$row['secondary_id'].'" name="reject_students">Reject Admission</button>
  
   
 </div>
</div>
</form>    
 </td>

</tr>';

}
}else{
echo '<h3 class="text-center">No result found</h3>';
} 

?>


</tbody>
   </table>
   
 </div>
 
</div>
