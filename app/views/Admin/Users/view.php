<div class="container">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Users table</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Name</th> <!-- first name + last name -->
                  <th>Email</th>
                  <th>Address</th>
                  <th>Country</th>
                  <th>Workplace</th>
                  <th>Location</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($users as $user): ?>
                <tr>
                  <td><?=$user->id;?></td>
                  <td><?=$user->login;?></td>
                  <td><?=$user->name;?></td>
                  <td><?=$user->email;?></td>
                  <td><?=$user->address;?></td>
                  <td><?=$user->country;?></td>
                  <td><?=$user->workplace;?></td>
                  <td><?=$user->location;?></td>
                  <td><?=$user->role;?></td>
                </tr>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
</div>