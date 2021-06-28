 <!-- Post list Pagination begin -->
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
     <li class="page-item"><a class="page-link" href="#">1</a></li>
     <li class="page-item active" aria-current="page">
       <a class="page-link" href="#">2</a>
     </li>
     <li class="page-item"><a class="page-link" href="#">3</a></li>
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