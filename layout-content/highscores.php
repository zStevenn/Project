<?php
  include("./php-scripts/connectDB.php");
  include("./php-scripts/functions.php");

if (isset($_GET['per_page'])) {
    $per_page = $_GET['per_page'];
} else {
    $per_page =10;
}

$sql = "SELECT * FROM `pro3-highscores`";

$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

$pages = ceil($count/$per_page);

if (isset($_GET["page"])) {
    $page = $_GET["page"];
 } else {
    $page = 1;
 }

$start = ($page-1)*$per_page;

$sql = "SELECT * FROM `pro3-highscores` order by highscoreid limit $start,$per_page";

$result = mysqli_query($conn, $sql);

$records = "";

while ($record = mysqli_fetch_assoc($result)) {
$records .="<tr> 
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
                        <table class="table table-hover">
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
                        <div class="col-4 offset-4">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                <li class="page-item">
                                        <a class="page-link"
                                            href="index.php?content=read&page=1"
                                            aria-label="first">
                                            <span aria-hidden="true">first</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="index.php?content=read&page=<?php if ($page > 1 ) { echo $page - 1;} else { echo $page; } ?>"
                                            aria-label="Previous">
                                            <span aria-hidden="true">previous</span>
                                        </a>
                                    </li>
                                    <?php for ($i=1; $i <= $pages; $i++) 
                                    {echo "<li class='page-item ";
                                    if ($i == $_GET['page']) echo "active";
                                    echo"'><a class='page-link' href='index.php?content=read&page=" . $i . "'>" . $i . "</a></li>";}?>                                    
                                    <li class="page-item">
                                        <a class="page-link" href="index.php?content=read&page=<?php if ($page < $pages ) 
                                        { echo $page+1;} else { echo $page; } ?>" aria-label="Next">
                                            <span aria-hidden="true">next</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="index.php?content=read&page=<?php echo $pages ?>"
                                            aria-label="last">
                                            <span aria-hidden="true">last</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <form action="index.php?content=read&page=<?php $i ?>" method="GET">
                        <p>Resultaten per pagina</p>
                        <input type="number" name="per_page" placeholder="Aantal rijen">
                        <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>