<!-- Button to Open the Modal -->


<!-- The Modal for create categories -->
<div class="modal fade" id="addcatmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addcategory">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Categories</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group row">
            <label for="categoryname" class="col-sm-4 col-form-label">Category Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name">
            </div>
            <small class="text-danger " style="margin-left:180px" id="category_name_help"></small>
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


<!-- The Modal for create categories -->
<div class="modal fade" id="editcatmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editcategory">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Categories</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group row">

            <div class="col-sm-8">
              <input type="hidden" class="form-control" id="category_id" name="category_id" placeholder="Category Name">
            </div>

          </div>
          <div class="form-group row">
            <label for="categoryname" class="col-sm-4 col-form-label">Category Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="edit_category" name="edit_category" placeholder="Category Name">
            </div>
            <small class="text-danger " style="margin-left:180px" id="edit_category_help"></small>
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