@if(session('error'))
      <div class="">
        <div class="row" id="alert_box">
          <div class="col s12">
            <div class="card red darken-1">
              <div class="row">
                <div class="col s10">
                  <div class="card-content white-text">
                    <p>{{ session('error') }}</p>
                  </div>
                </div>
                <div class="col s2">
                  <i class="material-icons icon_style" id="alert_close">close</i>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
@endif

@if(session('success'))
      <div class="">
        <div class="row" id="alert_box">
          <div class="col s12">
            <div class="card green darken-2">
              <div class="row">
                <div class="col s10">
                  <div class="card-content white-text">
                    <p>{{ session('success') }}</p>
                  </div>
                </div>
                <div class="col s2">
                  <i class="material-icons icon_style" id="alert_close">close</i>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    @endif