 <!-- Post list Pagination begin -->

 <?php 
 $totalPagination = $paginator->total_pages; 
//  var_dump($pageNum); 
//  var_dump($totalPagination); 
//  var_dump($paginator->next); 
//  var_dump($paginator->previous); 
 ?>

 <nav aria-label="page">
   <ul class="pagination pt-5">
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
     $x=1;
      while($x <= $totalPagination) {?>

     <li class="page-item <?php if ($pageNum == $x): echo "active"; else: ""; endif; ?>"><a class="page-link"
         href="?page=<?= $x; ?>"><?= $x; ?></a></li>

     <?php $x++; } ?>
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