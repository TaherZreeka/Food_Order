<?php declare(strict_types=1); include("../confg/constants.php");
    include("login-check.php");
?>
    
<html>

<head>
    <title>Food Order website-Home Page </title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
    body {
            font-family: Arial, sans-serif;
            /* margin: 20px; */
            background-color: #f9f9f9; /* لون خلفية الصفحة */
        }
        /* تنسيق الجدول */
        table {
            width: 100%;
            border-collapse: collapse; /* إلغاء التداخل بين الحدود */
            table-layout: auto; /* التعديل تلقائي حسب المحتوى */
            margin-top: 20px; /* مسافة أعلى الجدول */
            padding-left:0;
            border-collapse: separate;
            border-spacing: 3px;
        }
        th, td {
            border: 1px solid #000;
            border-radius: 5px; /* حدود خفيفة حول الخلايا */
            padding: 10px; /* مساحة داخل الخلايا */
            text-align: center; /* محاذاة النص في الوسط */
        }
        th {
            background-color: #ff6b81; /* لون خلفية العناوين */
            color: white; /* لون النص في العناوين */
            font-weight: bold; /* جعل النص عريض */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* لون مختلف للصفوف الزوجية */
        }
        tr:hover {
            background-color: #e9e9e9; /* تأثير عند تمرير الماوس */
        }
        .btn-update-order{
            background-color: #2ed573;
            color: white;
            display: inline-block;
            text-decoration: none;
            border: 1px solid black;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn-update-order:hover{
            background-color: #2ed540;
        }
        
        
        
    </style>
</head>

<body>
    <!-- Menu section start -->
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>">Home Website Food</a>
                </li>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="manage-admin.php">Admin</a>
                </li>
                <li>
                    <a href="manage-category.php">Category</a>
                </li>
                <li>
                    <a href="manage-food.php">Foods</a>
                </li>
                <li>
                    <a href="manage-order.php">Order</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <style>
    .success {
        color: #2ed573;
    }

    .error {
        color: #ff4757;
    }

    body {
        background-color: white;

    }

    .menu {
        background-color: white;
    }

    .tbl-full {
        width: 100%;
    }

    table tr th {
        border-bottom: 1px solid black;
        padding: 1%;
        text-align: left;
    }

    table tr td {
        padding: 1%;
    }

    .btn-primary {
        background-color: #1e90ff;
        padding: 1%;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #3742fa;
    }

    .btn-secondary {
        background-color: #7bed9f;
        padding: 1%;
        color: black;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-secondary:hover {
        background-color: #2ed573;
    }

    .btn-danger {
        background-color: #ff6b81;
        padding: 1%;
        color: black;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-danger:hover {
        background-color: #ff4757;
    }
    </style>
    <!-- Menu section end -->