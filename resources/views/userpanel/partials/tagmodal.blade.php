<!-- Button to Open the Modal -->


<!-- The Modal for create tag -->
<div class="modal fade" id="addtagmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addtag">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add TAg</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group row">
            <label for="categoryname" class="col-sm-4 col-form-label">Tag Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Tag Name">
            </div>
            <small class="text-danger " style="margin-left:180px" id="tag_name_help"></small>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Create</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
      </form>
    </div>
  </div>
</div>


<!-- Button to Open the Modal -->


<!-- The Modal for edit tag -->
<div class="modal fade" id="edittagmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="edittag">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Tag</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group row">

            <div class="col-sm-8">
              <input type="hidden" class="form-control" id="tag_id" name="tag_id" placeholder="Category Name">
            </div>

          </div>
          <div class="form-group row">
            <label for="categoryname" class="col-sm-4 col-form-label">Tag Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="edit_tag" name="edit_tag" placeholder="Tag Name">
            </div>
            <small class="text-danger " style="margin-left:180px" id="edit_tag_help"></small>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
      </form>
    </div>
  </div>
</div>