<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/landingPageAssets/images/philsca-logo-square.jpg" type="image/x-icon">

    <meta name="description" content="Your description">
    <meta name="author" content="Your name">
    <title>PHILSCA</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="/landingPageAssets/css/bootstrap.css" rel="stylesheet">
    <link href="/landingPageAssets/css/fontawesome-all.css" rel="stylesheet">
    <link href="/landingPageAssets/css/styles.css" rel="stylesheet">
    <link href="/landingPageAssets/ratingAssets/rating-style.scss" rel="stylesheet">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- [ Top Navigation ] -->
    <?= $this->include('LandingPage/Components/nav-top.php'); ?>

    <!-- [ Body ] -->
    <?= $this->renderSection('content'); ?>

    <!-- [ Footer ] -->
    <?= $this->include('LandingPage/Components/footer.php'); ?>

    <!-- [ Toast ] -->
    <?= $this->include('LandingPage/Components/toast.php'); ?>

    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>

    <script src="/landingPageAssets/js/jquery.min.js"></script>
    <script src="/landingPageAssets/js/bootstrap.min.js"></script>
    <script src="/landingPageAssets/js/jquery.easing.min.js"></script>
    <script src="/landingPageAssets/js/scripts.js"></script>
</body>

</html>