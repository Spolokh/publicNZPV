
			<div class="d-flex align-items-center my-3">
				<h3 class="mb-1 lh-2"><?=$title ?></h3>
			</div>

			<div class="my-3 mt-0 p-3 bg-body rounded shadow-sm">
				<table class="table table-striped table-bordered table-sm list">
					<thead>
						<tr>
							<th width="20">#</th>
							<th>Name</th>
							<th>Code</th>
							<th>Capital</th>
							<th><input type="checkbox" id="allchecked"/>
								<label for="allchecked"></label>
							</th>
						</tr>
					</thead>
					<tbody id="tbody">
					<?php foreach ($query as $k => $row) :  ?>
						<tr>
							<td><?=$row->id ?></td>
							<td><img src="/img/flags/24/<?=str_replace( ' ', '-', $row->countryName) ?>.png" alt="<?=$row->countryName ?>" /> <?=$row->countryName ?></a></td>
							<td><?=$row->countryCode ?></td>
							<td><?=$row->capital ?></td>
							<th><input type="checkbox" name="" id="checked<?=$row->id ?>"/>
								<label for="checked<?=$row->id ?>"></label>
							</th>	
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

				<nav aria-label="Page navigation example">
					<?=$pages ?>
				</nav>
			</div>



