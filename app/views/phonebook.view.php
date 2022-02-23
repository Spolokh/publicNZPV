

<h3><?=$title ?></h3>


		<table class="table table-striped table-bordered list">
		<thead>
			<tr>
			    <th width="20">#</th>
				<th>Имя</th>
				<th>E-mail</th>
				<th>Телефон</th>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php foreach ($query as $k => $row) { ?>
			<tr>
			    <td><?=$row->id ?></td>
				<td><?=$row->name ?></a></td>
				<td><?=$row->mail ?></td>
				<td><?=$row->phone ?></td>	
			</tr>
		<?php } ?>
		</tbody>
		
		</table>

	

