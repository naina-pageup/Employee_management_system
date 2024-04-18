<div>
   
    <div class="card-body p-0">
      <div class="row">
        <div class="input-group col-12">
            <input wire:model.live="search" type="search" class="form-control form-control-lg" placeholder="Type name">
            <div class="input-group-append">
            <button type="submit" class="btn btn-lg btn-default">
            <i class="fa fa-search"></i>
            </button>
            </div>
            </div><br>
            <div class="col-2 form-group">
              <label>Salary From</label>
                <input  wire:model.live="sal_from" type="text"  class="form-control" value=""  name="sal_from" autocomplete="off"> 
              </div>
              <div class="col-2 form-group">
                <label>Salary To</label>
                  <input  wire:model.live="sal_to" type="text"  class="form-control" value=""  name="sal_to" autocomplete="off">
                </div>
                <div class="col-2 form-group">
                  <label>Joining Date From:</label>
                  <input  wire:model.live="joining_date_from" type="date" class="form-control  unstyled"  name="joining_date_from">
                  </div>
                  <div class="col-2 form-group">
                    <label>Joining Date To:</label>
                    <input  wire:model.live="joining_date_to" type="date" class="form-control  unstyled"  name="joining_date_to">
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                      <label>Select Manager</label>
                      <select wire:model.live="manager_id" class="form-control" name="manager_id">
                      <option>Select Manager</option>
                      @foreach ($Mangers as $manger )
                      <option value="{{$manger->id }}">{{ $manger->name }}</option>  
                      @endforeach
                    </select>
                  </div>
                  </div>
                  {{-- <div class="col-2 form-group">
                    <label>submite To:</label>
                    <input  type="submit" class="form-control"  value="submit">
                    </div> --}}
      </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Employee ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Salary</th>
              <th>joining Date</th>
              <th>Manager Name</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody id="load-table">
            @if (count($Employee) > 0)
            @php
                $count = 1;
            @endphp
           @foreach ($Employee as $emp )
           <tr>
               <td>{{ $count++ }}</td>
               <td>{{ $emp->employee_id }}</td>
               <td>{{ $emp->name}}</td>
               <td>{{$emp->email}}</td>
               <td>{{$emp->salary}}</td>
               <td>{{$emp->joining_date}}</td>

               <td>
                @if ($emp->manager_id == 0)
                  -
                  @else
                  {{$emp->getManager->name}}
                @endif
               
              </td>
               <td>
                <a href="{{ url('/admin/employee/show',['id' => encrypt($emp->id)])}}" class="edit"><i class='fas fa-eye'></i></a> &nbsp; &nbsp;
                <a href="{{ url('/admin/employee/edit',['id' => encrypt($emp->id)])}}" class="edit"><i class='fas fa-edit'></i></a>
                <form action="{{url('/admin/employee/destroy',$emp->id) }}" method="post"  id="myForm{{$emp->id}}" class="float-right remove">
                    @csrf
                    @method('post')
               <button type="submit"  onclick="conformation(event,{{$emp->id}})" id="remove_dept"> <a href="#"><i class='fa fa-trash' aria-hidden='true'></i></a></button>
            </form>
            </td>
               
           </tr>
           @endforeach
           @else
           <tr>
            <td>Data Not Found</td>
           </tr>
           @endif
          </tbody>
        </table>
      </div>
</div>
@push('customScript')
<script src="{{ asset('theme_assests/custom_js/deleteDepartment.js') }}"></script> 
@endpush