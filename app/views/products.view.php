			<div class="d-flex align-items-center my-3">
				<h3 class="mb-1 lh-2"><?=$title ?></h3>
			</div>

			<div class="my-3 mt-0 p-3 bg-body rounded shadow-sm">
				<!--table table-striped table-sm list" style="width: 100%"-->
				<table id="productsTable" class="table table-striped table-sm list" style="width: 100%">
					<thead>
						<tr>
							<th width="100">Марка</th>
							<th width="90">Модель</th>
							<th width="290">generation
							<th>Год</th>
							<th>Run</th>
							<th width="100">Цвет</th>
							<th width="200">Кузов</th>
							<th>Мотор</th>
							<th>Трансимссия</th>
							<th>Привод</th>
						</tr>
					</thead>
				</table>
			</div>

			<script src="/js/moment/moment.js"></script>
			<script src="/js/jquery.dataTables.min.js"></script>
			<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
			<!--productsTable-->
			<script>
				jQuery(function($) {

					var productsTable =  $('#productsTable').DataTable({
						order: [[ 0, 'asc' ]]
						, ordering: false
						, searching: true
						, processing: true
						, serverSide: true
						, pageLength: 10
						, serverMethod: 'GET'
						, ajax: '/products/show'
						, language: {
							sUrl: '/js/i18n/ru.json'
						}
						, columns: [
							{ data: 'mark' },
							{ data: 'model' },
							{ data: 'generation'},
							{ data: 'year'},
							{ data: 'run'},
							{ data: 'color' },
							{ data: 'body' },
							{ data: 'engine' },
							{ data: 'transmission'},
							{ data: 'gear'},
						]
					});
				});
			</script>
