\<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            overflow-y: auto; /* Add scrollbar to body */
        }
    </style>
</head>
<body>
    <header>
        <!-- No content in header for now -->
    </header>
    <main class="container mt-5">
        <section>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Customer Invoice</h1>
                    <div class="invoice-info">
                        <div class="d-flex flex-column">
                            <div>Customer name: Lu Dat Luan</div>
                            <div>Customer phone: 113</div>
                            <div>Customer address: Nha tu hinh trai tim</div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Pham Quoc Trieu
                                        <p class="text-muted">
                                            Đầu moi thiểu năng.
                                        </p>
                                    </td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                </tr>
                                

                                <tr>
                                    <td>
                                        Do Hoang Phong
                                        <p class="text-muted">
                                           Chúa tể racist.
                                        </p>
                                    </td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                </tr>

                                <tr>
                                    <td>
                                        Nguyen Le Tuan Phuong
                                        <p class="text-muted">
                                           Nerd CNTT
                                        </p>
                                    </td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2">
                                        <h5 class="text-success text-center "><strong>Grand Total</strong></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-success"><strong>$1000000</strong></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="#" role="button" class="btn btn-outline-success btn-lg" type="button">Print</a>
                        <a href="#" role="button" class="btn btn-outline-danger btn-lg" type="button">Delete</a>
                    </div>               

                    <div class="invoice-footer text-center">
                        Thank you for your Business.
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>