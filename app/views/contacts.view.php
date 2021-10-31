
	 		<div class="d-flex align-items-center my-3">
				<h3 class="mb-1 lh-2"><?=$title ?></h3>
			</div>

			<div class="my-3 p-3 bg-body rounded shadow-sm">
				
				<h6 class="border-bottom pb-2 mb-3">Заполните форму</h6>
				<form id="contactForm" action="/ajax/contact" method="POST">
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-2 col-form-label">Ваше имя <sup>*</sup></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="" required />
						</div>
					</div>
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-2 col-form-label">Ваша почта <sup>*</sup></label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="mail" placeholder="" required />
						</div>
					</div>
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-2 col-form-label">Ваш телефон <sup>*</sup></label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" name="phone" placeholder="" required />
						</div>
					</div>
					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-2 col-form-label">Тема письма <sup>*</sup></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="subject" placeholder="" required />
						</div>
					</div>

					<div class="mb-3 row text-muted">
						<label for="" class="col-sm-2 col-form-label">Сообщение <sup>*</sup></label>
						<div class="col-sm-10">
							<textarea class="form-control" name="message" placeholder="" required></textarea>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="" class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<input type="hidden" name="action" value="contact" />
							<input type="hidden" name="sessid" value="<?=session_id()?>" />
							<button type="submit" class="btn btn-primary">Отправить</button>
							<button type="reset"  class="btn btn-primary">Очистить</button>
						</div>
					</div>
					<ul id="result"></ul>
				</form>
			</div>

			<!--div class="row g-3">
				
				<div class="col-sm-4">
					<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="card">
					<img src="/img/slider1.jpg" class="card-img-top" alt="">
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
					</div>
				</div>

			</div-->

			<!--div class="col-4">
				<div class="p-3 border bg-light">Custom column padding</div>
			</div>
			<div class="col-4">
				<div class="p-3 border bg-light">Custom column padding</div>
			</div>
			<div class="col-4">
				<div class="p-3 border bg-light">Custom column padding</div>
			</div>
			<div class="col-4">
				<div class="p-3 border bg-light">Custom column padding</div>
			</div>
			<div class="col-4">
				<div class="p-3 border bg-light">Custom column padding</div>
			</div>
			<div class="col-4">
				<div class="p-3 border bg-light">Custom column padding</div>
			</div-->
