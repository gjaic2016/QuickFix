<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand">QuickFix</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav">
								<li><a href="index.php?menu=1">Naslovna</a></li>
								<li><a href="index.php?menu=3">Oglasi</a></li>
								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Video<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="https://www.youtube.com/user/rossmanngroup">Louis Rossmann YT</a></li>
										<li><a href="https://www.youtube.com/channel/UCooKQlg-HZ0PFAPc4Ymg3RA">Electronics repair school YT</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Korisne poveznice<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="https://www.learnabout-electronics.org/">LEARN ABOUT ELECTRONICS</a></li>
										<li><a href="https://www.unionrepair.com/tools/">UNION REPAIR TOOLS</a></li>
										<li><a href="https://www.rossmanngroup.com/">ROSSMANN GROUP</a></li>
										<li><a href="https://www.ifixit.com/">IFIXIT</a></li>
										<li><a href="https://www.vvg.hr">VVG</a></li>
										<li><a href="index.php?menu=8">Tečajna lista HNB API</a></li>
									</ul>
								</li>
								<li><a href="index.php?menu=2">O nama</a></li>
							</ul>
							<ul class="nav navbar-nav pull-right">
								<?php if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
									print '
										<li><a href="index.php?menu=4">Registracija</a></li>	
										<li><a href="index.php?menu=5">Prijava</a></li>';
								}
								else if ($_SESSION['user']['valid'] == 'true') {
									if($_SESSION['user']['isAdmin'] == 1){
										print '
										<li><h4><a href="index.php?menu=6">Administrator</a></h4></li>
										<li><a href="signout.php">Odjava</a></li>';
									}
									else{
										print '
										<li><h4><a href="index.php?menu=7">'. $_SESSION['user']['firstname'].'</a></h4></li>
										<li><a href="signout.php">Odjava</a></li>';
									}
								}
								?>
							</ul>
		</div>
	</div>
</nav>