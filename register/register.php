<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register/register.css">
    <title>Register</title>
</head>

<body>
    <?php
    include_once ('../components/register_nav.php');
    ?>

    <div class="form-container">
        <div class="radio-inputs">
            <label>
                <input class="radio-input" type="radio" name="engine" onclick="showStudentForm()">
                <span class="radio-tile">
                    <span class="radio-icon"></span>
                    <span class="radio-label">Learner register</span>
                </span>
            </label>
            <label>
                <input class="radio-input" type="radio" name="engine" checked onclick="showExpertiseForm()">
                <span class="radio-tile">
                    <span class="radio-icon"></span>
                    <span class="radio-label">Expertise register</span>
                </span>
            </label>
        </div>
        <div id="student-form" style="display: none;">
            <div class="containers">
                <form enctype="multipart/form-data" method="post" action="process1.php?type=student"
                    onsubmit="return validateForm()">
                    <div class="continer_info">
                        <label>Learner Information</label>
                        <div class="row">
                            <div class="name">
                                <label>First Name</label>
                                <input type="text" name="fname" id="fname" placeholder="Enter First Name" required />
                                <label>Email</label>
                                <input type="email" name="email" id="email" placeholder="Enter Email" required />
                                <label>Address</label>
                                <input type="text" name="address" id="address" placeholder="Enter Address" required />
                                <label>Contact No.</label>
                                <input type="number" name="contact" id="contact" placeholder="Enter Phone number"
                                    required />
                            </div>
                            <div class="contacts">
                                <label>Last Name</label>
                                <input type="text" name="lname" id="lname" placeholder="Enter last Name" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="work">
                                <label>Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter your password"
                                    maxlength="20" required />
                            </div>
                            <div class="pass">
                                <label>Confirm password</label>
                                <input type="password" name="confirmpassword" id="confirmpassword"
                                    placeholder="Confirm your password" maxlength="20" required />
                            </div>
                        </div>
                        <div class="container_img">
                            <div class="doc_img">
                                <label>Your picture:</label>
                                <input type="file" name="pimg" id="pimg" accept="image/*"
                                    onchange="preview(this, 'profilePreview')" />
                                <img id="profilePreview" />
                            </div>
                        </div>
                        <div class="submit">
                            <textarea type="textarea" name="description" id="description"
                                placeholder="Write about you"></textarea>
                            <button type="submit" name="submit" class="btn-primary takespace">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="expertise-form" style="display: none;">
            <div class="containers">
                <form enctype="multipart/form-data" action="process1.php?type=expertise" method="POST"
                    onsubmit="return e_validateForm()">
                    <div class="continer_info">
                        <label>Expertise Information</label>
                        <div class="row">
                            <div class="name">
                                <label>First Name</label>
                                <input type="text" name="efname" id="efname" placeholder="Enter First Name" required>
                                <label>Email</label>
                                <input type="email" name="eemail" id="eemail" placeholder="Enter Email" required>
                                <label>Contact No.</label>
                                <input type="number" name="econtact" id="econtact" placeholder="Enter Phone number"
                                    required>
                            </div>
                            <div class="contacts">
                                <label>Last Name</label>
                                <input type="text" name="elname" id="elname" placeholder="Enter Last Name" required>
                                <label>Address</label>
                                <input type="text" name="eaddress" id="eaddress" placeholder="Enter Address" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="pass">
                                <label>Password</label>
                                <input type="password" name="epassword" id="epassword" placeholder="Enter Your Password"
                                    maxlength="20" required>
                                <label>Institution</label>
                                <input type="text" name="einstitution" id="einstitution"
                                    placeholder="Enter Institution Name" required>
                            </div>
                            <div class="work">
                                <label>Confirm Password</label>
                                <input type="password" name="econfirmpassword" id="econfirmpassword"
                                    placeholder="Confirm Your Password" maxlength="20" required>
                                <label>Profession</label>
                                <input type="text" name="eprofession" id="eprofession" placeholder="Enter Profession"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="container_img">
                        <div class="doc_img">
                            <br /><label>Document/Certificate:</label>
                            <input multiple type="file" name="edoc" id="edoc" accept="image/*"
                                onchange="preview(this, 'docPreview')" required>
                            <img id="docPreview" />
                        </div>
                        <div class="citizen">
                            <label>Your picture:</label>
                            <input type="file" name="epimg" id="epimg" accept="image/*"
                                onchange="preview(this, 'frontPreview')" required />
                            <img id="frontPreview" />
                        </div>
                    </div>
                    <div class="submit">
                        <textarea type="textarea" name="edes" id="edes" placeholder="Write about you"></textarea>
                        <button type="submit" name="submit_expert" class="btn-primary takespace">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
    // include_once ('./components/footer.php');
    ?>

    <!-- footer -->
    <?php
    // include_once ('./components/footer.php');
    ?>
    <script>
        function showStudentForm() {
            document.getElementById('student-form').style.display = 'block';
            document.getElementById('expertise-form').style.display = 'none';
        }
        function showExpertiseForm() {
            document.getElementById('student-form').style.display = 'none';
            document.getElementById('expertise-form').style.display = 'block';
        }
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmpassword = document.getElementById("confirmpassword").value;
            if (password != confirmpassword) {
                alert("Passwords do not match.");
                return false;
            }
            var pnum = document.getElementById("pnum").value;
            var contact = document.getElementById("contact").value;
            if (pnum.length < 8 || contact.length < 8) {
                alert("Please provide a valid Phone Number!");
                return false;
            }
            return true;
        }
        function e_validateForm() {
            var password = document.getElementById("epassword").value;
            var confirmpassword = document.getElementById("econfirmpassword").value;
            if (password != confirmpassword) {
                alert("Passwords do not match.");
                return false;
            }
            var contact = document.getElementById("econtact").value;
            if (contact.length < 8) {
                alert("Please provide a valid Phone Number!");
                return false;
            }
            return true;
        }
        function preview(input, previewId) {
            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = document.getElementById(previewId);
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>