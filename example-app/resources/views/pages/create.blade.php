@extends('welcome',['activePage' => 'Dashboard'])

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Travel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Travel</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('store')}}" method="post">
                                    @csrf
                                    {{-- <input type="text" id="dateRangePicker" name="date_range">
                                   <input type="checkbox" id="checkbox" disabled> Checkbox --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputStatus">Travel Type <span style="color: red">*</span></label>
                                                <select class="form-control select2" name='travel_type'>
                                                    <option value='perjalanan_dinas'>Perjalanan Dinas</option>
                                                    <option value='mutasi_career'>Mutasi Career</option> 
                                                </select>
                                            </div>
                                            @error('travel_type')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Latter Date <span style="color: red">*</span></label>
                                                <input type="input" class="form-control" name="latter_date" id="latter_date" value="{{$date}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Request By</label>
                                                <input type="text" class="form-control" name="request_name" id="request_name" value="EGEN ENDO LERMATIN" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Start & End Date <span style="color: red">*</span></label>
                                                 <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    {{-- <input type="text" class="form-control" name="daterange"/> --}}
                                                    <input type="text" class="form-control" id="dateRangePicker" name="startdate_enddate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Destination <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="destination" id="destination">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputStatus">Approval Status</label>
                                                <input type="text" class="form-control" name="status_aproval" id="status_approval" value="New" readonly>
                                            </div>
                                            @error('status_approval')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Reason to Travel <span style="color: red">*</span></label>
                                                <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">With Cash Advance</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status_cash" id="checkbox" disabled>
                                                    <i>Note: Jika Pengajuan maksimal H-3 maka With Cash Advance dicentang</i>
                                                    {{-- <input type="checkbox" class="form-control" id="showMenuCheckbox" disabled> Show Menu --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu" style="display: none;">
                                        <div class="card-body">
                                            <button class="btn btn-primary float-right" onclick="addRow()">Add Cash Advance</button><br><br>
                                            <table class="table table-bordered" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>Category</th>
                                                        <th>Start and End Date</th>
                                                        <th>Region Destination</th>
                                                        <th>Branch Destination</th>
                                                        <th>Quantity</th>
                                                        <th>Budget</th>
                                                        <th>Total</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
@endsection

@push('javascript')
    <script>
        $(function() {
            $('.select2').select2();

            // Inisialisasi Date Range Picker
            $('#dateRangePicker').daterangepicker({
                startDate: moment().subtract(3, 'days'),
                endDate: moment(),
                autoclose: true
            });

            $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
                var startDate = picker.startDate;
                var endDate = picker.endDate;

                var threeDaysBefore = moment().subtract(3, 'days');
                var threeDaysAfter = moment().add(3, 'days');

                if (startDate.isAfter(threeDaysBefore)) {
                    console.log("disable false");
                    $('#checkbox').prop('disabled', false);
                } else {
                    console.log("disable true");
                    $('#checkbox').prop('disabled', true);
                }
                
            });

            $('#datePicker2').daterangepicker()
        })
        $(document).ready(function(){
            $('#destination').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
            $('#reason').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
        
        const showMenuCheckbox = document.getElementById('checkbox');
        const menu = document.getElementById('menu');
        
        showMenuCheckbox.addEventListener('change', function() {
            if (this.checked) {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });
        var counter = 1;
        function addRow() {
            var table = document.getElementById("dataTable");
            var row = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            var cell10 = row.insertCell(9);

            cell1.innerHTML = counter;
            cell2.innerHTML = '<input type="text" class="form-control" name="category[]">';
            cell3.innerHTML = '<input type="text" id="datePicker2" class="form-control" name="tanggal2" placeholder="Pilih Tanggal 2">';
            cell4.innerHTML = '<input type="text" class="form-control" name="email[]">';
            cell5.innerHTML = '<input type="text" class="form-control" name="email[]">';
            cell6.innerHTML = '<input type="text" class="form-control" name="email[]">';
            cell7.innerHTML = '<input type="text" class="form-control" name="email[]">';
            cell8.innerHTML = '<input type="text" class="form-control" name="email[]">';
            cell9.innerHTML = '<input type="text" class="form-control" name="email[]">';
            cell10.innerHTML = '<button class="btn btn-danger" onclick="deleteRow(this)"><i class="nav-icon fas fa-trash"></i></button>';
            counter++;
        }
        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("dataTable").deleteRow(i);
            resetRowNumbers();
        }

        function resetRowNumbers() {
            var table = document.getElementById("dataTable").getElementsByTagName('tr');
            for (var i = 1; i < table.length; i++) {
                table[i].getElementsByTagName('td')[0].innerHTML = i;
            }
        }
    </script>
@endpush