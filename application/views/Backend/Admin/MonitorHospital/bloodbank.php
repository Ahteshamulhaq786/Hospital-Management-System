@extends(Backend/Admin/MainTemplate)
@section(title)Blood Bank@endsection
@section(content)
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Blood Bank Status</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Blood Group</th>
                      <th style="text-align: center;">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr class="gradeX">
                                <td style="text-align: center;">A+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_A_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">A-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_A_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">B+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_B_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">B-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_B_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">AB+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_AB_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">AB-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_AB_negative(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">O+</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_O_positive(); ?> bags</td>
                            </tr>
                            <tr class="gradeX">
                                <td style="text-align: center;">O-</td>
                                <td style="text-align: center;"><?= $this->Admin_model->count_O_negative(); ?> bags</td>
                            </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
@endsection