<?php
session_start();
include("media.php");
$media = new media();


if (isset($_SESSION['user'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['user'];
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.userID = messages.outgoing
                    WHERE (outgoing = {$outgoing_id} OR incoming = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {

            $output .= '
                    <div id="status" style="cursor:pointer;margin-top:0;margin-bottom:0;border:solid thin;border-radius:26px; background-color: var(--col4); width:100%">
                        <a href="ProfilePage.php">
                        <div style="width: 100%;margin-top:0;margin-bottom:0;">
                            <div  id="NameHeader" style="color: var(--col9); margin-bottom:-3%">
                                <a href="ProfilePage.php?id="" style="color: antiquewhite; text-decoration:none">
                                    <img src="' . $media->preview($row["dp"], "dp") . '" style="margin-left:1vw; border-radius:50%; width:10%;">
                                </a>
                                <a href="ProfilePage.php?id="" style="margin-left:1vw;margin-top:2%; margin-right:1vw; color: antiquewhite; text-decoration:none;">
                                    <span class="smallerText texthover2">' . $row["firstName"] . '" "' . $row["lastName"] . '</span>
                                </a>
                    
                            </div>
                    
                            <a href="message.php">
                                <button class="btn-with-hover" id="Button" style="color:antiquewhite;  background-color: var(--col3);width:5vw;float: right;border-radius: 10px;margin-top:-2%;margin-right:4px">
                                    Chat
                                </button>
                            </a>
                            <div style="margin-left: 2%; margin-top:-3%; ">
                                <div id="textPart">
                                    <p>' . $row["msg"] . '</p>
                                </div>
                            </div>
                            
                        </div>
                    </a>
                    </div>';
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
}
echo $output;
die;
