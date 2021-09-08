<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    </head>
    <body>
        <div class="container">
            <form action="save.php" method="post">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input required="required" type="text" class="form-control" id="firstname" placeholder="First name" name="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input required="required" type="text" class="form-control" id="lastname" placeholder="Last name" name="lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input required="required" type="text" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label for="dob">Date of birth</label>
                    <input  class="form-control" required="required" type="text" placeholder="Date of birth"  id="dob" name="dob">

                </div>
                <div class="form-group">
                    <label for="phone">Number</label>
                    <input required="required" type="number" name="phone" onKeyDown="if (this.value.length === 10 && event.keyCode !== 8)
                                return false;" />
                </div>

                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input required="required" type="text" maxlength="60" class="form-control" id="designation" placeholder="Designation" name="designation">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender_m" value="m" checked>
                        <label class="form-check-label" for="gender_m">
                            M
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender_f" value="f">
                        <label class="form-check-label" for="gender_f">
                            F
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hobby">Hobbies</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="1" id="checkbox_1">
                        <label class="form-check-label" for="checkbox_1">
                            Practice Yoga
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="2" id="checkbox_2">
                        <label class="form-check-label" for="checkbox_2">
                            Take an Online Course
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="3" id="checkbox_3">
                        <label class="form-check-label" for="checkbox_3">
                            Studio Art Class
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="4" id="checkbox_4">
                        <label class="form-check-label" for="checkbox_4">
                            Sketching
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#dob').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd"
                });
            });
        </script>
    </body>
</html>
