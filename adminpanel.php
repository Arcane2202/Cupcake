<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css">
        
    
    <title>Cupcake|Admin Panel</title>
</head>
<body>
    <div class="side-menu">
        <div class="brand-name ">
            <h1 class="tubelight" >Cupcake</h1>
            <h3 class="tubelight" style="font-size:20px;">Admin Panel</h3>              
        </div>

        <ul class="ul-spacing">
            <li class="Dashboard"><i class="fas fa-chart-line"></i>Dashboard</li>
            <li class="Feedback"><i class="far fa-comment-alt"></i>Feedback</li>
            <li class="Handle"><i class="fas fa-user-cog"></i>User Handle</li>

        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
                <h1 style="color:brown;">WELCOME TO CUPCAKE, Admin!</h1>
                <div class="user" style="float:right;">
                    <a href="#" class="btn">LOG OUT</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1>3440</h1>
                        <h3>USERS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-users floating"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>9600</h1>
                        <h3>POSTS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-mail-bulk floating"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>14000</h1>
                        <h3>REACTS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-heart floating"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>6000</h1>
                        <h3>COMMENTS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-comment-alt floating"></i>
                    </div>
                </div>

            </div>
            <div class="content-2">
                <div class="recent-feedbacks">
                    <div class="title">
                        <h2> Recent Feedbacks </h2>
                        <a href="#" class="btn">View all</a>
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                        </tr>
                    </table>
                </div>
                <div class="new-users">
                    <div class="title">
                        <h2> New Users </h2>
                        <a href="#" class="btn">View all</a>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <script>
        const Handle = document.querySelector(".Handle");
        const Dashboard = document.querySelector(".Dashboard");
        const Feedback = document.querySelector(".Feedback");
        const cards = document.querySelector(".cards");
        const content2 = document.querySelector(".content-2");
        const feedbacks = document.querySelector(".recent-feedbacks");
        const users = document.querySelector(".new-users");

        Feedback.classList.remove("active");
        Handle.classList.remove("active");
        Dashboard.classList.remove("active");
        cards.classList.add("hide");
        cards.classList.remove("show");
        content2.classList.add("hide");
        feedbacks.classList.add("hide");
        feedbacks.classList.remove("show");
        users.classList.remove("show");
        users.classList.add("hide");
    
        Dashboard.onclick = () => {
            Feedback.classList.remove("active");
            Handle.classList.remove("active");
            Dashboard.classList.add("active");
            cards.classList.add("show");
            cards.classList.remove("hide");
            content2.classList.add("hide");
            feedbacks.classList.add("hide");
            feedbacks.classList.remove("show");
            users.classList.remove("show");
            users.classList.add("hide");

        }

        Feedback.onclick = () => {
            Dashboard.classList.remove("active");
            Handle.classList.remove("active");
            Feedback.classList.add("active");
            cards.classList.add("hide");
            cards.classList.remove("show");
            content2.classList.add("show");
            feedbacks.classList.add("show");
            feedbacks.classList.remove("hide");
            users.classList.remove("show");
            users.classList.add("hide");

        }
        Handle.onclick = () => {
            Dashboard.classList.remove("active");
            Feedback.classList.remove("active");
            Handle.classList.add("active");
            cards.classList.add("hide");
            cards.classList.remove("show");
            content2.classList.add("show");
            feedbacks.classList.add("hide");
            feedbacks.classList.remove("show");
            users.classList.remove("hide");
            users.classList.add("show");
        }

    </script>
</body>



</html>