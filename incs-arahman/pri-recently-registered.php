<div class="card-body">
 <h4 class="card-title">Recently registered (Primary)</h4>
 <div class="table-responsive">
   <table class="table">
     <thead>
       <tr>
      
         <th> Firstname </th>
         <th> Surname </th>
         <th> Email address </th>
         <th> Phone number </th>
       
        <th>Date registered </th>
     </tr>
     </thead>
     <tbody>

<?php


if (mysqli_num_rows($results) != 0){
while ($row = mysqli_fetch_array($results)) {
 echo '<tr>
 
 <td>'.$row['pri_firstname'].'</td>
 <td>'.$row['pri_surname'].' </td>
 <td>'.$row['pri_email'].'</td>
 <td>'.$row['pri_phone'].'</td>';

 echo '<td> '.date('M j Y g:i A', strtotime($row['pri_timestamp'])).' </td>
 <td>
 <form action="'.GEN_WEBSITE.'/admin/pri-confirm-data.php?id='.$row['primary_id'].'" method="POST">

 <button type="submit" class="btn btn-success me-2" name="paid_students">View</button>
 </form>




 </td>
 <td>
 <form action="" method="POST">
 <div class="dropdown">
 <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reject</button>
 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
   <h6 class="dropdown-header">Admmission action</h6>
   
   <button type="submit" class="btn btn-danger me-2" value="'.$row['primary_id'].'" name="reject_students">Reject Admission</button>
  
   
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
