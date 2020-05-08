<div class="modal fade" id="copymodal" tabindex="-1" role="dialog" aria-labelledby="Copy" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Link detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="input-group">
        <input type="text" class="form-control" id="pathhere" readonly>
  <div class="input-group-append">
    <button class="btn btn-primary" type="button" id="copy" data-container="body" data-toggle="popover" data-placement="top" data-content="Copied !">Copy</button>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="Copy" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Do you want to delete </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="2ndtexthere"></h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nope</button>
        <button id="deleteitplease" type="button" class="btn btn-danger">Delete it please !</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="configmodal" tabindex="-1" role="dialog" aria-labelledby="Copy" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">SETUP PIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="width:70%; margin:0 auto;">
        <input type="hidden" class="form-control form-control-lg" id="oldpin">
        <input type="number" class="form-control form-control-lg" id="pin">
        <p id="error" ></p>
      </div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="pinsetup" type="button" value="" disabled class="btn btn-warning" style="color:white;">Save</button>
      </div>
    </div>
  </div>
</div>