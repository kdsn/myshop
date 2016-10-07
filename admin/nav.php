<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked lg-space">
		<li role="presentation" <?php if($activ_nav == "dashboard"){ echo 'class="active"'; } ?> ><a href="/admin/">Dashboard</a></li>
		<li role="presentation" <?php if($activ_nav == "produkter"){ echo 'class="active"'; } ?> ><a href="/admin/?p=products">Produkter</a></li>
		<li role="presentation" <?php if($activ_nav == "ordre"){ echo 'class="active"'; } ?> ><a href="/admin/?p=orders">Ordre</a></li>
	</ul>
</div>