<h3 style="float: left;">Таблица</h3>
<button style="float:right; margin: 16px 0;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Добавить</button>
 
<br clear="both"/>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<form method="POST" id="addProd">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Добавить задачу</h4>
            </div>
            
			<div class="modal-body">
				<fieldset>                                                                      
					<input name="name" type="text"  style="width: 97.4%;" class="form-control" placeholder="Наименование" required />
					<input name="count" type="number" style="width: 97.4%;" class="form-control" placeholder="Количество" required />
                    <input name="price" type="text" style="width: 97.4%;" class="form-control" placeholder="Цена" required />
                    <input name="value" type="text" style="width: 97.4%;" class="form-control" placeholder="Стоимость" required />
					<input name="action" type="hidden" value="addprod" />
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default"> Save </button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		</form>
	</div>
</div>

<table id="tableDataProds" class="table table-striped table-bordered" style="<?=(reset($query) ? '' : 'display: none')?>">
	<thead>
		<tr>
			<th>Наименование</th>
			<th>Количество</th>
			<th>Цена</th>
			<th>Стоимость</th>
		</tr>
	</thead>
	<tbody id="dataProdsTbody">
    <?php foreach($query as $k => $row) { ?>	
		<tr>
			<td><?=$row->name ?></td>
			<td><?=$row->count ?></td>
			<td><?=$row->price ?></td>
			<td><?=$row->value ?></td>
		</tr>
    <?php } ?>
    </tbody> 
</table>