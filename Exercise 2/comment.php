<?php

$host = 'localhost'; 
$db = 'global1'; 
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

        if ($comment) {
            $stmt = $pdo->prepare("INSERT INTO global_comments (comment) VALUES (:comment)");
            $stmt->bindParam(':comment', $comment);
            $stmt->execute();
        }
    }

    $stmt = $pdo->query("SELECT comment FROM global_comments ORDER BY created_at DESC");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = 'Error: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('Picture/pic2.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .container {
            padding: 20px;
        }
        .card {
            position: relative;
            overflow: hidden;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background: url('Picture/card-background.jpg') no-repeat center center;
            background-size: cover;
            border: 5px solid #c0c0c0;
        }
        .card::before {
            content: "";
            position: absolute;
            top: -15px;
            left: -15px;
            width: calc(100% + 30px);
            height: calc(100% + 30px);
            border-radius: 20px;
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0.3);
            z-index: -1;
            pointer-events: none;
            background: radial-gradient(circle, transparent 70%, #c0c0c0 75%, transparent 80%);
            background-size: 30px 30px;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }
        .card-img-side {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border: 4px solid #c0c0c0;
            border-radius: 50%;
            margin: 0 auto 15px;
        }
        .card-body {
            padding: 20px;
        }
        .card-quote {
            font-style: italic;
        }
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            z-index: 1;
        }
        .card:hover .card-overlay {
            opacity: 1;
        }
        .overlay-content p {
            margin: 10px 0;
            font-size: 1.1rem;
        }
        .btn-custom {
            background: linear-gradient(145deg, #c0c0c0, #e0e0e0);
            border: 2px solid #c0c0c0;
            color: #333;
            padding: 12px 24px;
            border-radius: 8px;
            text-transform: uppercase;
            font-weight: bold;
            transition: background 0.3s, border-color 0.3s, transform 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 2;
            text-decoration: none;
        }
        .btn-custom:hover {
            background: linear-gradient(145deg, #e0e0e0, #c0c0c0);
            border-color: #888;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .btn-custom:focus, .btn-custom:active {
            outline: none;
            box-shadow: 0 0 0 2px rgba(21, 180, 0, 0.5);
        }
        .global-comments {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            padding: 20px;
            position: fixed;
            right: 0;
            top: 100px;
            width: 300px;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
            z-index: 10;
        }
        .global-comments textarea {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
        }
        .global-comment-list {
            margin-top: 15px;
        }
        .global-comment-list .global-comment {
            background-color: #444;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <!-- Your profile cards here -->
                    <!-- Example card -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center bg-dark text-white border-silver">
                            <div class="card-content">
                                <img src="Picture/Joyce.jpg" class="card-img-side rounded-circle border border-silver" alt="Joyce De Guzman">
                                <div class="card-body">
                                    <div class="card-overlay">
                                        <div class="overlay-content">
                                            <p><strong>Name:</strong> Joyce Deguzman</p>
                                            <p><strong>Position:</strong> Leader</p>
                                            <p><strong>Address:</strong> MUNTINLUPA CITY</p>
                                            <p><strong>Age:</strong> 20</p>
                                            <p><strong>Quote:</strong> Life isn't a race, don't rush.</p>
                                        </div>
                                    </div>
                                    <div class="card-btn-container">
                                        <a href="https://www.facebook.com/Mr.Torres03" class="btn btn-custom" target="_blank">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="col-md-6 mb-4">
                        <div class="card text-center bg-dark text-white border-silver">
                            <div class="card-content">
                                <img src="Picture/Jeric.jpg" class="card-img-side rounded-circle border border-silver" alt="Joyce De Guzman">
                                <div class="card-body">
                                   
                                    <div class="card-overlay">
                                        <div class="overlay-content">
                                            <p><strong>Name:</strong> Jeric Torres</p>
                                            <p><strong>Position:</strong> Developer/Designer</p>
                                            <p><strong>Address:</strong> MUNTINLUPA CITY</p>
                                            <p><strong>Age:</strong> 20</p>
                                            <p><strong>Quote:</strong> Los Codigos es mi felicidad.</p>
                                        </div>
                                    </div>
                                    <div class="card-btn-container">
                                        <a href="https://www.facebook.com/Mr.Torres03" class="btn btn-custom" target="_blank">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card text-center bg-dark text-white border-silver">
                            <div class="card-content">
                                <img src="Picture/Sam.jpg" class="card-img-side rounded-circle border border-silver" alt="Joyce De Guzman">
                                <div class="card-body">
                                    
                                    <div class="card-overlay">
                                        <div class="overlay-content">
                                            <p><strong>Name:</strong> Sam Cleofe</p>
                                            <p><strong>Position:</strong> Designer</p>
                                            <p><strong>Address:</strong> MUNTINLUPA CITY</p>
                                            <p><strong>Age:</strong> 20</p>
                                            <p><strong>Quote:</strong> There's no growth in a comfort zone</p>
                                        </div>
                                    </div>
                                    <div class="card-btn-container">
                                        <a href="https://www.facebook.com/samcleofe19" class="btn btn-custom" target="_blank">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card text-center bg-dark text-white border-silver">
                            <div class="card-content">
                                <img src="picture/Sandro.jpg" class="card-img-side rounded-circle border border-silver" alt="Joyce De Guzman">
                                <div class="card-body">
                                    <div class="card-overlay">
                                        <div class="overlay-content">
                                            <p><strong>Name:</strong> Sandro Salazar</p>
                                            <p><strong>Position:</strong> Designer</p>
                                            <p><strong>Address:</strong> MUNTINLUPA CITY</p>
                                            <p><strong>Age:</strong> 20</p>
                                            <p><strong>Quote:</strong> Every failed is stepped to success</p>
                                        </div>
                                    </div>
                                    <div class="card-btn-container">
                                        <a href="https://www.facebook.com/bire.salazar?mibextid=ZbWKwL" class="btn btn-custom" target="_blank">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card text-center bg-dark text-white border-silver">
                            <div class="card-content">
                                <img src="Picture/Kiana.jpg" class="card-img-side rounded-circle border border-silver" alt="Joyce De Guzman">
                                <div class="card-body">
                                    <div class="card-overlay">
                                        <div class="overlay-content">
                                            <p><strong>Name:</strong> Kiana Delos Santos</p>
                                            <p><strong>Position:</strong> Designer/p>
                                            <p><strong>Address:</strong> MUNTINLUPA CITY</p>
                                            <p><strong>Age:</strong> 20</p>
                                            <p><strong>Quote:</strong> You have to be odd to be No.1.</p>
                                        </div>
                                    </div>
                                    <div class="card-btn-container">
                                        <a href="https://www.facebook.com/kiana.delossantos.5/about" class="btn btn-custom" target="_blank">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="global-comments bg-dark text-white p-3 rounded">
                    <h3>Global Comments</h3>
                    <div class="form-group">
                        <textarea class="form-control mb-2" rows="5" name="comment" placeholder="Add a global comment..."></textarea>
                        <button class="btn btn-custom submit-global-comment">Submit</button>
                    </div>
                    <div class="global-comment-list">
                        <?php foreach ($comments as $comment): ?>
                            <div class="global-comment"><?php echo htmlspecialchars($comment['comment']); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const submitButton = document.querySelector('.submit-global-comment');
            const commentTextarea = document.querySelector('textarea[name="comment"]');
            const commentList = document.querySelector('.global-comment-list');

            submitButton.addEventListener('click', async () => {
                const comment = commentTextarea.value.trim();

                if (comment) {
                    try {
                        const response = await fetch(window.location.href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({ comment }),
                        });

                        if (response.ok) {
                            const newComment = document.createElement('div');
                            newComment.className = 'global-comment';
                            newComment.textContent = comment;
                            commentList.prepend(newComment);
                            commentTextarea.value = '';
                        } else {
                            console.error('Failed to submit comment');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            });
        });
    </script>
</body>
</html>
