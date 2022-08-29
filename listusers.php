<?php
    $img = $media->preview($val['dp'], 'dp');
    $id = $val['userID'];
    $text = "Add Friend";
    $type1 = 1;
?>

<div id="reactorLister">
    <a href="ProfilePage.php?id=<?php echo $val['userID']; ?>" style="color: antiquewhite; text-decoration:none">
        <img src="<?php echo $img ?>" id="reactorimgcontainer" alt="reactor">
        <span class="texthover reactor">
            <?php echo $val['firstName'] . " " . $val['lastName'] ?>
        </span>
    </a>

    <button onclick='getData3(event,<?php echo  $type1 ?>,<?php echo  $friendId ?>)' 
    class='btn-with-hover' id='profileButton' value='' 
    style='border-radius: 10px;margin-top:1.5%;margin-right:2%;'>
    <?php echo $text ?>
    </button>


</div>

<script type="text/javascript">
    function makeFriend3(data, task, tag) {
        var ajax = new XMLHttpRequest();
        ajax.addEventListener('readystatechange', function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                response3(ajax.responseText, task, tag);
            }
        });
        data = JSON.stringify(data);
        ajax.open("listusers", "ajax.php", true);
        ajax.send(data);
    }

    function getData3(e, task, taskUser) {
        e.preventDefault();
        var data = {};
        data.act = "makeFriend";
        data.task = task;
        data.taskUser = taskUser;
        data.text = e.target.innerHTML;
        makeFriend2(data, task, e.target);
    }

    function response3(res, data, tag) {
        if (res != "") {
            tag.parentElement.style.display = "none";
            obj = JSON.parse(res);
        }
    }
</script>