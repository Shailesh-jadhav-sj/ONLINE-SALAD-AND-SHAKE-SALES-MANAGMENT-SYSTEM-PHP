<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] == "Admin" || $_SESSION["username"] == "Cook" || $_SESSION["username"] == "Deliverypersoan") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
}

include_once './Admin_header.php';
include_once './Connection.php';
?>
<html>
    <head>
        <link href="../css/Login_page.css" rel="stylesheet" type="text/css"/>
        <script src="//cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!--Validation for insert product-->
        <script class="text/javascript">
            $(document).ready(function () {

                //validation for product name
                $('#pname').keyup(function () {
                    var name = $('#pname').val();
                    if (name === "")
                    {
                        $('#nameErr').html('Product name is required');
                        return false;
                    } else
                    {
                        if (!/^[a-zA-Z_ ]*$/g.test(document.registrationForm.pname.value))
                        {
                            $('#nameErr').html('Enter only alphabets');
                            return false;
                        } else if (name.length < 2)
                        {
                            $('#nameErr').html('Enter atleast 2 alphabets');
                            return false;
                        } else if (name.length > 20)
                        {
                            $('#nameErr').html('Enter within 20 alphabets');
                            return false;
                        } else
                        {
                            $('#nameErr').html('');
                            return false;
                        }
                    }
                });
                //validation for product quantity
                $('#qty').keyup(function () {
                    var qty = $('#qty').val();
                    if (qty === "")
                    {
                        $('#qtyErr').html('Quantity is required');
                        return false;
                    } else
                    {
                        if (!/^[0-9]*$/g.test(document.registrationForm.qty.value))
                        {
                            $('#qtyErr').html('Enter only Digit');
                            return false;
                        } else if (qty.length >= 4)
                        {
                            $('#qtyErr').html('Enter 4 digit only');
                            return false;
                        } else
                        {
                            $('#qtyErr').html('');
                            return false;
                        }
                    }
                });
                //validation for product name
                $('#cname').keyup(function () {
                    var cname = $('#cname').val();
                    if (cname === "")
                    {
                        $('#cnameErr').html('Company name is required');
                        return false;
                    } else
                    {
                        if (!/^[a-zA-Z]*$/g.test(document.registrationForm.cname.value))
                        {
                            $('#cnameErr').html('Enter only alphabets');
                            return false;
                        } else if (cname.length < 2)
                        {
                            $('#cnameErr').html('Enter atleast 2 alphabets');
                            return false;
                        } else if (cname.length > 10)
                        {
                            $('#cnameErr').html('Enter within 10 alphabets');
                            return false;
                        } else
                        {
                            $('#cnameErr').html('');
                            return false;
                        }
                    }
                });

                //validation for Weight
                $('#weight').keyup(function () {
                    var weight = $('#weight').val();
                    if (weight === "")
                    {
                        $('#weightErr').html('Weight is required');
                        return false;
                    } else
                    {

                        $('#weightErr').html('');
                        return false;

                    }
                });

                //validation for product price
                $('#price').keyup(function () {
                    var qty = $('#price').val();
                    if (qty === "")
                    {
                        $('#priceErr').html('Price is required');
                        return false;
                    } else
                    {
                        if (!/^[0-9]*$/g.test(document.registrationForm.price.value))
                        {
                            $('#priceErr').html('Enter only Digit');
                            return false;
                        } else if (qty.length != 3)
                        {
                            $('#priceErr').html('Enter 3 digit only');
                            return false;
                        } else
                        {
                            $('#priceErr').html('');
                            return false;
                        }
                    }
                });
                //validation for manufacuring date
                $('#mdate').keyup(function () {
                    var mdate = $('#mdate').val();
                    var selectedText = document.getElementById('mdate').value;
                    var selectedDate = new Date(selectedText);
                    var now = new Date();
                    if (mdate === "")
                    {
                        $('#mdateErr').html('Manufacturing Date is required');
                        return false;
                    } else if (selectedDate > now)
                    {
                        $('#mdateErr').html('Date must be in the past');
                    } else
                    {
                        $('#mdateErr').html('');
                        return false;
                    }
                });
                //validation for expry date
                $('#edate').keyup(function () {
                    var edate = $('#edate').val();
                    var selectedText = document.getElementById('edate').value;
                    var selectedDate = new Date(selectedText);
                    var now = new Date();
                    if (edate === "")
                    {
                        $('#edateErr').html('Expiery Date is required');
                        return false;
                    } else if (selectedDate < now)
                    {
                        $('#edateErr').html('Date must be in the Future');
                    } else
                    {
                        $('#edateErr').html('');
                        return false;
                    }
                });
                //validation for power
                $('#power').keyup(function () {
                    var power = $('#power').val();
                    if (power === "")
                    {
                        $('#powerErr').html('Power is required');
                        return false;
                    } else
                    {

                        if (!/^[0-9]{3}[m]{1}[g]{1}$/g.test(document.registrationForm.power.value))
                        {
                            $('#powerErr').html('Enter  Valid Power');
                            return false;
                        } else {
                            $('#powerErr').html('');
                            return false;
                        }
                    }
                });
                //validation for age
                $('#age').keyup(function () {
                    var age = $('#age').val();
                    if (age === "")
                    {
                        $('#ageErr').html('Age_Limit is required');
                        return false;
                    } else
                    {

                        if (!/^[0-9]{2}[a-zA-Z]{4}$/g.test(document.registrationForm.age.value))
                        {
                            $('#ageErr').html('Enter "10-15year" formate');
                            return false;
                            if (!/^[0-9]{2}[-]{1}[0-9]{2}[a-zA-Z]{4}$/g.test(document.registrationForm.age.value)) {
                                $('#ageErr').html('Enter "10-15year" formate');
                                return false;
                            }
                        } else
                        {
                            $('#ageErr').html('');
                            return false;
                        }
                    }
                });
                //validation for Description
                $('#des').keyup(function () {
                    var name = $('#des').val();
                    if (name === "")
                    {
                        $('#desErr').html('Description is required');
                        return false;
                    } else
                    {
                        if (!/^[a-zA-Z_ ]*$/g.test(document.registrationForm.pname.value))
                        {
                            $('#desErr').html('Enter only alphabets');
                            return false;
                        } else if (name.length < 2)
                        {
                            $('#desErr').html('Enter atleast 2 alphabets');
                            return false;
                        } else if (name.length > 500)
                        {
                            $('#desErr').html('Enter within 200 alphabets');
                            return false;
                        } else
                        {
                            $('#desErr').html('');
                            return false;
                        }
                    }
                });
            });
        </script>
        <!--validation for insert product-->


        <!--validation for update product-->

        <script class="text/javascript">
            $(document).ready(function () {

                //validation for product name
                $('#p_name').keyup(function () {
                    var name = $('#p_name').val();
                    if (name === "")
                    {
                        $('#NameErr').html('Product name is required');
                        return false;
                    } else
                    {
                        if (!/^[a-zA-Z]*$/g.test(document.updateForm.p_name.value))
                        {
                            $('#NameErr').html('Enter only alphabets');
                            return false;
                        } else if (name.length < 2)
                        {
                            $('#NameErr').html('Enter atleast 2 alphabets');
                            return false;
                        } else if (name.length > 20)
                        {
                            $('#NameErr').html('Enter within 20 alphabets');
                            return false;
                        } else
                        {
                            $('#NameErr').html('');
                            return false;
                        }
                    }
                });
                //validation for product quantity
                $('#Qty').keyup(function () {
                    var qty = $('#Qty').val();
                    if (qty === "")
                    {
                        $('#QtyErr').html('Quantity is required');
                        return false;
                    } else
                    {
                        if (!/^[0-9]*$/g.test(document.updateForm.Qty.value))
                        {
                            $('#QtyErr').html('Enter only Digit');
                            return false;
                        } else if (qty.length >= 4)
                        {
                            $('#QtyErr').html('Enter 4 digit only');
                            return false;
                        } else
                        {
                            $('#QtyErr').html('');
                            return false;
                        }
                    }
                });
                //validation for product name
                $('#c_name').keyup(function () {
                    var cname = $('#c_name').val();
                    if (cname === "")
                    {
                        $('#CnameErr').html('Company name is required');
                        return false;
                    } else
                    {
                        if (!/^[a-zA-Z]*$/g.test(document.updateForm.c_name.value))
                        {
                            $('#CnameErr').html('Enter only alphabets');
                            return false;
                        } else if (cname.length < 2)
                        {
                            $('#CnameErr').html('Enter atleast 2 alphabets');
                            return false;
                        } else if (cname.length > 10)
                        {
                            $('#CnameErr').html('Enter within 10 alphabets');
                            return false;
                        } else
                        {
                            $('#CnameErr').html('');
                            return false;
                        }
                    }
                });
                //validation for product price
                $('#Price').keyup(function () {
                    var qty = $('#Price').val();
                    if (qty === "")
                    {
                        $('#PriceErr').html('Price is required');
                        return false;
                    } else
                    {
                        if (!/^[0-9]*$/g.test(document.updateForm.Price.value))
                        {
                            $('#PriceErr').html('Enter only Digit');
                            return false;
                        } else if (qty.length != 3)
                        {
                            $('#PriceErr').html('Enter 3 digit only');
                            return false;
                        } else
                        {
                            $('#PriceErr').html('');
                            return false;
                        }
                    }
                });
                //validation for manufacuring date
                $('#m_date').keyup(function () {
                    var mdate = $('#m_date').val();
                    var selectedText = document.getElementById('m_date').value;
                    var selectedDate = new Date(selectedText);
                    var now = new Date();
                    if (mdate === "")
                    {
                        $('#MdateErr').html('Manufacturing Date is required');
                        return false;
                    } else if (selectedDate > now)
                    {
                        $('#MdateErr').html('Date must be in the past');
                    } else
                    {
                        $('#MdateErr').html('');
                        return false;
                    }
                });
                //validation for expry date
                $('#e_date').keyup(function () {
                    var edate = $('#e_date').val();
                    var selectedText = document.getElementById('e_date').value;
                    var selectedDate = new Date(selectedText);
                    var now = new Date();
                    if (edate === "")
                    {
                        $('#EdateErr').html('Expiery Date is required');
                        return false;
                    } else if (selectedDate < now)
                    {
                        $('#EdateErr').html('Date must be in the Future');
                    } else
                    {
                        $('#EdateErr').html('');
                        return false;
                    }
                });



                //validation for Description
                $('#Des').keyup(function () {
                    var name = $('#Des').val();
                    if (name === "")
                    {
                        $('#DesErr').html('Description is required');
                        return false;
                    } else
                    {
                        if (!/^[a-zA-Z]*$/g.test(document.updateForm.Des.value))
                        {
                            $('#DesErr').html('Enter only alphabets');
                            return false;
                        } else if (name.length < 2)
                        {
                            $('#DesErr').html('Enter atleast 2 alphabets');
                            return false;
                        } else if (name.length > 200)
                        {
                            $('#DesErr').html('Enter within 200 alphabets');
                            return false;
                        } else
                        {
                            $('#DesErr').html('');
                            return false;
                        }
                    }
                });
            });
        </script>

        <!--validation for update product-->
        <style>
            .product-grid{
                font-family: 'Lora', serif;
                text-align: center;
                margin: 0 0 22px;
                border: 1px solid #e5e5e5;
                transition: all .4s ease-out;
                border-radius: 5px;
            }
            .product-grid:hover{ border-color: #ffc221; }
            .product-grid .product-image{ position: relative; }
            .product-grid .product-image a.image{ display: block; }
            .product-grid .product-image img{
                width: 100%;
                height: 250px;
                transition: all 0.4s ease 0s;
            }
            .product-grid:hover .product-image img{ opacity: 0.6; }
            .product-grid .quick-view{
                color: #ffc221;
                background-color: #fff;
                font-size: 16px;
                line-height: 45px;
                width: 45px;
                height: 45px;
                border: 1px solid #ffc221;
                border-radius: 50%;
                opacity: 0;
                transform: translateX(-50%) translateY(-50%);
                position: absolute;
                top: 50%;
                left: 50%;
                transition: all .4s ease-out;
            }
            .product-grid .quick-view:hover{
                color: #fff;
                background: #ffc221
            }
            .product-grid:hover .quick-view{ opacity: 1; }
            .product-grid .product-content{
                padding: 15px;
                position: relative;
            }
            .product-grid .rating{
                color: #e98b50;
                font-size: 0;
                padding: 0;
                margin: 0 0 10px;
                list-style: none;
            }
            .product-grid .rating li{
                font-size: 10px;
                margin: 0 1px;
            }
            .product-grid .rating .far{ color: #999; }
            .product-grid .title{
                color: #555;
                font-size: 20px;
                margin: 0;
            }
            .product-grid .title:after{
                content: "";
                background-color: #ffc221;
                width: 40px;
                height: 1px;
                margin: 12px auto 10px;
                display: block;
                clear: both;
            }
            .product-grid .title a{
                color: #555;
                transition: all 0.3s ease 0s;
            }
            .product-grid .title a:hover{ color: #ffc221; }
            .product-grid .price{
                /*color: #ffc221;*/
                color: balck;
                font-size: 18px;
                font-weight: 700;
                margin: 0 0 20px;
            }
            .product-grid .product-links{
                width: 165px;
                padding: 0;
                margin: 0;
                list-style: none;
                transform: translateX(-50%);
                position: absolute;
                bottom: -22px;
                left: 50%;
                transition: all 0.3s ease-in-out;
            }
            .product-grid .product-links li{
                display: inline-block;
                margin: 0 3px;
                transition: all 0.3s ease;
            }
            .product-grid .product-links li:nth-child(1){ transform: translateX(55px); }
            .product-grid .product-links li:nth-child(3){ transform: translateX(-54px); }
            .product-grid:hover .product-links li:nth-child(1){ transform: translateX(0); }
            .product-grid:hover .product-links li:nth-child(3){ transform: translateX(0); }
            .product-grid .product-links li a{
                color: #ffc221;
                background: #fff;
                font-size: 18px;
                line-height: 45px;
                height: 45px;
                width: 45px;
                border: 1px solid #ffc221;
                border-radius: 50px;
                display: block;
                position: relative;
                z-index: 1;
                transition: all 0.4s ease 0s;
            }
            .product-grid .product-links li a:hover{
                color: #fff;
                background: #ffc221;
            }
            .product-grid .product-links li a:before,
            .product-grid .product-links li a:after,
            .product-grid .quick-view:before,
            .product-grid .quick-view:after{
                content: attr(data-tip);
                color: #fff;
                background: #333;
                font-size: 12px;
                line-height: 22px;
                padding: 2px 7px;
                white-space: nowrap;
                display: none;
                transform: translateX(-50%);
                position: absolute;
                left: 50%;
                top: -35px;
                transition: all 0.3s;
            }
            .product-grid .product-links li a:after,
            .product-grid .quick-view:after{
                content: '';
                height: 15px;
                width: 15px;
                padding: 0;
                border-radius: 0;
                transform: translateX(-50%) rotate(45deg);
                top: -22px;
                z-index: -1;
            }
            .product-grid .product-links li a:hover:before,
            .product-grid .product-links li a:hover:after,
            .product-grid .quick-view:hover:before,
            .product-grid .quick-view:hover:after{
                display: block;
            }
            @media screen and (max-width: 990px){
                .product-grid{ margin: 0 0 52px; }
            }

        </style>
    </head>
    <body>

        <div class="content-wrapper" style="background-color: white">
            <div class="row" style="margin-left: 10px">
                <div class="page-header clearfix" style="size: 20px;">
                    <br> <h2 class="pull-left" style="color:black; margin-bottom: -40px; font-family: 'EB Garamond', serif; ">Product Details</h2>
                    <a href="#" class="btn btn-success pull-right" style="margin-left: 1090px;" data-toggle="modal" data-target="#add_product">Add New Product</a>
                    <hr style="color:red">
                </div>
                <?php
                $sql = "SELECT * FROM tbl_product where category_name='Healthcare'";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="#" class="image"><img src="image/<?php echo $row['image']; ?>" ></a>
                            </div>
                            <div class="product-content">
                                <h4 class="title"><a href="#"><?php echo $row['product_name'] ?></a></h4>
                                <div class="price">&#8377 <?php echo $row['price'] ?></div>
                                <?php
                                ?>
                                <ul class="product-links">
                                    <li><a href="#" data-tip="Edit" data-toggle='modal' data-target='#update_product<?php $row['product_id'] ?>'><i class="far fa-edit"></i></a></li>
                                    <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                                    <li><a data-tip='Remove' href="#"  data-toggle="modal" data-target="#deletemodal<?php $row['product_id'] ?>"><i class='fas fa-trash-alt'></i></a></li>
                                </ul>
                                <?php
                             include_once './Modal_update_product.php';
                                include_once './Modal_delete_product.php';
//                                ?>
                            </div>
                        </div><br><br>
                    </div>
                    <?php
                    include_once './Modal_update_product.php';
                                include_once './Modal_delete_product.php';
                }
                ?>
            </div>
        </div>


        <!--Add Product Modal-->
        <div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="add_product"
             aria-hidden="true">

            <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                                <center>
                                                    <h1 style="font-family: 'EB Garamond', serif;">Healthcare Product </h1>
                                                </center>
                                            </div>
                                        </div><hr>

                                        <form action="#" method="post" name="registrationForm" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFirstName" class="form-label">Product Name</label>
                                                        <input type="text" name="p_name" id="pname" class="form-control" placeholder="Enter Product Name" >

                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="nameErr"></span>
                                                            </div>
                                                        </div>

                                                    </div>                                        
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contactno" class="form-label">Quantity</label>
                                                        <input type="number" name="p_qty" id="qty" class="form-control" placeholder="Enter Quantity"  >

                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="qtyErr"</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="Inputcompanyname" class="form-label">Company Name</label>
                                                        <input type="text" name="c_name" id="cname" class="form-control" placeholder="Enter Company Name" >

                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="cnameErr"></span>
                                                            </div>
                                                        </div>

                                                    </div>                                        
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="Inputweight" class="form-label">Weight</label>
                                                        <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter Weight" >

                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="weightErr"></span>
                                                            </div>
                                                        </div>

                                                    </div>                                        
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailid" class="form-label">Product image</label>
                                                        <input type="file" id="file" name="image" accept="image/*">

                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="imageErr"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status" class="form-label">Price</label>
                                                        <input type="text" name="p_price" id="price" class="form-control" placeholder="Enter Price"/>
                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="priceErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailid" class="form-label">Manufacture Date</label>
                                                        <input type="date" name="m_date" id="mdate" class="form-control" data-date-format="yyyy-mm-dd">

                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="mdateErr"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status" class="form-label">Expiery date</label>
                                                        <input type="date" name="e_date" id="edate" class="form-control" />
                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="edateErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="address" class="form-label">Description</label>
                                                        <textarea style="resize:none;" name="p_description" id="des" class="form-control" placeholder="Enter Description"></textarea>
                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color: red;" id="desErr"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <button type="button" style="margin-right:320px; width: 100px" class="btn btn-danger" data-dismiss="modal">Close</button>    
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input style="padding-right:20px; padding-left: 20px; margin-left: 420px" class="btn btn-success my-2 my-sm-0" type="submit" name="submit" value="Add Product">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Add PRoduct Modal-->

        <!--Insert Product-->
        <?php
        include_once './Connection.php';

        if (isset($_POST['submit'])) {
            $category = "Healthcare ";
            $category_name = $category;

            $pname = $_POST['p_name'];
            $qty = $_POST['p_qty'];
            $cname = $_POST['c_name'];
            $weight = $_POST['weight'];

            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "./image/" . $filename;

            $price = $_POST['p_price'];
            $mdate = $_POST['m_date'];
            $edate = $_POST['e_date'];
            $des = $_POST['p_description'];

            if ($pname == "" || $qty == "" || $cname == "" || $weight == "" || $filename == "" || $price == "" || $mdate = "" || $edate == "" || $des == "") {
                ?><script type="text/javascript">
                    $(function () {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        toastr.error('please Fill All the details ')

                    });

                </script><?php
                //header('location:Display_healthcare.php');
            } else {
                $sql = mysqli_query($con, "SELECT * FROM tbl_product where product_name='$pname' and company_name='$cname' and weight='$weight'");
                if (mysqli_num_rows($sql) > 0) {
                    ?><script type="text/javascript">
                        $(function () {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            toastr.warning('Product Already Exists..!')

                        });

                    </script><?php
                    // header('location:Display_healthcare.php');
                } else {
                    $query = "insert into tbl_product(category_name, product_name, company_name, quantity,image, price,weight, date,m_date,e_date,description) values ( '$category_name','" . $_POST['p_name'] . "','" . $_POST['c_name'] . "','" . $_POST['p_qty'] . "','$filename' ,'" . $_POST['p_price'] . "','" . $_POST['weight'] . "',now(),'" . $_POST['m_date'] . "','" . $_POST['e_date'] . "','" . $_POST['p_description'] . "')";
                    //$result = mysqli_query($con, $query);
                    if (mysqli_query($con, $query)) {

                        move_uploaded_file($tempname, $folder);
                        ?><script type="text/javascript">
                            $(function () {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                toastr.success('Inserted Successfully')

                            });

                        </script><?php
                        header('location:Display_healthcare.php');
                    } else {
                        ?><script type="text/javascript">
                            $(function () {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                toastr.error('Not Inserted')

                            });

                        </script><?php
                    }
                }
            }
        }
        ?>
        <!--Insert product -->
        <script src="../../demo_website/js/bootstrap.js" type="text/javascript"></script>
        <script src="../../demo_website/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="plugins/toastr/toastr.min.js"></script>
    </body>
</html>


Modal_update

<div class="modal fade" id="update_product<?php $row['product_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="update_product"
     aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <h1 style="font-family: 'EB Garamond', serif;">Healthcare Product </h1>
                                        </center>
                                    </div>
                                </div><hr>

                                <form action="Update_product.php" method="post" name="updateForm" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $row['product_id'] ?>"/>
                                                <label for="inputFirstName" class="form-label">Product Name</label>
                                                <input type="text" name="p_name" id="p_name" class="form-control" placeholder="Enter Product Name" value="<?php echo $row['product_name']; ?>">

                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="NameErr"></span>
                                                    </div>
                                                </div>

                                            </div>                                        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contactno" class="form-label">Quantity</label>
                                                <input type="number" name="p_qty" id="Qty" class="form-control" placeholder="Enter Quantity" value="<?php echo $row['quantity']; ?>" >

                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="QtyErr"</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Inputcompanyname" class="form-label">Company Name</label>
                                                <input type="text" name="c_name" id="c_name" class="form-control" placeholder="Enter Company Name" value="<?php echo $row['company_name']; ?>">

                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="CnameErr"></span>
                                                    </div>
                                                </div>

                                            </div>                                        
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Inputweight" class="form-label">Weight</label>
                                                <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter Weight" value="<?php echo $row['weight']; ?>">

                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="WeightErr"></span>
                                                    </div>
                                                </div>

                                            </div>                                        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailid" class="form-label">Product image</label>
                                                <input type="file" id="file" name="image" accept="image/*" value="<?php echo $row['image']; ?>">

                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="ImageErr"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Price</label>
                                                <input type="text" name="p_price" id="Price" class="form-control" placeholder="Enter Price" value="<?php echo $row['price']; ?>"/>
                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="PriceErr"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailid" class="form-label">Manufacture Date</label>
                                                <input type="date" name="m_date" id="m_date" class="form-control" data-date-format="yyyy-mm-dd" value="<?php echo $row['m_date']; ?>">

                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="mdateErr"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Expiery date</label>
                                                <input type="date" name="e_date" id="e_date" class="form-control" value="<?php echo $row['e_date']; ?>"/>
                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="EdateErr"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="address" class="form-label">Description</label>
                                                <input type="text"  name="p_description" id="Des" class="form-control" placeholder="Enter Description" value="<?php echo $row['description']; ?>"></textarea>
                                                <div class="row">
                                                    <div class="col">
                                                        <span style="color: red;" id="DesErr"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <button type="button" style="margin-right:320px; width: 100px" class="btn btn-danger" data-dismiss="modal">Close</button>    
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input style="padding-right:20px; padding-left: 20px; margin-left: 400px" class="btn btn-success my-2 my-sm-0" type="submit" name="update" value="Update Product">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Update Product Modal-->



Update_product

<?php
require_once "./Connection.php";
if (isset($_POST['update'])) {
    if (count($_POST) > 0) {
        $id = $_POST['id'];
        mysqli_query($con, "UPDATE tbl_product set product_name='" . $_POST['p_name'] . "', company_name='" . $_POST['c_name'] . "', quantity='" . $_POST['p_qty'] . "',price='" . $_POST['p_price'] . "',weight='" . $_POST['weight'] . "',m_date='" . $_POST['m_date'] . "',e_date='" . $_POST['e_date'] . "',description='" . $_POST['p_description'] . "' WHERE product_id='$id'");
        ?><script type="text/javascript">
            $(function () {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                toastr.success('Product Successfully Updated')

            });

        </script><?php
        header('location:Display_healthcare.php');
    }
}
//$result = mysqli_query($con, "SELECT * FROM tbl_product WHERE product_id='" . $_GET['id'] . "'");
//$row = mysqli_fetch_array($result);
?>
