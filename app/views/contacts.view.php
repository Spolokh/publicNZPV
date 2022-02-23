
	 		<div class="d-flex align-items-center my-3">
				<h3 class="mb-1 lh-2"><?=$title ?></h3>
			</div>

			<div class="my-3 p-3 bg-body rounded shadow-sm">
				
				<h6 class="border-bottom pb-2 mb-3">Заполните форму</h6>
				<form id="contactForm" action="/ajax/contact" method="POST">
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-3 col-form-label">Ваше имя<sup>*</sup></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" placeholder="" required />
						</div>
					</div>
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-3 col-form-label">Ваша почта<sup>*</sup></label>
						<div class="col-sm-9">
							<input type="email" class="form-control" name="mail" placeholder="" required />
						</div>
					</div>
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-3 col-form-label">Ваш телефон<sup>*</sup></label>
						<div class="col-sm-9">
							<input type="tel" class="form-control" name="phone" placeholder="" required />
						</div>
					</div>

					<!--div class="mb-3 row text-muted">
						<label for="" class="col-sm-4 col-form-label">is-invalid class</label>
						<div class="col-sm-9">
							<select id="error" class="form-select" /*data-live-search="true"*/>
								<option>pen</option>
								<option>pencil</option>
								<option selected>brush</option>
							</select>
						</div>
					</div-->

					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-3 col-form-label">Тема письма<sup>*</sup></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="subject" placeholder="" required />
						</div>
					</div>

					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-3 col-form-label">Сообщение<sup>*</sup></label>
						<div class="col-sm-9">
							<textarea class="form-control" name="message" placeholder="" required></textarea>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<input type="hidden" name="action" value="contact" />
							<input type="hidden" name="sessid" value="<?=session_id()?>" />
							<button type="submit" class="btn btn-primary">Отправить</button>
							<button type="reset"  class="btn btn-primary">Очистить</button>
						</div>
					</div>

					<ul id="result"></ul>
				</form>
			</div>

			

			
