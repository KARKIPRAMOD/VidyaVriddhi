<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>Register</title>
    <style>
      .form-container {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
 
    </style>
</head>
<body>
    <div class="form-container">
        <button onclick="showStudentForm()">Register as Student</button>
        <button onclick="showExpertiseForm()">Register as Expertise</button>

        <div id="student-form" style="display: none;">
            <h3>Student Form</h3>
            <form action="process.php?type=student" method="POST">
            <div class="username">
                <label>Full Name :</label>
                <input type="text" id="name" required>
                <span class="error" id="nameError"></span>
            </div>
            <div class="Address">
                <label>Address :</label>
                <input type="text" id="address" required>
                <span class="error" id="addressError"></span>
            </div>
            <div class="mail">
                <label>Email :</label>
                <input type="email" id="mail" required>
                <span class="error" id="mailError"></span>
            </div>
            <div class="Contact">
                <label>Contact :</label>
                <input type="text" id="contact" required>
                <span class="error" id="contactError"></span>
            </div>
            <div class="level">
                <label>Level :</label>
                <input type="text" id="level" required>
                <span class="error" id="levelError"></span>
            </div>
            <div class="DOB">
                <label>Date Of Birth :</label>
                <input type="date" id="dob" required>
                <span class="error" id="dobError"></span>
            </div>
            <div class="Institute">
                <label>Institute :</label>
                <input type="text" id="institute" required>
                <span class="error" id="instituteError"></span>
            </div>
            <button type="submit">Register</button>
        </form>
        </div>

        <div id="expertise-form" style="display: none;">
            <h3>Expertise Form</h3>
            <!-- Expertise registration form -->
            <form enctype="multipart/form-data" method="" action="process.php?type=student" >
        <div class="continer_info">
          <div class="name">
            <input
              type="text"
              name="fname"
              id="fname"
              placeholder="Enter First Name"
              required
            />
            <input
              type="text"
              name="lname"
              id="lname"
              placeholder="Enter last Name"
              required
            />
          </div>

          <div class="contacts">
            <input
              type="email"
              name="email"
              id="email"
              placeholder="Enter Email"
              required
            />
            <input
              type="text"
              name="address"
              id="address"
              placeholder="Enter Address"
              required
            />
            <input
              type="number"
              name="pnum"
              id="pnum"
              placeholder="Enter Phone number"
              required
            />
            <!-- <input type="password" name="password" id="password" placeholder="Enter password" required> -->
          </div>

          <div class="pass">
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Enter your password"
              maxlength="20"
              required
            />
            <input
              type="password"
              name="confirmpassword"
              id="confirmpassword"
              placeholder="Confirm your password"
              maxlength="20"
              required
            />
          </div>

          <!-- <tr>
            <td>Gender</td>
            <td><input type="radio" name="gender" id="male" /> Male</td>
            <td><input type="radio" name="gender" id="female" /> Female</td>
          </tr> -->
          <div class="work">
            <input
              type="text"
              name="profession"
              id="profession"
              placeholder="Enter profession"
              required
            />
            <input
              type="text"
              name="Instution"
              id="Instution"
              placeholder="Enter Instution name"
              required
            />
          </div>
        </div>

        <div class="container_img">
          <div class="doc_img">
            <label>Your picture:</label>
            <input
              type="file"
              name="pimg"
              id="pimg"
              accept="image/*"
              onchange="preview(this, 'profilePreview')"
              required
            />
            <img id="profilePreview" />
            <br /><label>Document/Certificate:</label>
            <input
              type="file"
              name="doc"
              id="doc"
              accept="image/*"
              onchange="preview(this, 'docPreview')"
              required
            />
            <img id="docPreview" />
          </div>

          <div class="citizen">
            <label>Citizen Front side:</label>
            <input
              type="file"
              name="image"
              id="cimg"
              accept="image/*"
              onchange="preview(this, 'frontPreview')"
              required
            />
            <img id="frontPreview" />
            <br /><label>Citizen Back side:</label>
            <input
              type="file"
              name="image"
              id="cbimg"
              accept="image/*"
              onchange="preview(this, 'backPreview')"
              required
            />
            <img id="backPreview" />
          </div>
        </div>

        <div class="submit">
          <textarea
            type="textarea"
            name="des"
            id="des"
            placeholder="Write about you"
          ></textarea>
          <button class="btn-primary takespace">Register</button>
        </div>
      </form>
        </div>
    </div>

    <script>
        function showStudentForm() {
            document.getElementById('student-form').style.display = 'block';
            document.getElementById('expertise-form').style.display = 'none';
        }

        function showExpertiseForm() {
            document.getElementById('student-form').style.display = 'none';
            document.getElementById('expertise-form').style.display = 'block';
        }
    </script>
</body>
</html>
