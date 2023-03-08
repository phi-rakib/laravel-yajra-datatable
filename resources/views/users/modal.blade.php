<div class="modal" id="userModal" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm" id="userForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" id="saveData" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>