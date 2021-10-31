

      <div class="d-flex align-items-center my-3">
          <h3 class="mb-1 lh-2"><?=$title ?></h3>
			</div>

      <div class="my-3 p-3 bg-body rounded shadow-sm">
			 
			  <h6 class="border-bottom pb-2 mb-3">Заполните форму</h6>
         
          <form id="registration" action="/ajax/registration" method="POST">
              <div class="mb-3">
                <input type="text" class="form-control" name="username" maxlength="16" pattern="[a-zA-Z0-9\-]{3,16}" placeholder="Логин: Латинские буквы, цифры, до 16 знаков" required />
                
                
							</div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}" placeholder="Пароль: Разные регистры + цифры, не менее 6 знаков" required />
                
                
              </div>
              <div class="mb-3">
							  <input type="password" class="form-control span4" name="password2" placeholder="Пароль (ещё раз)" required />
                
              </div>
              <div class="mb-3">
                <input type="email" class="form-control span4" name="mail" placeholder="Ваша почта" required />
              
              </div>
              <div class="mb-3">
                <input name="sessid" type="hidden" value="<?=session_id() ?>" />
                <input type="hidden" name="action" value="registration" />
                <input type="submit" class="btn btn-primary" value="Регистрация" />
                <input type="reset"  class="btn btn-primary" value=" Очистить " />
                <ul id="result"></ul>  
              </div>
            </form>
      </div>
