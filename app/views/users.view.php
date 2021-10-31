<?php 
//use Pagination;
?>
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
			
			<?php if (empty($query)) : ?>
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
									<th>E-mail</th>
									<th>Дата</th>
									<th>Фото</th>
									<th>
										<label class="option">
											<input type="checkbox" />
											<span class="checkbox"></span>
										</label>
									</th>
								</tr>
							</thead>
						</table>
						<div id="result"></div>
					<?php if ($login) : ?>
						<input name="action" type="hidden" value="delete" />
						<button type="submit" class="btn btn-default"> Удалить </button>
					<?php endif; ?>
					</form>
		<?php endif; ?>
	</div>

	<style>
	#srcImage
	{
		width: 100%;
		height: auto;
		max-width: 200px;
	}
.objectFit
{
	width: 100%;
    height: 100%;
    object-fit: cover;
	-o-object-fit: cover;
}

.labelFile > input[type="file"] {
	width: .1px; 
	height: .1px; 
	opacity: 0; 
	overflow:hidden;
	position:absolute;
	z-index:-1
}

#xhrStatus {
    padding: 4px;
    line-height: 1.5;
	display: inline-block;
}

.labelFile > .icon:before
	{content: "\f093"}
.labelFile > .icon.value:before
{
	content:"\f00c";
	color: green
}
</style>

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