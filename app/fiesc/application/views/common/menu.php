<?php $menu = $this->uri->segment(1);

	//echo 'menuuuuuuuuu'. $menu;
 ?>
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					&ensp;
				</li>
				
				<li<?php if ($menu == 'configuracoes' or $menu == 'usuarios' or $menu == 'extrato' or $menu == 'conta'  or  $menu == 'transactions' ) echo ' class="active open"'; ?>>
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Cadastro Conta</span>
					<span class="arrow<?php if ($menu == 'configuracoes' or $menu == 'usuarios') echo ' open'; ?>"></span>
					</a>
					<ul class="sub-menu">

						<li<?php if ($menu == 'usuarios') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('usuarios') ?>">
							<i class="icon-user" style="font-size: 18px" ></i>
							Pessoa</a>
						</li>
					   <li<?php if ($menu == 'conta') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('conta') ?>">
							<i class="fa fa-university" style="font-size: 18px"></i>
							Conta</a>
						</li>
					   <li<?php if ($menu == 'transactions') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('transactions') ?>">
							<i class="fa fa-retweet" style="font-size: 19px"></i>
							Movimentação</a>
						</li>
					   <li<?php if ($menu == 'extrato') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('extrato') ?>">
							<i class="fa fa-print" style="font-size: 20px"></i>
							Extrato</a>
						</li>	 
					
					</ul>
				</li>

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
