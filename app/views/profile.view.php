

			
			<?php if (empty($userid)) { ?>
				<div class="mt-5 alert alert-danger alert-dismissible fade show" role="alert">
				    Вы не авторизированны !
					<!--button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button-->
				</div>
			<?php 
		    	return;
			} ?>

			<div class="d-flex align-items-center my-3">
				<h3 class="mb-1 lh-2"><?=$login?></h3>
			</div>

			<div class="my-3 p-3 bg-body rounded shadow-sm">

				<h6 class="border-bottom pb-2 mb-3">Редактировать профиль</h6>
			
				<div class="row">
					<div class="col-md-9">

						<form id="editprofile" action="/profile/save" method="POST">
							<div class="mb-3 row text-muted">
								<label for="" class="col-sm-3 col-form-label">Имя</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="name" value="<?=$query->name?>" placeholder="" />
								</div>
							</div>

							<div class="mb-3 row text-muted">
								<label for="" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" name="mail" value="<?=$query->mail?>" placeholder="" />
								</div>
							</div>

							<div class="mb-3 row text-muted">
								<label for="" class="col-sm-3 col-form-label">Пароль</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="password" value="" placeholder="Изменить пароль" />
								</div>
							</div>

							<div class="mb-3 row text-muted">
								<label for="" class="col-sm-3 col-form-label">Повторить</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="password2" value="" placeholder="Повторить пароль" />
								</div>
							</div>

							<div class="mb-3 row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-9">
									<input type="hidden" name="userid" value="<?=$userid?>" />
									<input type="hidden" name="action" value="profile" />
									<input type="hidden" name="sessid" value="<?=session_id()?>" />
									<button type="submit" class="btn btn-primary">Сохранить</button>
								</div>
							</div>
							<ul id="result"></ul>
						</form>
					</div>

					<div class="col-md-3 text-center">
						<img id="srcImage" class="rounded-circle" src="img/default.png" width="200" height="200" alt=""/>
					</div>

				</div>
			</div>