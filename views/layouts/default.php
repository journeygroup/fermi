<html>
<head>
    <title><?= $this->e($title) ?></title>
</head>
<link href="https://fonts.googleapis.com/css?family=Limelight" rel="stylesheet">
<style>
  body {
    padding: 0;
    margin: 0;
  }
  .welcome {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    font-family: 'Limelight', cursive;
    font-weight: 400;
    font-size: 30px;
    text-align: center;
  }
</style>
<body>
    <?= $this->section('content') ?>
</body>
</html>