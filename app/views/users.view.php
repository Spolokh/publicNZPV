
			<div class="d-flex align-items-center my-3">
				<h3 class="mb-1 lh-2"><?=$title ?></h3>
			</div>

			<div class="my-3 mt-0 p-3 bg-body rounded shadow-sm">
			
				<nav>
					<div class="nav nav-pills mb-4" id="nav-tab" role="tablist">
						<a id="homeTab" href="#home" role="tab" class="nav-link active" data-bs-toggle="tab" aria-controls="home" aria-selected="true">Весь список</a>
						<a id="formTab" href="#form" role="tab" class="nav-link" data-bs-toggle="tab" aria-controls="form" aria-selected="false">Добавить</a>
					</div>
				</nav>

				<div class="tab-content">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="homeTab">
			
					<?php if (empty($count)) : ?>
						<div class="alert alert-danger alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							Записей не найдено !
						</div>
					<?php else : ?>
						<form method="POST" id="editPhone">
							<table id="empTable" class="table table-striped table-sm list" style="width: 100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Имя</th>
										<th>Email</th>
										<th>Дата</th>
										<th>Фото</th>
										<th><input type="checkbox" id="allchecked" <?=(!$login ? 'disabled' : '')?>/>
											<label for="allchecked"></label>
										</th>
									</tr>
								</thead>
							</table>
						<div id="result"></div>
					<?php if ($login) : ?>
						<input name="action" type="hidden" value="delete" />
						<button type="submit" class="btn btn-primary">Удалить</button>
					<?php endif; ?>
					</form>
				<?php endif; ?>
			</div>

	
		<div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="formTab">
			<form method="POST" id="addPhone">
				<div class="row">
					<div class="col-md-8">																
						<input type="text" class="form-control mb-3" name="name" placeholder="Имя" required />
						<input type="text" class="form-control mb-3" name="family"  placeholder="Фамилия" required />
						<input type="email" class="form-control mb-3" name="mail" placeholder="E-mail" required />
						<input type="tel" class="form-control mb-3" name="phone"  placeholder="Телефон" required />
						<label for="xhrField" class="btn btn-tertiary labelFile">
							<input name="icon" type="file" id="xhrField" accept="image/jpeg, image/png, image/gif" />
							<i class="icon fa"></i> <span class="js-fileName">Загрузить файл</span>
						</label> 
						<span id="xhrStatus"></span>
					</div> 
					<div class="col-md-4 text-center">
						<img id="srcImage" class="rounded-circle" src="img/default.png" width="200" height="200" alt=""/>
					</div>	
					<div class="col-12">		
						<input name="sessid" type="hidden" value="<?=session_id() ?>" />  
						<input name="action" type="hidden" value="addbook" /><br />
						<button type="submit" class="btn btn-primary">Добавить</button>
						<button type="reset" class="btn btn-primary">Очистить</button>
					</div>
				</div>
			</form>
        </div>
		<script src="/js/moment/moment.js"></script>
        <script src="/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
		<script>
			jQuery(function($) {

				$('#empTable').DataTable({
					order: [[ 0, 'asc' ]]
					, ordering: true
					, processing: true
					, serverSide: true
					, pageLength: 10
					, serverMethod: 'GET'
					, ajax:  '/users/json'
					, language: {
						sUrl: '/js/i18n/ru.json'
					}
					, columns: [
						{
						data: 'id'
						, orderable: false

						}, {data: 'username', render: function ( data, type, row ) {
							return '<a href="/users/user?user='+row.id+'">'+ data + '</a>';
						}}, 
						{data: 'mail'},
						{data: 'date', render: function ( data, type, row ) {
							return moment.unix(data).format("DD.MM.YYYY@hh:mm:ss");
						}}, {
							data: 'avatar' 
							, orderable: false 
							, render: function (data) {
							return '<figure><img class="rounded-circle" loading="lazy" src="/img/' + data + '" alt=""/></figure>';
						}}, {
							data: 'id'
							, orderable: false
							, render: function (data, type, row) {
								return '<input type="checkbox" class="checkdelTask" name="item[]" value="' +data+ '" id="user'+row.id+'" <?=(!$login ? 'disabled' : '')?> />'
									 + '<label for="user'+row.id+'"></label>';
						}}
					]
				});
			});
			</script>
