<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            width: 100%;
            box-sizing: border-box;
        }

        .container {
            margin: 0;
            padding: 0;
            width: 100%;
            /* background-color: antiquewhite; */
        }

        .container input {
            background-color: #fff;
            border: 3px solid black;
            width: 45%;
            height: 50px;
            margin: 1.2rem;
            padding: 5px;
        }

        .container a {
            text-decoration: none;
        }

        .container button {
            padding: 20px;
            background-color: green;
            display: inline-block;
        }

        .container button:hover {
            background: #ebe9e9;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Certificate Generator</h1>
        <label> Name: </label>
        <input type="text" id="name">
        <button><a href="#" id="download-btn">Download</a></button>
        <br>
        <canvas id="canvas" height="550px" width="750px"></canvas>
        <form onsubmit="submitForm(event)" id="certificateForm">
            <input name="certificate" type="file" id="certificateImage" hidden>
            <button type="submit">Save</button>
        </form>
    </div>

    <!-- <script> -->
    <script>
        ///send request
        function sendRequest(method, url, formData = null) {
            return new Promise((resolve, reject) => {
                var xhr = new XMLHttpRequest();

                var fullUrl;

                if (url instanceof URL) {
                    fullUrl = url.href;
                } else {
                    fullUrl = "http://localhost/vidyavriddhi/VidyaVriddhi/" + url;
                }

                xhr.open(method, fullUrl);

                // Enable credential forwarding
                xhr.withCredentials = true;

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        resolve(xhr.responseText);
                    } else {
                        reject("Request failed with status:", xhr.status);
                    }
                };

                xhr.onerror = function() {
                    reject("Request failed");
                };

                if (formData) {
                    xhr.send(formData);
                } else {
                    xhr.send();
                }
            });
        }

        const canvas = document.getElementById('canvas')

        function submitForm(e) {
            e.preventDefault();
            const form = document.getElementById("certificateForm");
            const image = document.getElementById("certificateImage");
            canvas.toBlob((blob) => {
                let file = new File([blob], "certificate.jpg", {
                    type: "image/jpeg"
                });
                var formdata = new FormData();
                formdata.append("certificate", file);
                sendRequest("POST", "/students/uploadCertificate.php", formdata)
                    .then(res => alert(res))
                    .catch(err => console.log(err));
            }, 'image/jpeg');

        }
        //for image it is required
        const ctx = canvas.getContext('2d')

        //for text
        const nameInput = document.getElementById('name')

        //for download
        const downloadBtn = document.getElementById('download-btn')

        //for image
        const image = new Image()
        image.src = "../images/certificate.png"

        image.onload = function() {
            drawImage()
        }

        function drawImage() {
            ctx.clearRect(image, 0, 0, canvas.width, canvas.height)
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height)

            //ctx.drawImage(image source, x-axis, top position or y-axis, width for image, height for image)

            ctx.font = '30px monotype corsiva'
            ctx.fillStyle = '#29e'
            // ctx.fillText(Iname, 250, 180)

            ctx.fillText(nameInput.value, 275, 240)

            //ctx.fillText takes three arguments : name, px from left(x-axis), px from top(y-axis)
        }

        nameInput.addEventListener('input', function() {
            // const Iname = nameInput.value
            drawImage();
        })

        downloadBtn.addEventListener('click', function() {
            downloadBtn.href = canvas.toDataURL()
            // downloadBtn.href = canvas.toDataURL(image/jpg)
            //downloadBtn.download = true   


            //download file for client to view
            downloadBtn.download = 'Certificate-' + nameInput.value
        })
    </script>
</body>

</html>