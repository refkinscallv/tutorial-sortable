<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sortable</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

</head>
<body class="bg-light">
    
    <div class="container position-relative vh-100 overflow-auto bg-white p-3">
        <div class="table-responsive">
            <table class="table table-striped" id="products_table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Brand</th>
                        <th>Product</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="loading">
                        <td class="text-center" colspan="3">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(() => {
            getProductData();
            initSortable();
        });

        function initSortable(){
            $("#products_table tbody").sortable({
                update: (e, u) => {
                    let productList = $("#products_table tbody tr.item");

                    let data = [];
                    let no = 1;

                    $.each(productList, (i, v) => {
                        data.push({
                            no : no,
                            id : $(v)[0].children[0].innerText,
                            brand : $(v)[0].children[1].innerText,
                            name : $(v)[0].children[2].innerText
                        });
                        no++;
                    });

                    $.ajax({
                        url : "/request.php",
                        data : {
                            request : "update_data",
                            data_id : 1,
                            data : data
                        },
                        type : "POST",
                        dataType : "JSON",
                        success : (res) => {
                            if(!res.status){
                                alert(res.result);
                            }
                        },
                        error : (jqXHR) => {
                            console.error(jqXHR);
                        }
                    });
                }
            });
        }
    
        function getProductData(){
            $.ajax({
                url : "/request.php",
                data : {
                    request: "get_data"
                },
                type : "GET",
                dataType : "JSON",
                success : (res) => {
                    if(res.status){
                        let listProduct = "";
                        let sorting     = res.sorting[0];

                        if(sorting.length > 0){
                            $.each(sorting, (i, v) => {
                                let found = res.result.find(item => item.id === v.id);
                                if (found) {
                                    listProduct += `<tr class="item">
                                        <td class="text-center">${found.id}</td>
                                        <td>${found.brand}</td>
                                        <td>${found.product_name}</td>
                                    </tr>`;
                                }
                            });
                        } else {
                            $.each(res.result, (i, v) => {
                                listProduct += `<tr class="item">
                                    <td class="text-center">${v.id}</td>
                                    <td>${v.brand}</td>
                                    <td>${v.product_name}</td>
                                </tr>`;
                            });
                        }

                        $("#products_table tbody").html(listProduct);
                    } else {
                        $("#products_table tbody").html(`<tr class="loading">
                            <td class="text-center text-danger" colspan="3">No Data</td>
                        </tr>`);
                    }
                },
                error : (jqXHR) => {
                    console.error(jqXHR);
                }
            });
        }

        function updateProductData(data, data_id){
            $.ajax({
                url : "/request.php",
                data : {
                    request : "update_data",
                    data_id : data_id,
                    data : data
                },
                type : "POST",
                dataType : "JSON",
                success : (res) => {
                    if(!res.status){
                        alert(res.result);
                    }
                },
                error : (jqXHR) => {
                    console.error(jqXHR);
                }
            });
        }
    </script>
</body>
</html>