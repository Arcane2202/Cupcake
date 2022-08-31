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
            <li><i class="fas fa-chart-line"></i>Dashboard</li>
            <li><i class="far fa-comment-alt"></i>Feedback</li>
            <li><i class="fas fa-user-cog"></i>User Handle</li>

        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Search..">
                    <button type="sumbit" ><i class="fas fa-search"></i></button>
                </div>
                <div class="user">
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
                        <i class="fas fa-users"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>9600</h1>
                        <h3>POSTS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-mail-bulk"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>14000</h1>
                        <h3>REACTS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-heart"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>6000</h1>
                        <h3>COMMENTS</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-comment-alt"></i>
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
                        <h2> New Students </h2>
                        <a href="#" class="btn">View all</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>