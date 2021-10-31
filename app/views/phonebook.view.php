<style>

</style>

<h3><?=$title ?></h3>

<p id="result"></p>
 
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item active" role="presentation">
		<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Весть список</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="false">Добавить</a>
	</li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
<?php if (empty($query)) { ?>
		<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		Записей не найдено !
		</div>
<?php
} else {
?>
	<form method="POST" id="editPhone">
		<table class="table table-striped table-bordered list">
		<thead>
			<tr>
			    <th width="20">#</th>
				<th>Имя</th>
				<th>E-mail</th>
				<th>Телефон</th>
				<th>Фото</th>
				<th width="20"><label class="option">
									<input type="checkbox" name="" value="" />
									<span class="checkbox"></span>
								</label>
				</th>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php foreach ($query as $k => $row) { ?>
			<tr>
			    <td><?=$row->id ?></td>
				<td>
				    <a href="/phonebook/person?id=<?=$row->id ?>"><?=$row->name ?></a>
				</td>
				<td><?=$row->mail ?></td>
				<td><?=$row->phone ?></td>
				<td>
					<figure>
						<img loading="lazy" data-src="/img/<?=($row->icon ? $row->icon : 'default.png') ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="<?=$row->name ?>"/>
					</figure>
				</td>
				<td><label class="option">
						<input type="checkbox" name="item[]" class="checkdelTask" value="<?=$row->id ?>" <?=(!$login ? "disabled" : '')?>>
						<span class="checkbox"></span>
					</label>
					<!--input class="checkdelTask" name="item[]" type="checkbox" value="<?//=$row->id ?>"  /-->
				</td>
			</tr>
		<?php } ?>
		</tbody>
		<?php if ($login) { ?>
		<tr>
		  	<td align="right" colspan="6" style="text-align: right;">
			  	<input name="action" type="hidden" value="delete" />
				<button type="submit" class="btn btn-default"> Удалить </button>
			</td>
		</tr>
	<?php } ?>
		</table>
	</form>
		<div id="result"></div>
<?php } ?>
	  </div>
	  

  	<div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="form-tab">
	    <div class="modal-content">
			<div class="modal-body">
				<form method="POST" id="addPhone">
					<fieldset>                                                                      
						<input name="firstname" type="text" class="form-control span5" placeholder="Имя" required /><br />
						<input name="lastname" type="text" class="form-control span5" placeholder="Фамилия" required /><br />
						<input name="phone" type="tel" class="form-control span5" placeholder="Телефон" required /><br />
						<input name="mail" type="email" class="form-control span5" placeholder="E-mail" required /><br />
						<input name="icon" type="file" class="form-control span5" />
						<input name="action" type="hidden" value="addbook" />
					</fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="addPhone" class="btn btn-default">Добавить</button>
			</div>
		</div>
	  </div>
	  
</div>