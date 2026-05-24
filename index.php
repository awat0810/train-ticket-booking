<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .banner {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        video {
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .content h1 {
            font-size: 40px;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px #000;
        }

        .link-container {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .link-box {
            padding: 20px 30px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .link-box:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <div class="banner">
        <video autoplay loop muted playsinline>
            <source src="train.mp4" type="video/mp4">
        </video>

        <div class="content">
            <h1>Select Your Panel</h1>
            <div class="link-container">
                <a href="admin/index.php" class="link-box">Admin Panel</a>
                <a href="user/index.php" class="link-box">User Panel</a>
            </div>
        </div>
    </div>

</body>
</html>
