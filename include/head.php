<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="plugins/gritter/css/jquery.gritter.css" rel="stylesheet">
    <link href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- <link href="plugins/noty/noty.css" rel="stylesheet"> -->
    <link href="css/style.css" rel="stylesheet">
    <link href="http://jquery-ui-bootstrap.github.io/jquery-ui-bootstrap/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
    <script src="../js/ip.js"></script>
    <script >
        function sendNotes(){
           var notes = document.getElementById("remarks").value;
          document.getElementById("notes").value=notes;
        }
         function confirmSubmit(id){
            // alert(id);
          document.getElementById("annualid").value=id;
        }
    </script>
</head>
