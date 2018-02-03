<script language="javascript">
 function pagesize( value ){
   var url="<?php echo $url ;?>";
    url=url.replace(/(&pagesize=[0-9]+)/,'');
    location.href=url+"&pagesize="+value+"&p="+<?php echo $pager->getPageCount();?>;
 }
 
</script>

<?php if ($pager->getPageCount()): ?>
<?php 
$n = 10;//每页显示的页码数 
$i = 0; 
if ($pager->getPageCount()<= $n) { 
$start_page = 1; 
$end_page =$pager->getPageCount(); 
} else { 
$i = floor($current/$n); 
$start_page = $i * 10; 
$end_page = ($i * 10 + 10) >= $pager->getPageCount() ? $pager->getPageCount() : $i * 10 + 10; 
} 
if ($start_page < 1) $start_page = 1; 
?>
，当前第<a href="####"><?php echo $current;?></a> 页</i> <i class="pageR R">
      <?php if (isset($first)): ?>
          <a href="<?php echo $first; ?>" class="first" >首页</a>
		  <?php else: ?>
		  <a href="#" class="first" >首页</a>
		  <?php endif; ?> 
	 <?php if (isset($previous)): ?>
          <a href="<?php echo $previous; ?>" class="review" >上一页</a>
		  <?php else: ?>
		  <a href="#" class="review" >上一页</a>
		  <?php endif; ?>
		 <?php for($i=$start_page; $i <= $end_page; $i++) {?>
		  <?php if ($i != $current): ?> 
		  <a href="<?php echo $purls[$i-1]; ?>" <?php echo strlen($i)>=3?"style='width:30px;'":""?> ><?php echo $i; ?></a>
		  <?php else: ?> 
		  <a href="<?php echo $purls[$i-1]; ?>" class="curent" <?php echo strlen($i)>=3?"style='width:30px;'":""?>><?php echo $i; ?></a>
		  <?php endif; ?> 
		  <?php } if($pager->getPageCount()>$end_page){?>...<?php }?>
		  <?php if (isset($next)): ?>
          <a href="<?php echo $next; ?>" class="next">下一页</a>
		  <?php else: ?>
		   <a href="<?php echo $next; ?>" class="next">下一页</a> 
		  <?php endif; ?>
          <?php if (isset($last)): ?>
          <a href="<?php echo $last; ?>" class="last">尾页</a>
		  <?php else: ?>
		   <a href="<?php echo $last; ?>" class="last">尾页</a> 
		  <?php endif; ?>
		<span>
		  每页显示
		 <select onchange="pagesize(this.value)" name="pagesize" id="pagesize">
              <option value="20" <?php if($pagesize==20):?> selected="selected"<?php endif;?>>20</option>
              <option value="30" <?php if($pagesize==30):?> selected="selected"<?php endif;?>>30</option>
              <option value="40" <?php if($pagesize==40):?> selected="selected"<?php endif;?>>40</option>
              <option value="50" <?php if($pagesize==50):?> selected="selected"<?php endif;?>>50</option>
              <option value="60" <?php if($pagesize==60):?> selected="selected"<?php endif;?>>60</option>
              <option value="70" <?php if($pagesize==70):?> selected="selected"<?php endif;?>>70</option>
              <option value="80" <?php if($pagesize==80):?> selected="selected"<?php endif;?>>80</option>
              <option value="90" <?php if($pagesize==90):?> selected="selected"<?php endif;?>>90</option>
              <option value="100" <?php if($pagesize==100):?> selected="selected"<?php endif;?>>100</option>
       </select> </span>
    
<?php endif; ?>