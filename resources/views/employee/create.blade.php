 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Add Employee</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- jQuery CDN -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- jQuery Validate CDN -->
     <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 </head>
 <body>
     <div class="container mt-5">
         <h2 class="mb-4">Add Employee</h2>
         <form id="employeeForm" action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="mb-3">
                 <label for="name" class="form-label">Name</label>
                 <input type="text" class="form-control" id="name" name="name" required>
             </div>
             <div class="mb-3">
                 <label for="email" class="form-label">Email</label>
                 <input type="email" class="form-control" id="email" name="email" required>
             </div>
             <div class="mb-3">
                 <label for="phone_number" class="form-label">Phone Number</label>
                 <input type="text" class="form-control" id="phone_number" name="phone_number" required>
             </div>
             <div class="mb-3">
                 <label for="gender" class="form-label">Gender</label>
                 <select class="form-control" id="gender" name="gender" required>
                     <option value="male">Male</option>
                     <option value="female">Female</option>
                     <option value="other">Other</option>
                 </select>
             </div>
             <div class="mb-3">
                 <label for="department_id" class="form-label">Department</label>
                 <select class="form-control" id="department_id" name="department_id" required>
                     @foreach($departments as $department)
                         <option value="{{ $department->id }}">{{ $department->name }}</option>
                     @endforeach
                 </select>
             </div>
             <div class="mb-3">
                 <label for="profile_picture" class="form-label">Profile</label>
                 <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
             </div>
             <button type="submit" class="btn btn-primary">Save Employee</button>
         </form>
     </div>
     <!-- Bootstrap JS CDN -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
     <!-- jQuery Validation Initialization -->
     <script>
         $(document).ready(function(){
             $("#employeeForm").validate({
                 rules: {
                     name: "required",
                     email: {
                         required: true,
                         email: true
                     },
                     phone_number: {
                         required: true,
                         digits: true,
                         minlength: 10
                     },
                     gender: "required",
                     department_id: "required"
                 },
                 messages: {
                     name: "Please enter the employee's name",
                     email: {
                         required: "Please enter the employee's email",
                         email: "Please enter a valid email address"
                     },
                     phone_number: {
                         required: "Please enter the employee's phone number",
                         digits: "Please enter only digits",
                         minlength: "Phone number must be at least 10 digits"
                     },
                     gender: "Please select the employee's gender",
                     department_id: "Please select a department"
                 },
                 errorElement: 'div',
                 errorPlacement: function(error, element) {
                     error.addClass('invalid-feedback');
                     if (element.prop('type') === 'checkbox') {
                         error.insertAfter(element.siblings('label'));
                     } else {
                         error.insertAfter(element);
                     }
                 },
                 highlight: function(element, errorClass, validClass) {
                     $(element).addClass('is-invalid').removeClass('is-valid');
                 },
                 unhighlight: function(element, errorClass, validClass) {
                     $(element).addClass('is-valid').removeClass('is-invalid');
                 }
             });
         });
     </script>
 </body>
 </html>
