<!DOCTYPE html>
<html lang="ru">
  	<head>
		<title><?=$data['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#7952b3">

		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="ico/favicon.png">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
		<link rel="stylesheet" href="/css/style.css">

		<style>
			.bd-placeholder-img {
				font-size: 1.125rem;
				text-anchor: middle;
				-webkit-user-select: none;
				-moz-user-select: none;
				user-select: none;
			}
	
			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
					font-size: 3.5rem;
				}
			}
	  	</style>
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="/js/html5shiv.js"></script>
		<![endif]-->
  	</head>
  	<body class="d-flex flex-column h-100">
		<nav class="navbar navbar-expand-xl navbar-dark bg-dark" aria-label="Sixth navbar example">
			<div class="container-fluid">
				<a class="navbar-brand" href="/"><?=$_SERVER['HTTP_HOST']?></a>
				<a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</a>
		
			  	<div class="collapse navbar-collapse" id="navbarsExample06">
					<ul class="navbar-nav me-auto mb-2 mb-xl-0">
						<li class="nav-item"><a class="nav-link" href="/">Главная</a></li>
						<li class="nav-item"><a class="nav-link" href="/users">Люди</a></li>
						<li class="nav-item"><a class="nav-link" href="/contacts">Контакты</a></li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Модули</a>
							<ul class="dropdown-menu" aria-labelledby="dropdown01">
								<li><a class="dropdown-item" href="/shop">Shop</a></li>
								<li><a class="dropdown-item" href="#">Another</a></li>
								<li><a class="dropdown-item" href="#">Something</a></li>
							</ul>
						</li>
					</ul>

					<div class="dropdown navbar-nav">
					<?php if ($login) : ?>
						<a href="#" class="nav-link active dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
							<?=$login ?> <img src="/img/<?=$login ?>.jpg" alt="" width="28" height="28" class="rounded-circle">
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1">
							<li><a class="dropdown-item" href="#">Профиль</a></li>
							<li><a class="dropdown-item" href="#">Настройки</a></li>
							<li><a class="dropdown-item" href="#">Закладки</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="?exit">Выйти</a></li>
						</ul>
					<?php else: ?>
						<a class="nav-link" href="/modal" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Авторизация"><i class="fa fa-sign-in" aria-hidden="true"></i> Вход</a> 
						<a class="nav-link" href="/registration">Регистрация</a>
					<?php endif; ?>
					</div>
			  	</div>
			</div>
		</nav>

      	<!-- Begin page content -->
		<main class="container flex-shrink-0">
			<?php include VIEWS_PATH .DIRECTORY_SEPARATOR. $content; ?>
		</main>

		<footer class="footer mt-auto py-3 bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<ul>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
							<li><a class="text-white-50 text-decoration-none" href="#">Link1</a></li>
							<li><a class="text-muted text-decoration-none" href="#">Link1</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="container text-center py-2">
				<span class="text-muted">Webmaster.nzpv.loc</span>
			</div>
		</footer>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalHeader">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="POST" id="Authorize">
							<input name="username" class="form-control mb-3" type="text" placeholder="Логин" required />
							<input name="password" class="form-control mb-3" type="password" placeholder="Пароль" required />
							<input name="action" type="hidden" value="authorize" />
							<a href="/registration">Регистрация</a>
						</form>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" form="Authorize">Войти</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
					</div>
				</div>
			</div>
		</div>

		<script src="/js/jquery.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
		<script src="/js/jquery.dataTables.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
		<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script-->
		<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
		<script src="/js/jquery.maskedinput.min.js"></script>
		<script src="/js/functions.js"></script>
		<script src="/js/script.js"></script>
		<script>
        jQuery(function($) {

			$('#exampleModal').on('show.bs.modal', function (e) { 
				var modal  = $(this),
					button = $(e.relatedTarget),
					header = button.attr('title'),
					modTitle = $('.modal-title')
				;
				modTitle.text(header);
			});

			$.extend(true, $.fn.dataTable.defaults.oLanguage.oPaginate, {
				sNext: '<i class="fa fa-chevron-right"></i>',
				sPrevious: '<i class="fa fa-chevron-left"></i>'
			});
			
            $('#empTable').DataTable({
				order: [[ 0, 'asc' ]],
				ordering: false,
                processing: true,
                ajax: {
                    url: '/users/json',
					type: 'GET',
					dataSrc: ''
                }
				, columns: [
                    {data: 'id' },
                    { data: 'username', render: function ( data, type, row ) {
						return '<a href="/users/user?user='+row.id+'">'+ data + '</a>';
                	}},
                    {data: 'mail'},
                    {data: 'date'}, 
					{data: 'avatar', render: function ( data ) {
						return '<figure><img class="rounded-circle" loading="lazy" src="/img/'+data+'" alt=""/></figure>';
                	}},
                    {data: 'id', render: function ( data ) {
                        return '<label class="option">' 
									+'<input type="checkbox" class="checkdelTask" name="item[]" value="' +data+ '" <?=(!$login ? 'disabled' : '')?>/>'
									+'<span class="checkbox"></span>'+
								'</label>';
                	}}
                ]
            });
        });
        </script>
  	</body>
</html>
