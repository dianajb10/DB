<?php
require_once 'classes/database.php';
$conn = database();
// Check if the connection was successful
if(!$conn){
    echo 'Connection error';
}
    // Validate and sanitize inputs
    if(isset($_GET['table']) && isset($_GET['delete_id'])) {
        $table = $_GET['table'];
        $delete_id = intval($_GET['delete_id']); // Assuming delete_id is an integer
    
        // Define status based on table
        switch($table) {
            case 'movie_list':
                $status = 'movie_id';
                break;
            case 'education_list':
                $status = 'edu_id';
                break;            
            case 'game_list':
                $status = 'game_id';
                break;
            case 'project_list':
                $status = 'project_id';
                break;
            default:
                die("Invalid table name");
                break;
        }
    
        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM $table WHERE $status = ?");
        $stmt->bind_param("i", $delete_id); // "i" indicates integer type
        $stmt->execute();
    
        if($stmt->affected_rows > 0) {
            ?>
            <?php
        } else {
        }
    
        $stmt->close();
} 
if(isset($_POST['submit_edit_project'])){
    $editProjectId = $_POST['editProjectId'];
    $editProjectTitle = $_POST['editProjectTitle'];
    $editProjectDescription = $_POST['editProjectDescription'];
    mysqli_query($conn,"UPDATE project_list SET title='$editProjectTitle',description='$editProjectDescription' WHERE project_id='$editProjectId'");
}
if(isset($_POST['submit_edit_game'])){
    $editGameId = $_POST['editGameId'];
    $editGameTitle = $_POST['editGameTitle'];
    $editGameDescription = $_POST['editGameDescription'];
    mysqli_query($conn,"UPDATE game_list SET title='$editGameTitle',description='$editGameDescription' WHERE game_id='$editGameId'");
}
if(isset($_POST['submit_edit_movie'])){
    $editMovieId = $_POST['editMovieId'];
    $editMovieTitle = $_POST['editMovieTitle'];
    $editMovieDescription = $_POST['editMovieDescription'];
    mysqli_query($conn,"UPDATE movie_list SET title='$editMovieTitle',description='$editMovieDescription' WHERE movie_id='$editMovieId'");
}
if(isset($_POST['submit_edit_education'])){
    $editEducationId = $_POST['editEducationId'];
    $editEducationTitle = $_POST['editEducationTitle'];
    $editEducationDescription = $_POST['editEducationDescription'];
    mysqli_query($conn,"UPDATE education_list SET title='$editEducationTitle',description='$editEducationDescription' WHERE edu_id='$editEducationId'");
}
/*school*/
if(isset($_POST['submit_education'])){
    $educationTitle = mysqli_real_escape_string($conn, $_POST['educationTitle']);
    $educationDescription = mysqli_real_escape_string($conn, $_POST['educationDescription']);
    $fileName = basename($_FILES["educationMediaUpload"]["name"]);
    $filePath = 'images/'.$fileName;
    move_uploaded_file($_FILES['educationMediaUpload']['tmp_name'],'images/'.$fileName);
    mysqli_query($conn,"INSERT INTO `education_list`(`school`,`achievement`,`image`)VALUES('".$educationTitle."','".$educationDescription."','".$filePath."')");
}    
if(isset($_POST['submit_movie'])){
    $movieTitle = mysqli_real_escape_string($conn, $_POST['movieTitle']);
    $movieDescription = mysqli_real_escape_string($conn, $_POST['movieDescription']);
    $fileName = basename($_FILES["mediaUpload"]["name"]);
    $filePath = 'images/'.$fileName;
    move_uploaded_file($_FILES['mediaUpload']['tmp_name'],'images/'.$fileName);
    mysqli_query($conn,"INSERT INTO `movie_list`(`title`,`description`,`image`)VALUES('".$movieTitle."','".$movieDescription."','".$filePath."')");
}
if(isset($_POST['submit_game'])){
    $gameTitle = mysqli_real_escape_string($conn, $_POST['gameTitle']);
    $gameDescription = mysqli_real_escape_string($conn, $_POST['gameDescription']);
    $fileName = basename($_FILES["gameMediaUpload"]["name"]);
    $filePath = 'images/'.$fileName;
    move_uploaded_file($_FILES['gameMediaUpload']['tmp_name'],'images/'.$fileName);
    mysqli_query($conn,"INSERT INTO `game_list`(`title`,`description`,`image`)VALUES('".$gameTitle."','".$gameDescription."','".$filePath."')");
}
if(isset($_POST['submit_project'])){
    $projectTitle = mysqli_real_escape_string($conn, $_POST['projectTitle']);
    $projectDescription = mysqli_real_escape_string($conn, $_POST['projectDescription']);
    $fileName = basename($_FILES["projectMediaUpload"]["name"]);
    $filePath = 'images/'.$fileName;
    move_uploaded_file($_FILES['projectMediaUpload']['tmp_name'],'images/'.$fileName);
    mysqli_query($conn,"INSERT INTO `project_list`(`title`,`description`,`image`)VALUES('".$projectTitle."','".$projectDescription."','".$filePath."')");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boss D</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="images/Evol 4.png">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css ">
    <style>
    body {
        font-family: "Lexend", sans-serif;
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#home">
                    <img src="images/Evol 4.png" alt="Logo" class="logo">
                    <span class="name-logo ml-2">Diana Baduya</span>
                </a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded"
                    type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#home">Home</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#projects">Projects</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="" onclick="show_edit()">
                                <span class="material-symbols-outlined">
                                    person_edit
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="home">
        <div class="home-content">
            <div class="gradient">
                <svg viewBox="0 0 100% 100%" xmlns='http://www.w3.org/2000/svg' class="noise">
                    <filter id='noiseFilter'>
                        <feTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='6' stitchTiles='stitch' />
                    </filter>

                    <rect width='100%' height='100%' preserveAspectRatio="xMidYMid meet" filter='url(#noiseFilter)' />
                </svg>
                <div class="content">
                    <img src="images/ra.png" alt="ra" class="profile-picture">
                    <h1>Diana Jaurigue Baduya</h1>
                    <p>anong sabi ng mga manok</p>
                </div>
            </div>
            <div class="gradient-bg">
                <svg viewBox="0 0 100vw 100vw" xmlns='http://www.w3.org/2000/svg' class="noiseBg">
                    <filter id='noiseFilterBg'>
                        <feTurbulence type='fractalNoise' baseFrequency='0.6' stitchTiles='stitch' />
                    </filter>

                    <rect width='100%' height='100%' preserveAspectRatio="xMidYMid meet" filter='url(#noiseFilterBg)' />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="svgBlur">
                    <defs>
                        <filter id="goo">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -8"
                                result="goo" />
                            <feBlend in="SourceGraphic" in2="goo" />
                        </filter>
                    </defs>
                </svg>
                <div class="gradients-container">
                    <div class="g1"></div>
                    <div class="g2"></div>
                    <div class="g3"></div>
                    <div class="g4"></div>
                    <div class="g5"></div>
                    <div class="interactive"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
    <h1>About Me</h1>
    
    <h2>Educational Background</h2>
    <?php
        $get_education_list = mysqli_query($conn, "SELECT * FROM education_list");
        if (mysqli_num_rows($get_education_list) >= 1) {
            while ($row = mysqli_fetch_array($get_education_list)) {
    ?>
                <div class="about-section">
                    <div class="blog-card">
                        <div class="meta">
                            <div class="photo" style="background-image: url(<?= $row['image'] ?>)"></div>
                        </div>
                        <div class="description">
                            <h1><?= $row['school'] ?></h1>
                            <p><?= $row['achievement'] ?></p>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    ?>

    <h2>Favorite Movies</h2>
    <div class="about-section">
        <div class="cards">
            <?php
                $movie_list = mysqli_query($conn, "SELECT * FROM movie_list");
                if (mysqli_num_rows($movie_list) >= 1) {
                    while ($row = mysqli_fetch_array($movie_list)) {
            ?>
                        <div class="card active" style="--bg: url(<?= $row['image'] ?>)">
                            <div class="shadow"></div>
                            <div class="label">
                                <div class="info">
                                    <div class="title"><?= $row['title'] ?></div>
                                    <div class="text-center"><?= $row['description'] ?></div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>

    <h2>Favorite Games</h2>
    <div class="about-section">
        <div class="project1">
            <?php
                $get_game_list = mysqli_query($conn, "SELECT * FROM game_list");
                if (mysqli_num_rows($get_game_list) >= 1) {
                    while ($row = mysqli_fetch_array($get_game_list)) {
            ?>
                        <div class="project-card">
                            <img src="<?= $row['image'] ?>" alt="Game" class="project-image">
                            <div class="project-info">
                                <h3><?= $row['title'] ?></h3>
                                <p><?= $row['description'] ?></p>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>

</section>

    <section id="projects">
        <h1>Projects</h1>
        <div class="cards">
            <?php
                $project_list = mysqli_query($conn, "SELECT * FROM project_list");
                if (mysqli_num_rows($project_list) >= 1) {
                    while ($row = mysqli_fetch_array($project_list)) {
            ?>
                        <div class="card active" style="--bg: url(<?= $row['image'] ?>)">
                            <div class="shadow"></div>
                            <div class="label">
                                <div class="info">
                                    <div class="title"><?= $row['title'] ?></div>
                                    <div class="text-center"><?= $row['description'] ?></div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </section>


    <section id="contact">
        <h1>Contact Us</h1>
        <h2>Get in touch</h2>
        <div class="contact">
            <form id="contactForm" action="https://example.com/submit-form" method="POST">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Your Name"
                                required />
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" name="email" type="email" placeholder="Your Email"
                                required />
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone"
                                required />
                            <div class="invalid-feedback">Please enter your phone number.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <textarea class="form-control" id="message" name="message" placeholder="Your Message"
                                required></textarea>
                            <div class="invalid-feedback">Please enter your message.</div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
            </form>
        </div>
        <div class="contact-icons">
            <a href="https://www.facebook.com/dianaj.310" target="_blank">
                <img src="images/facebook-icon.png" alt="Facebook">
            </a>
            <a href="https://discord.com/users/802140861101375559" target="_blank">
                <img src="images/discord-icon.png" alt="Discord">
            </a>
            <a href="https://github.com/dianajb10" target="_blank">
                <img src="images/github-icon.png" alt="GitHub">
            </a>
            <a href="https://www.instagram.com/diana.xsts/" target="_blank">
                <img src="images/ig.png" alt="Instagram">
            </a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 MANOK</p>
    </footer>
    <!-- Modal -->
     
    <div class="modal fade" id="show_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between">
                        <label for="movie_list">Favorite Movies</label>
                        <div class="btn btn-primary btn-sm" onclick="new_modal('movieModal')">New Movie List</div>
                        </div>
                        <br>
                        <table class="table table-light" id="movie_list" style="width: 100%;">
                            <thead>
                                <th>#</th>
                                <th></th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $movie_list = mysqli_query($conn,"SELECT * FROM movie_list");
                                if(mysqli_num_rows($movie_list)>=1){
                                    $count = 1;
                                    while($row = mysqli_fetch_array($movie_list)){
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><div style="text-align:center;  "><img src="<?= $row['image'] ?>" style="width:140px;"></div></td>
                                            <td><?= $row['title'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><div class="btn btn-sm btn-success" data-id="<?= $row['movie_id'] ?>" data-title="<?= $row['title'] ?>" data-description="<?= $row['description'] ?>" data-image="<?= $row['image'] ?>" onclick="new_modal1(this,'editMovieModal')">Edit</div>&nbsp;<a href="?delete_id=<?= $row['movie_id'] ?>&table=movie_list"><div class="btn btn-sm btn-danger">Delete</div></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between">
                        <label for="education_list">Education</label>
                        <div class="btn btn-primary btn-sm" onclick="new_modal('educationModal')">New Education</div>
                        </div>
                        <br>
                        <table class="table table-light" id="education_list" style="width: 100%;">
                            <thead>
                                <th>#</th>
                                <th></th>
                                <th>School</th>
                                <th>Achievement</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $education_list = mysqli_query($conn,"SELECT * FROM education_list");
                                if(mysqli_num_rows($education_list)>=1){
                                    $count = 1;
                                    while($row = mysqli_fetch_array($education_list)){
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><div style="text-align:center;  "><img src="<?= $row['image'] ?>" style="width:140px;"></div></td>
                                            <td><?= $row['school'] ?></td>
                                            <td><?= $row['achievement'] ?></td>
                                            <td><div class="btn btn-sm btn-success" data-id="<?= $row['edu_id'] ?>" data-title="<?= $row['school'] ?>" data-description="<?= $row['achievement'] ?>" data-image="<?= $row['image'] ?>" onclick="new_modal1(this,'editEducationModal')">Edit</div>&nbsp;<a href="?delete_id=<?= $row['edu_id'] ?>&table=education_list"><div class="btn btn-sm btn-danger">Delete</div></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between">
                        <label for="movie_list">Favorite Game</label>
                        <div class="btn btn-primary btn-sm" onclick="new_modal('gameModal')">New Game List</div>
                        </div>
                        <br>
                        <table class="table table-light" id="game_list" style="width: 100%;">
                            <thead>
                                <th>#</th>
                                <th></th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $movie_list = mysqli_query($conn,"SELECT * FROM game_list");
                                if(mysqli_num_rows($movie_list)>=1){
                                    $count = 1;
                                    while($row = mysqli_fetch_array($movie_list)){
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><div style="text-align:center;  "><img src="<?= $row['image'] ?>" style="width:140px;"></div></td>
                                            <td><?= $row['title'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><div class="btn btn-sm btn-success" data-id="<?= $row['game_id'] ?>" data-title="<?= $row['title'] ?>" data-description="<?= $row['description'] ?>" data-image="<?= $row['image'] ?>" onclick="new_modal1(this,'editGameModal')">Edit</div>&nbsp;<a href="?delete_id=<?= $row['game_id'] ?>&table=game_list"><div class="btn btn-sm btn-danger">Delete</div></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between">
                        <label for="movie_list">Favorite Projects</label>
                        <div class="btn btn-primary btn-sm" onclick="new_modal('projectModal')">New Projects</div>
                        </div>
                        <br>
                        <table class="table table-light" id="game_list" style="width: 100%;">
                            <thead>
                                <th>#</th>
                                <th></th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $movie_list = mysqli_query($conn,"SELECT * FROM project_list");
                                if(mysqli_num_rows($movie_list)>=1){
                                    $count = 1;
                                    while($row = mysqli_fetch_array($movie_list)){
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><div style="text-align:center;  "><img src="<?= $row['image'] ?>" style="width:140px;"></div></td>
                                            <td><?= $row['title'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><div class="btn btn-sm btn-success" data-image="<?= $row['image'] ?>" data-id="<?= $row['project_id'] ?>" data-title="<?= $row['title'] ?>" data-description="<?= $row['description'] ?>" onclick="new_modal1(this,'editProjectModal')">Edit</div>&nbsp;<a href="?delete_id=<?= $row['project_id'] ?>&table=project_list"><div class="btn btn-sm btn-danger">Delete</div></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movieModalLabel">Add New Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="movieForm" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="movieTitle">Movie Title</label>
                            <input type="text" class="form-control" id="movieTitle" name="movieTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="movieDescription">Description</label>
                            <textarea class="form-control" id="movieDescription" name="movieDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="mediaUpload">Upload Image or Video</label>
                            <input type="file" class="form-control-file" id="mediaUpload" name="mediaUpload" accept="image/*,video/*" required>
                        </div>
                        <button type="submit" name="submit_movie" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Game Modal Structure -->
      <div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameModalLabel">Add New Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="gameForm" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="gameTitle">Game Title</label>
                            <input type="text" class="form-control" id="gameTitle" name="gameTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="gameDescription">Description</label>
                            <textarea class="form-control" id="gameDescription" name="gameDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameMediaUpload">Upload Image or Video</label>
                            <input type="file" class="form-control-file" id="gameMediaUpload" name="gameMediaUpload" accept="image/*,video/*" required>
                        </div>
                        <button type="submit" name="submit_game" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Modal Structure -->
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Add New Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="projectForm" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="projectTitle">Project Title</label>
                            <input type="text" class="form-control" id="projectTitle" name="projectTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="projectDescription">Description</label>
                            <textarea class="form-control" id="projectDescription" name="projectDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="projectMediaUpload">Upload Image or Video</label>
                            <input type="file" class="form-control-file" id="projectMediaUpload" name="projectMediaUpload" accept="image/*,video/*" required>
                        </div>
                        <button type="submit" name="submit_project" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Education Modal Structure -->
    <div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="educationModalLabel">Add New Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="EducationForm" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="educationTitle">School</label>
                            <input type="text" class="form-control" id="EducationTitle" name="educationTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="educationDescription">Achievement</label>
                            <textarea class="form-control" id="educationDescription" name="educationDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="educationMediaUpload">Upload Image or Video</label>
                            <input type="file" class="form-control-file" id="educationMediaUpload" name="educationMediaUpload" accept="image/*,video/*" required>
                        </div>
                        <button type="submit" name="submit_education" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Education Modal Structure -->
    <div class="modal fade" id="editEducationModal" tabindex="-1" role="dialog" aria-labelledby="editEducationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEducationModalLabel">Edit Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editEducationForm" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="editEducationTitle">Education Title</label>
                            <input type="hidden" id="edu_id"  class="form-control" name="editEducationId">
                            <input type="text" class="form-control" id="editEducationTitle" name="editEducationTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="editEducationDescription">Description</label>
                            <textarea class="form-control" id="editEducationDescription" name="editEducationDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editEducationMediaUpload">Upload New Image or Video</label>
                            <img src="" id="editEducationImage" style="width:150px;">
                        </div>
                        <button type="submit" name="submit_edit_education" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Movie Modal Structure -->
    <div class="modal fade" id="editMovieModal" tabindex="-1" role="dialog" aria-labelledby="editMovieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMovieModalLabel">Edit Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editMovieForm" enctype='multipart/form-data'>
                        <input type="hidden" id="movie_id" name="editMovieId">
                        <div class="form-group">
                            <label for="editMovieTitle">Movie Title</label>
                            <input type="text" class="form-control" id="editMovieTitle" name="editMovieTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="editMovieDescription">Description</label>
                            <textarea class="form-control" id="editMovieDescription" name="editMovieDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editMediaUpload">Upload New Image or Video</label>
                            <img src="" id="editMovieImage" style="width:150px;">

                        </div>
                        <button type="submit" name="submit_edit_movie" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Game Modal Structure -->
    <div class="modal fade" id="editGameModal" tabindex="-1" role="dialog" aria-labelledby="editGameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel">Edit Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editGameForm" enctype='multipart/form-data'>
                        <input type="hidden" id="game_id" name="editGameId">
                        <div class="form-group">
                            <label for="editGameTitle">Game Title</label>
                            <input type="text" class="form-control" id="editGameTitle" name="editGameTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="editGameDescription">Description</label>
                            <textarea class="form-control" id="editGameDescription" name="editGameDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editGameMediaUpload">Upload New Image or Video</label>
                            <img src="" id="editGameImage" style="width:150px;">
                        </div>
                        <button type="submit" name="submit_edit_game" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Project Modal Structure -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editProjectForm" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="editProjectTitle">Project Title</label>
                            <input type="hidden" id="project_id"  class="form-control" name="editProjectId">
                            <input type="text" class="form-control" id="editProjectTitle" name="editProjectTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="editProjectDescription">Description</label>
                            <textarea class="form-control" id="editProjectDescription" name="editProjectDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editProjectMediaUpload">Upload New Image or Video</label>
                            <img src="" id="editProjectImage" style="width:150px;">
                        </div>
                        <button type="submit" name="submit_edit_project" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
    <script>
    $('#movie_list').DataTable();

    </script>
    <script src="script.js"></script>
</body>

</html>