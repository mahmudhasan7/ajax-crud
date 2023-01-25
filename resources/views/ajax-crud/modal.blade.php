
  <!-- Modal -->
  <div class="modal fade" id="student_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="ajax-form" class="ajax-data" enctype="multipart/form-data" >
                        @csrf
                        <input type="text" id="update" name="update" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form4Example1">Name</label>
                                    <input type="text" name="name" id="form4Example1" class="form-control" />
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form4Example2">Email address</label>
                                    <input type="email" name="email" id="form4Example2" class="form-control" />
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="phone" for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control" />
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="roll" for="roll">Roll</label>
                                    <input type="text" name="roll" id="roll" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline mb-2">
                                    <label class="reg" for="reg">Registration Number</label>
                                    <input type="text" name="reg" id="reg2" class="form-control" />
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="board" id="student_board" for="board">Board</label>
                                    <select class="board" name="board" id="student_board" aria-label="board">
                                        <option value="">Choose...</option>
                                        <option value="1">Dhaka</option>
                                        <option value="2">Rajshahi</option>
                                        <option value="3">Chittagong</option>
                                      </select>
                                </div>
                                <div class="form-outline mb-2 mt-3">
                                    <input class="form-control" type="file" name="avatar" id="avatar">
                                    <label class="avatar" for="avatar">Profile Image</label>
                                </div>

                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
