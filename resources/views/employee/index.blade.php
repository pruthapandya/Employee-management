 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Employee List</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>
 <body>
     <div class="container mt-5">
         <h2 class="mb-4">Employee List</h2>
         <a href="{{ route('employee.create') }}" class="btn btn-primary mb-3">Add Employee</a>
         <table class="table table-bordered">
             <thead>
                 <tr>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Phone Number</th>
                     <th>Gender</th>
                     <th>Department</th>
                     <th>Profile Picture</th>
                     <th>Actions</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($employees as $employee)
                     <tr>
                         <td>{{ $employee->name }}</td>
                         <td>{{ $employee->email }}</td>
                         <td>{{ $employee->phone_number }}</td>
                         <td>{{ ucfirst($employee->gender) }}</td>
                         <td>{{ $employee->department->name }}</td>
                                 <td>
                                     @if($employee->profile_picture)
                                         <img src="{{ Storage::url($employee->profile_picture) }}" width="50" height="50" alt="Profile Picture">
                                     @else
                                         No image
                                     @endif
                                 </td>
                             <td>
                             <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                             <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="delete-form" style="display:inline;">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                             </form>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>

     <!-- jQuery CDN -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Bootstrap JS CDN -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
     <script>
         $(document).ready(function(){
             $('.delete-form').on('submit', function(e){
                 e.preventDefault();
                 if(confirm('Are you sure you want to delete this employee?')){
                     this.submit();
                 }
             });
         });
     </script>
 </body>
 </html>
