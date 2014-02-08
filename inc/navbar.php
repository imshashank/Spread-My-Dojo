      <?
	  $data=explode('/',$_SERVER['REQUEST_URI']);
	  $page = $data[count($data)-1];
	  ?>
	  <div class="masthead">
        <h3 class="text-muted">Email Advertising</h3>
        <ul class="nav nav-justified">
          <li <?=(($page == "publisher.php" || $page == "product.php" || strpos($page,"add_emails.php")!== false)?"class='active'":"")?>><a href="publisher.php">Publisher</a></li>
          <li <?=(($page == "campaigner.php")?"class='active'":"")?>><a href="campaigner.php">Campaigner</a></li>
        </ul>
      </div>