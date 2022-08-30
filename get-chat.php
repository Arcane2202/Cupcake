<?php 
    session_start();
    include("media.php");
    $media = new media();
    if(isset($_SESSION['user'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['user'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.userID = messages.outgoing
                WHERE (outgoing = {$outgoing_id} AND incoming = {$incoming_id})
                OR (outgoing = {$incoming_id} AND incoming = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $img = "<img src='".$media->preview($row['dp'], "dp")."' style='border-radius:50%; height:100%;width:5%;'>";
                    $output .= '<div class="chat incoming">'.$img.'<div class="details"><p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: login.php");
    }

?>