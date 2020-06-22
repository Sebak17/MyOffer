<div class="modal fade" id="modalAuthLogin">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Logowanie</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="alert d-none" id="alertAuthLogin"></div>
        
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            <input id="inpAuthEmail" type="email" placeholder="Podaj email" class="form-control">
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input id="inpAuthPassword" type="password" placeholder="Podaj hasło" class="form-control">
          </div>
        </div>
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary" id="btn_auth_login"><i class="fas fa-sign-in-alt"></i> Zaloguj</button>
      </div>
    </div>
  </div>
</div>


<script src="{{ asset('assets/js/auth/signin.js') }}" charset="utf-8"></script>