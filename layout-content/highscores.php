<?php
include("./php-scripts/connectDB.php");
include("./php-scripts/functions.php");

$sql = "SELECT * FROM `pro3_highscores`";

$result = mysqli_query($conn, $sql);

$records = "";

while ($record = mysqli_fetch_assoc($result)) {
    $records .= "<tr> 
<td>" . $record["naam"] . "</td>
<td>" . $record["score"]  . "</td>
</tr>";
};

?>

<div class="row">
    <div id="jumbotron" class="col-12">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table id="highscores" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Naam
                                    </th>
                                    <th scope="col">
                                        Score
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $records ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>