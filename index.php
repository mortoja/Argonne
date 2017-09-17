<?php
/* This will include the class file automeetically while creat an object. */
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$histogram = new Histogram();
$candidates_result = $histogram->getCandidates();
$candidates = array_reverse($candidates_result);

if (filter_has_var(INPUT_GET, 'CAND_ID')) {
    $CAND_ID = filter_input(INPUT_GET, 'CAND_ID', FILTER_SANITIZE_STRING);
} else {
    $CAND_ID = key($candidates);
}
$histogramData = $histogram->getHistogramData($CAND_ID);

// echo '<pre>';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Simple Histogram Program</title>

        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="css/custom.css" />

        <script type="text/javascript" src="js/jquery-1.12.4.js"></script>

        <script type="text/javascript">
            var data = <?php echo json_encode($histogramData); ?>;
        </script>
    </head>

    <body>
        <div class="container">
            <h3>Simple Histogram - <small>generates a histogram of campaign contributions to each presidential candidate during 2015-2016 from committees</small> </h3>

            <hr>
            <div class="row">
                <form class="form">
                    <div class="form-group col-md-4">
                        <label for="sel1">Select Candidate:</label>
                        <select class="cand form-control" name="CAND_ID" onchange="this.form.submit()">
                            <?php
                            foreach ($candidates as $id => $name) {
                                ?>
                                <option value="<?= $id ?>"<?php if ($id === $CAND_ID) echo ' selected'; ?>>
                                    <?= $name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="row">

                <?php
                if (is_array($histogramData) && count($histogramData) > 0) {
                    ?>
                    <div id="container"></div>
                    <?php
                } else {
                    ?>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                        No Contribution Data is found.
                        <hr>
                            <b>Please select below candidate's as example.</b>
                            <ul>
                                <li>CLINTON, HILLARY RODHAM </li>
                                <li>CLINTON BILL </li>
                                <li>PITTENGER, ROBERT M. HON </li>
                            </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>


        <script>
                            // tell the embed parent frame the height of the content
                            if (window.parent && window.parent.parent) {
                                window.parent.parent.postMessage(["resultsFrame", {
                                        height: document.body.getBoundingClientRect().height,
                                        slug: "None"
                                    }], "*")
                            }


        </script>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">Copyright @mortoja 2017 demo</span>
            </div>
        </footer>
    </body>

</html>

