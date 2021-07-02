 <!-- Post list Pagination begin -->

 <?php 
 $totalPagination = $paginator->total_pages; 
//  var_dump($pageNum); 
//  var_dump($totalPagination); 
//  var_dump($paginator->next); 
//  var_dump($paginator->previous); 
 ?>

 <nav aria-label="page" id="pagination-list">

   <ul class=" text-center pagination pt-5">
     <!-- Check for pre pages begin -->
     <?php if ($paginator->previous): ?>
     <li class="page-item">
       <a class="page-link" href="?page=<?= $paginator->previous; ?>" tabindex="-1" aria-disabled="true">Previous</a>
     </li>
     <?php else: ?>
     <li class="page-item disabled">
       <a class="page-link" href="page-link" href="?page=<?= $paginator->previous; ?>" tabindex="-1"
         aria-disabled="true">Previous</a>
     </li>
     <?php endif; ?>
     <!-- Check for pre pages end -->
     <!-- Loop for pagination numbers begin -->
     <?php 
     $x=$pageNum;
      if ($x <= 3 ):
        $j=1;
      while($j <= 3) {?>
     <li class="page-item <?php if ($pageNum == $j): echo "active"; else: ""; endif; ?>"><a class="page-link"
         href="?page=<?= $j; ?>"><?= $j; ?></a></li>

     <?php $j++; } 
      
      elseif($x >= 3  ):
          $j=$x;
          while($j <= $totalPagination) {?>
     <li class="page-item <?php if ($pageNum == $j): echo "active"; else: ""; endif; ?>"><a class="page-link"
         href="?page=<?= $j; ?>"><?= $j; ?></a></li>
     <?php $j++; }

             elseif ($x = $totalPagination  ):
              $j=$totalPagination-1;
              while($j <= $totalPagination) {?>
     <li class="page-item <?php if ($pageNum == $x): echo "active"; else: ""; endif; ?>"><a class="page-link"
         href="?page=<?= $j; ?>"><?= $j; ?></a></li>
     <?php $j++; } 
     endif;
     ?>




     <!-- Loop for pagination numbers end -->
     <?php if ($paginator->next): ?>
     <li class="page-item">
       <a class="page-link" href="?page=<?= $paginator->next; ?>">Next</a>
     </li>
     <?php else: ?>
     <li class="page-item disabled">
       <a class="page-link" href="?page=<?= $paginator->next; ?>">Next</a>
     </li>
     <?php endif; ?>
   </ul>
 </nav>